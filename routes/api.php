<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StoreController;
use App\Http\Controllers\Api\CouponController;

Route::get('/stores', [StoreController::class, 'index']);
Route::get('/coupons', [CouponController::class, 'index']);

Route::get('/mock-external-coupons', function () {
    return response()->json([
        [
            'name' => 'أمازون السعودية',
            'slug' => 'amazon-sa',
            'url' => 'https://amazon.sa',
            'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/a/a9/Amazon_logo.svg',
            'is_active' => true,
            'coupons' => [
                ['external_id' => 'ext-amz-1', 'title' => 'خصم 15% على الإلكترونيات', 'code' => 'AMZ15', 'discount_value' => '15%', 'expires_at' => now()->addDays(15)->toDateString(), 'is_active' => true],
                ['external_id' => 'ext-amz-2', 'title' => 'شحن مجاني للطلبات فوق 200 ريال', 'code' => 'FREE200', 'discount_value' => 'شحن مجاني', 'expires_at' => now()->addDays(20)->toDateString(), 'is_active' => true]
            ]
        ],
        [
            'name' => 'نون دوت كوم',
            'slug' => 'noon',
            'url' => 'https://noon.com',
            'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/e/e3/Noon_Logo.svg',
            'is_active' => true,
            'coupons' => [
                ['external_id' => 'ext-noon-alc33', 'title' => 'كود خصم نون كاش باك 10% شامل جميع المنتجات للعملاء الجدد', 'code' => 'ALC33', 'discount_value' => '10% كاش باك', 'expires_at' => now()->addDays(15)->toDateString(), 'is_active' => true],
                ['external_id' => 'ext-noon-alc54', 'title' => 'كوبون نون السعودية كاش باك 10% إضافي على أول طلب للعملاء الجدد', 'code' => 'ALC54', 'discount_value' => '10% كاش باك', 'expires_at' => now()->addDays(20)->toDateString(), 'is_active' => true],
                ['external_id' => 'ext-noon-alc35', 'title' => 'كود نون كاش باك 5% فعال لجميع العملاء الحاليين والقدامى', 'code' => 'ALC35', 'discount_value' => '5% كاش باك', 'expires_at' => now()->addDays(10)->toDateString(), 'is_active' => true],
                ['external_id' => 'ext-noon-alc51', 'title' => 'كود خصم نون السعودية اليوم لتوفير يصل إلى 80%', 'code' => 'ALC51', 'discount_value' => 'خصم حتى 80%', 'expires_at' => now()->addDays(25)->toDateString(), 'is_active' => true],
                ['external_id' => 'ext-noon-1', 'title' => 'كود خصم نون 10% إضافي على الإلكترونيات والأجهزة المنزلية', 'code' => 'NOON10', 'discount_value' => '10% خصم', 'expires_at' => now()->addDays(10)->toDateString(), 'is_active' => true],
                ['external_id' => 'ext-noon-2', 'title' => 'قسيمة خصم نون بقيمة 50 ريال سعودي على أول طلب', 'code' => 'FIRST50', 'discount_value' => '50 ريال خصم', 'expires_at' => now()->addDays(30)->toDateString(), 'is_active' => true]
            ]
        ],
        [
            'name' => 'نمشي للموضة',
            'slug' => 'namshi',
            'url' => 'https://namshi.com',
            'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/8/87/Namshi_logo.png',
            'is_active' => true,
            'coupons' => [
                ['external_id' => 'ext-namshi-1', 'title' => 'خصم 20% على الملابس الرياضية', 'code' => 'SPORTS20', 'discount_value' => '20%', 'expires_at' => now()->addDays(5)->toDateString(), 'is_active' => true]
            ]
        ],
        [
            'name' => 'شي إن',
            'slug' => 'shein',
            'url' => 'https://shein.com',
            'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/9/98/Shein_logo.svg',
            'is_active' => true,
            'coupons' => [
                ['external_id' => 'ext-shein-1', 'title' => 'خصم 15% على ملابس الأطفال', 'code' => 'KIDS15', 'discount_value' => '15%', 'expires_at' => now()->addDays(12)->toDateString(), 'is_active' => true],
                ['external_id' => 'ext-shein-2', 'title' => 'خصم 20% للطلبات فوق 500 ريال', 'code' => 'SHEIN20', 'discount_value' => '20%', 'expires_at' => now()->addDays(8)->toDateString(), 'is_active' => true]
            ]
        ],
        [
            'name' => 'ستايلي',
            'slug' => 'styli',
            'url' => 'https://stylishop.com',
            'logo_url' => 'https://d37vkvdb1hp1p4.cloudfront.net/sites/default/files/styles/merchant_logo_large/public/store_icon_ar/styli_logo_ar.png',
            'is_active' => true,
            'coupons' => [
                ['external_id' => 'ext-styli-1', 'title' => 'خصم إضافي بقيمة 15% على كل الموقع', 'code' => 'ST88', 'discount_value' => '15%', 'expires_at' => now()->addDays(6)->toDateString(), 'is_active' => true]
            ]
        ],
        [
            'name' => 'سيفي',
            'slug' => 'sivvi',
            'url' => 'https://sivvi.com',
            'logo_url' => 'https://d37vkvdb1hp1p4.cloudfront.net/sites/default/files/styles/merchant_logo_large/public/store_icon_ar/sivvi_logo_ar.png',
            'is_active' => true,
            'coupons' => [
                ['external_id' => 'ext-sivvi-1', 'title' => 'خصم 20% على الأحذية والحقائب', 'code' => 'SV22', 'discount_value' => '20%', 'expires_at' => now()->addDays(3)->toDateString(), 'is_active' => true]
            ]
        ],
        [
            'name' => 'مكتبة جرير',
            'slug' => 'jarir',
            'url' => 'https://jarir.com',
            'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/1/1b/Jarir_Bookstore_logo.svg',
            'is_active' => true,
            'coupons' => [
                ['external_id' => 'ext-jarir-1', 'title' => 'خصم 5% على الكتب والأدوات المكتبية', 'code' => 'JARIR5', 'discount_value' => '5%', 'expires_at' => now()->addDays(25)->toDateString(), 'is_active' => true]
            ]
        ],
        [
            'name' => 'إكسترا للالكترونيات',
            'slug' => 'extra',
            'url' => 'https://extra.com',
            'logo_url' => 'https://d37vkvdb1hp1p4.cloudfront.net/sites/default/files/styles/merchant_logo_large/public/store_icon_ar/extra_logo_ar.png',
            'is_active' => true,
            'coupons' => [
                ['external_id' => 'ext-extra-1', 'title' => 'خصم 10% على الشاشات الكبيرة', 'code' => 'EX10', 'discount_value' => '10%', 'expires_at' => now()->addDays(7)->toDateString(), 'is_active' => true]
            ]
        ],
        [
            'name' => 'غولدن سنت',
            'slug' => 'golden-scent',
            'url' => 'https://goldenscent.com',
            'logo_url' => 'https://d37vkvdb1hp1p4.cloudfront.net/sites/default/files/styles/merchant_logo_large/public/store_icon_ar/golden_scent_logo.png',
            'is_active' => true,
            'coupons' => [
                ['external_id' => 'ext-gs-1', 'title' => 'خصم 15% على العطور الفرنسية والشرقية', 'code' => 'GS15', 'discount_value' => '15%', 'expires_at' => now()->addDays(14)->toDateString(), 'is_active' => true]
            ]
        ],
        [
            'name' => 'نايس ون عطور وتجميل',
            'slug' => 'nice-one',
            'url' => 'https://niceone.com',
            'logo_url' => 'https://d37vkvdb1hp1p4.cloudfront.net/sites/default/files/styles/merchant_logo_large/public/store_icon_ar/nice_one_logo.png',
            'is_active' => true,
            'coupons' => [
                ['external_id' => 'ext-n1-1', 'title' => 'خصم 10% على منتجات العناية بالبشرة', 'code' => 'N10', 'discount_value' => '10%', 'expires_at' => now()->addDays(4)->toDateString(), 'is_active' => true]
            ]
        ],
        [
            'name' => 'سيفورا السعودية',
            'slug' => 'sephora-sa',
            'url' => 'https://sephora.sa',
            'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/f/f2/Sephora_logo.svg',
            'is_active' => true,
            'coupons' => [
                ['external_id' => 'ext-seph-1', 'title' => 'خصم 10% على أفضل الماركات العالمية', 'code' => 'SEPH10', 'discount_value' => '10%', 'expires_at' => now()->addDays(18)->toDateString(), 'is_active' => true]
            ]
        ],
        [
            'name' => 'ممزورلد للأطفال والأمهات',
            'slug' => 'mumzworld',
            'url' => 'https://mumzworld.com',
            'logo_url' => 'https://d37vkvdb1hp1p4.cloudfront.net/sites/default/files/styles/merchant_logo_large/public/store_icon_ar/mumzworld_logo.png',
            'is_active' => true,
            'coupons' => [
                ['external_id' => 'ext-mz-1', 'title' => 'خصم 10% على جميع مستلزمات الأطفال', 'code' => 'MZ10', 'discount_value' => '10%', 'expires_at' => now()->addDays(21)->toDateString(), 'is_active' => true]
            ]
        ],
        [
            'name' => 'باث أند بودي وركس',
            'slug' => 'bath-and-body',
            'url' => 'https://bathandbodyworks.com.sa',
            'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/f/f5/Bath_%26_Body_Works_logo.svg',
            'is_active' => true,
            'coupons' => [
                ['external_id' => 'ext-bbw-1', 'title' => 'خصم 20% على الشموع والمعقمات', 'code' => 'BBW20', 'discount_value' => '20%', 'expires_at' => now()->addDays(9)->toDateString(), 'is_active' => true]
            ]
        ],
        [
            'name' => 'اتش اند ام السعودية',
            'slug' => 'hm-sa',
            'url' => 'https://sa.hm.com',
            'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/5/53/H%26M-Logo.svg',
            'is_active' => true,
            'coupons' => [
                ['external_id' => 'ext-hm-1', 'title' => 'خصم إضافي 15% على الملابس الشتوية والصيفية', 'code' => 'HM15', 'discount_value' => '15%', 'expires_at' => now()->addDays(11)->toDateString(), 'is_active' => true]
            ]
        ],
        [
            'name' => 'فوغا كلوسيت',
            'slug' => 'vogacloset',
            'url' => 'https://vogacloset.com',
            'logo_url' => 'https://d37vkvdb1hp1p4.cloudfront.net/sites/default/files/styles/merchant_logo_large/public/store_icon_ar/vogacloset_logo.png',
            'is_active' => true,
            'coupons' => [
                ['external_id' => 'ext-voga-1', 'title' => 'خصم 15% على الماركات الأوروبية', 'code' => 'VOGA15', 'discount_value' => '15%', 'expires_at' => now()->addDays(13)->toDateString(), 'is_active' => true]
            ]
        ],
        [
            'name' => 'هنجرستيشن',
            'slug' => 'hungerstation',
            'url' => 'https://hungerstation.com',
            'logo_url' => 'https://d37vkvdb1hp1p4.cloudfront.net/sites/default/files/styles/merchant_logo_large/public/store_icon_ar/hungerstation_logo.png',
            'is_active' => true,
            'coupons' => [
                ['external_id' => 'ext-hunger-1', 'title' => 'شحن وتوصيل مجاني لأول 3 طلبات', 'code' => 'FREE', 'discount_value' => 'توصيل مجاني', 'expires_at' => now()->addDays(1)->toDateString(), 'is_active' => true]
            ]
        ],
        [
            'name' => 'تويو لتوصيل الطلبات',
            'slug' => 'toyou',
            'url' => 'https://toyou.sp',
            'logo_url' => 'https://d37vkvdb1hp1p4.cloudfront.net/sites/default/files/styles/merchant_logo_large/public/store_icon_ar/toyou_logo.png',
            'is_active' => true,
            'coupons' => [
                ['external_id' => 'ext-toyou-1', 'title' => 'خصم 10% على رسوم خدمة التوصيل', 'code' => 'TY10', 'discount_value' => '10%', 'expires_at' => now()->addDays(4)->toDateString(), 'is_active' => true]
            ]
        ],
        [
            'name' => 'فورديل للتسوق',
            'slug' => 'fordeal',
            'url' => 'https://fordeal.com',
            'logo_url' => 'https://d37vkvdb1hp1p4.cloudfront.net/sites/default/files/styles/merchant_logo_large/public/store_icon_ar/fordeal_logo.png',
            'is_active' => true,
            'coupons' => [
                ['external_id' => 'ext-fordeal-1', 'title' => 'خصم 20% للطلبات فوق 300 ريال', 'code' => 'FD20', 'discount_value' => '20%', 'expires_at' => now()->addDays(8)->toDateString(), 'is_active' => true]
            ]
        ],
        [
            'name' => 'سنتربوينت أزياء عائلية',
            'slug' => 'centrepoint',
            'url' => 'https://centrepointstores.com',
            'logo_url' => 'https://d37vkvdb1hp1p4.cloudfront.net/sites/default/files/styles/merchant_logo_large/public/store_icon_ar/centrepoint_logo.png',
            'is_active' => true,
            'coupons' => [
                ['external_id' => 'ext-cp-1', 'title' => 'خصم إضافي بقيمة 15% على مستلزمات المنزل والأثاث', 'code' => 'CP15', 'discount_value' => '15%', 'expires_at' => now()->addDays(14)->toDateString(), 'is_active' => true]
            ]
        ],
        [
            'name' => 'ماكس فاشن للملابس',
            'slug' => 'max-fashion',
            'url' => 'https://maxfashion.com',
            'logo_url' => 'https://d37vkvdb1hp1p4.cloudfront.net/sites/default/files/styles/merchant_logo_large/public/store_icon_ar/max_fashion_logo.png',
            'is_active' => true,
            'coupons' => [
                ['external_id' => 'ext-max-1', 'title' => 'خصم 10% على الملابس الصيفية الجديدة', 'code' => 'MAX10', 'discount_value' => '10%', 'expires_at' => now()->addDays(12)->toDateString(), 'is_active' => true]
            ]
        ]
    ]);
});