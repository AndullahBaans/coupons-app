<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CouponSyncService;

class SyncCouponsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coupons:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize stores and coupons from the configured external API';

    /**
     * Execute the console command.
     *
     * @param  \App\Services\CouponSyncService  $syncService
     * @return int
     */
    public function handle(CouponSyncService $syncService): int
    {
        $this->info('====================================================');
        $this->info('  بدء مزامنة المتاجر والكوبونات من الـ API الخارجي  ');
        $this->info('====================================================');

        $result = $syncService->sync();

        if ($result['status'] === 'success') {
            $this->info('✔ تم الانتهاء من المزامنة بنجاح!');
            $this->table(
                ['النوع', 'العدد الذي تم مزامنته'],
                [
                    ['المتاجر (Stores)', $result['stores_synced']],
                    ['الكوبونات (Coupons)', $result['coupons_synced']]
                ]
            );
            $this->info('====================================================');
            return Command::SUCCESS;
        }

        $this->error('❌ فشلت عملية المزامنة!');
        $this->error("السبب: {$result['message']}");
        $this->info('====================================================');
        
        return Command::FAILURE;
    }
}
