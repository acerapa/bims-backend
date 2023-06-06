<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        /** Clone store data */
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchStores(1, 250); })->dailyAt('10:00');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchStores(251, 500); })->dailyAt('10:05');

        /** Fix store logo */
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchStoresFixLogo(); })->dailyAt('10:10');

        /** Fix store cover */
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchStoresFixCover(); })->dailyAt('10:15');

        /** Clone Store menu group */
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchStoresMenuGroup(1, 100); })->dailyAt('10:20');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchStoresMenuGroup(101, 200); })->dailyAt('10:25');

        /** Clone Store products */
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProducts(1, 100); })->dailyAt('10:30');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProducts(101, 200); })->dailyAt('10:35');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProducts(201, 300); })->dailyAt('10:40');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProducts(301, 400); })->dailyAt('10:45');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProducts(401, 500); })->dailyAt('10:50');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProducts(501, 600); })->dailyAt('10:55');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProducts(601, 700); })->dailyAt('11:00');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProducts(801, 800); })->dailyAt('11:05');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProducts(801, 900); })->dailyAt('11:10');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProducts(901, 1000); })->dailyAt('11:15');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProducts(1001, 1100); })->dailyAt('11:20');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProducts(1101, 1200); })->dailyAt('11:25');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProducts(1201, 1300); })->dailyAt('11:30');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProducts(1301, 1400); })->dailyAt('11:35');

        /** Clone Store products init */
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductInitPrice(1, 100); })->dailyAt('10:30');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductInitPrice(101, 200); })->dailyAt('10:35');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductInitPrice(201, 300); })->dailyAt('10:40');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductInitPrice(301, 400); })->dailyAt('10:45');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductInitPrice(401, 500); })->dailyAt('10:50');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductInitPrice(501, 600); })->dailyAt('10:55');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductInitPrice(601, 700); })->dailyAt('11:00');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductInitPrice(801, 800); })->dailyAt('11:05');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductInitPrice(801, 900); })->dailyAt('11:10');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductInitPrice(901, 1000); })->dailyAt('11:15');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductInitPrice(1001, 1100); })->dailyAt('11:20');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductInitPrice(1101, 1200); })->dailyAt('11:25');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductInitPrice(1201, 1300); })->dailyAt('11:30');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductInitPrice(1301, 1400); })->dailyAt('11:35');

        /** Clone Store products variant */
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductPriceVariant(1, 100); })->dailyAt('10:30');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductPriceVariant(101, 200); })->dailyAt('10:35');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductPriceVariant(201, 300); })->dailyAt('10:40');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductPriceVariant(301, 400); })->dailyAt('10:45');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductPriceVariant(401, 500); })->dailyAt('10:50');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductPriceVariant(501, 600); })->dailyAt('10:55');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductPriceVariant(601, 700); })->dailyAt('11:00');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductPriceVariant(801, 800); })->dailyAt('11:05');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductPriceVariant(801, 900); })->dailyAt('11:10');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductPriceVariant(901, 1000); })->dailyAt('11:15');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductPriceVariant(1001, 1100); })->dailyAt('11:20');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductPriceVariant(1101, 1200); })->dailyAt('11:25');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductPriceVariant(1201, 1300); })->dailyAt('11:30');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductPriceVariant(1301, 1400); })->dailyAt('11:35');

        /** Clone Store products fixed price */
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductPriceFixed(1, 100); })->dailyAt('10:30');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductPriceFixed(101, 200); })->dailyAt('10:35');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductPriceFixed(201, 300); })->dailyAt('10:40');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductPriceFixed(301, 400); })->dailyAt('10:45');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductPriceFixed(401, 500); })->dailyAt('10:50');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductPriceFixed(501, 600); })->dailyAt('10:55');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductPriceFixed(601, 700); })->dailyAt('11:00');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductPriceFixed(801, 800); })->dailyAt('11:05');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductPriceFixed(801, 900); })->dailyAt('11:10');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductPriceFixed(901, 1000); })->dailyAt('11:15');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductPriceFixed(1001, 1100); })->dailyAt('11:20');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductPriceFixed(1101, 1200); })->dailyAt('11:25');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductPriceFixed(1201, 1300); })->dailyAt('11:30');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchProductPriceFixed(1301, 1400); })->dailyAt('11:35');

        /** Clone user data */
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchUsers(1, 100); })->dailyAt('11:40');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchUsers(101, 200); })->dailyAt('11:45');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchUsers(201, 300); })->dailyAt('11:50');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchUsers(301, 400); })->dailyAt('11:55');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchUsers(401, 500); })->dailyAt('12:00');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchUsers(501, 600); })->dailyAt('12:05');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchUsers(601, 700); })->dailyAt('12:10');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchUsers(701, 800); })->dailyAt('12:15');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchUsers(801, 900); })->dailyAt('12:20');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchUsers(901, 1000); })->dailyAt('12:25');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchUsers(1001, 1100); })->dailyAt('12:30');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchUsers(1101, 1200); })->dailyAt('12:35');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchUsers(1201, 1300); })->dailyAt('12:40');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchUsers(1301, 1400); })->dailyAt('12:45');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchUsers(1401, 1500); })->dailyAt('12:50');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchUsers(1501, 1600); })->dailyAt('12:55');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchUsers(1601, 1700); })->dailyAt('13:00');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchUsers(1701, 1800); })->dailyAt('13:05');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchUsers(1801, 1900); })->dailyAt('13:10');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchUsers(1901, 2000); })->dailyAt('13:15');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchUsers(2001, 2100); })->dailyAt('13:20');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchUsers(2101, 2200); })->dailyAt('13:25');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchUsers(2201, 2300); })->dailyAt('13:30');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchUsers(2301, 2400); })->dailyAt('13:35');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchUsers(2401, 2500); })->dailyAt('13:45');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchUsers(2501, 2600); })->dailyAt('13:45');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchUsers(2601, 2700); })->dailyAt('13:50');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchUsers(2701, 2800); })->dailyAt('13:55');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchUsers(2801, 2900); })->dailyAt('14:00');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchUsers(2901, 2000); })->dailyAt('14:05');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchUsers(2001, 3100); })->dailyAt('14:10');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchUsers(3101, 3200); })->dailyAt('14:15');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchUsers(3201, 3300); })->dailyAt('14:25');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchUsers(3301, 3400); })->dailyAt('14:30');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchUsers(3401, 3500); })->dailyAt('14:35');
        $schedule->call(function () { \Project\Foxcity\CloneData::fetchUsers(3501, 3600); })->dailyAt('14:40');

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
