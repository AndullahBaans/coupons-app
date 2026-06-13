<?php

namespace App\Services;

use App\Models\Store;
use App\Models\Coupon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Exception;

class CouponSyncService
{
    /**
     * Fetch stores and coupons from the API (Mock or CouponAPI.org) and synchronize with the database.
     *
     * @return array
     */
    public function sync(): array
    {
        $apiUrl = config('services.coupons.url');
        
        if (!$apiUrl) {
            Log::error('Coupons sync failed: COUPONS_API_URL is not configured.');
            return ['status' => 'error', 'message' => 'API URL not configured'];
        }

        try {
            Log::info("Starting coupons sync from API: {$apiUrl}");
            
            // Call the API with a timeout
            $response = Http::timeout(15)->get($apiUrl);

            if ($response->failed()) {
                Log::error("Failed to fetch coupons from API. Status code: {$response->status()}");
                return ['status' => 'error', 'message' => "API request failed with status: {$response->status()}"];
            }

            $data = $response->json();

            if (!is_array($data)) {
                Log::error('Invalid response format from Coupons API.');
                return ['status' => 'error', 'message' => 'Invalid API response format'];
            }

            $storesSynced = 0;
            $couponsSynced = 0;

            // --- MODE 1: CouponAPI.org JSON Schema (contains "offers" or "coupons" key) ---
            if (isset($data['offers']) && is_array($data['offers'])) {
                Log::info("Parsing data in CouponAPI.org schema format. Found " . count($data['offers']) . " offers.");
                
                foreach ($data['offers'] as $offer) {
                    $storeName = $offer['store'] ?? null;
                    if (!$storeName) {
                        continue;
                    }

                    // Generate a valid slug (handle Arabic names safely with URL encoding if slug is empty)
                    $slug = Str::slug($storeName);
                    if (empty($slug)) {
                        $slug = urlencode($storeName);
                    }

                    // Find or create the store
                    $store = Store::firstOrCreate(
                        ['slug' => $slug],
                        [
                            'name' => $storeName,
                            'url' => $offer['store_url'] ?? $offer['landing_page_url'] ?? null,
                            'logo_url' => $offer['store_logo'] ?? null,
                            'is_active' => true,
                        ]
                    );

                    $storesSynced++;

                    // Determine coupon status (handle 'suspended' status if present in incremental feeds)
                    $status = $offer['status'] ?? 'new';
                    $externalId = $offer['id'] ?? $offer['coupon_id'] ?? null;
                    
                    if (!$externalId) {
                        continue;
                    }

                    if ($status === 'suspended') {
                        // Deactivate or delete suspended coupons
                        Coupon::where('external_id', $externalId)->update(['is_active' => false]);
                        continue;
                    }

                    // Sync the coupon code
                    Coupon::updateOrCreate(
                        ['external_id' => $externalId],
                        [
                            'store_id' => $store->id,
                            'title' => $offer['title'] ?? 'خصم إضافي',
                            'code' => $offer['code'] ?? 'DEAL',
                            'discount_value' => $offer['discount_value'] ?? $offer['value'] ?? 'خصم مميز',
                            'expires_at' => isset($offer['expiry_date']) ? substr($offer['expiry_date'], 0, 10) : null,
                            'is_active' => true,
                        ]
                    );

                    $couponsSynced++;
                }

                return [
                    'status' => 'success',
                    'format' => 'CouponAPI.org',
                    'stores_synced' => Store::count(), // Total count since CouponAPI lists coupons individually
                    'coupons_synced' => $couponsSynced
                ];
            }

            // --- MODE 2: Custom/Mock Store-grouped JSON Schema ---
            Log::info("Parsing data in Store-grouped custom schema format. Found " . count($data) . " stores.");
            
            foreach ($data as $storeData) {
                if (!isset($storeData['name']) || !isset($storeData['slug'])) {
                    continue;
                }

                $store = Store::updateOrCreate(
                    ['slug' => $storeData['slug']],
                    [
                        'name' => $storeData['name'],
                        'url' => $storeData['url'] ?? null,
                        'logo_url' => $storeData['logo_url'] ?? null,
                        'is_active' => $storeData['is_active'] ?? true,
                    ]
                );

                $storesSynced++;

                if (isset($storeData['coupons']) && is_array($storeData['coupons'])) {
                    foreach ($storeData['coupons'] as $couponData) {
                        if (!isset($couponData['external_id']) || !isset($couponData['code']) || !isset($couponData['title'])) {
                            continue;
                        }

                        Coupon::updateOrCreate(
                            ['external_id' => $couponData['external_id']],
                            [
                                'store_id' => $store->id,
                                'title' => $couponData['title'],
                                'code' => $couponData['code'],
                                'discount_value' => $couponData['discount_value'] ?? '0%',
                                'expires_at' => $couponData['expires_at'] ?? null,
                                'is_active' => $couponData['is_active'] ?? true,
                            ]
                        );

                        $couponsSynced++;
                    }
                }
            }

            return [
                'status' => 'success',
                'format' => 'Custom/Mock',
                'stores_synced' => $storesSynced,
                'coupons_synced' => $couponsSynced
            ];

        } catch (Exception $e) {
            Log::error("Exception occurred during coupons synchronization: {$e->getMessage()}", [
                'trace' => $e->getTraceAsString()
            ]);
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
}
