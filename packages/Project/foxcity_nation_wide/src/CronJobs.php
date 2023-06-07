<?php

namespace Project\Foxcity;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CronJobs extends Controller
{
    public static function test($value) {
        return $value;
    }

    public static function execute() {

        $file_path      = "foxcity_nation_wide/execute.json";
        $json_exist     = \App\Http\Controllers\plugin_json_data\Exist::JSONExist($file_path);
        $list           = [
            \Project\Foxcity\CloneData::fetchStores(1, 50),
            \Project\Foxcity\CloneData::fetchStores(51, 100),
            \Project\Foxcity\CloneData::fetchStores(100, 150),
            \Project\Foxcity\CloneData::fetchStores(151, 200),
            \Project\Foxcity\CloneData::fetchStoresFixLogo(),
            \Project\Foxcity\CloneData::fetchStoresFixLogo(),
            \Project\Foxcity\CloneData::fetchStoresFixCover(),
            \Project\Foxcity\CloneData::fetchStoresFixCover(),
            \Project\Foxcity\CloneData::fetchStoresMenuGroup(1, 50),
            \Project\Foxcity\CloneData::fetchStoresMenuGroup(51, 100),
            \Project\Foxcity\CloneData::fetchStoresMenuGroup(101, 150),
            \Project\Foxcity\CloneData::fetchProducts(1, 50),
            \Project\Foxcity\CloneData::fetchProducts(51, 100),
            \Project\Foxcity\CloneData::fetchProducts(101, 150),
            \Project\Foxcity\CloneData::fetchProducts(200, 250),
            \Project\Foxcity\CloneData::fetchProducts(251, 300),
            \Project\Foxcity\CloneData::fetchProducts(300, 350),
            \Project\Foxcity\CloneData::fetchProducts(351, 400),
            \Project\Foxcity\CloneData::fetchProducts(450, 500),
            \Project\Foxcity\CloneData::fetchProducts(501, 550),
            \Project\Foxcity\CloneData::fetchProducts(551, 600),
            \Project\Foxcity\CloneData::fetchProducts(601, 650),
            \Project\Foxcity\CloneData::fetchProducts(651, 700),
            \Project\Foxcity\CloneData::fetchProducts(701, 750),
            \Project\Foxcity\CloneData::fetchProducts(751, 800),
            \Project\Foxcity\CloneData::fetchProducts(801, 850),
            \Project\Foxcity\CloneData::fetchProducts(851, 900),
            \Project\Foxcity\CloneData::fetchProducts(901, 950),
            \Project\Foxcity\CloneData::fetchProducts(951, 1000),
            \Project\Foxcity\CloneData::fetchProducts(1001, 1050),
            \Project\Foxcity\CloneData::fetchProducts(1051, 1100),
            \Project\Foxcity\CloneData::fetchProducts(1101, 1150),
            \Project\Foxcity\CloneData::fetchProducts(1151, 1200),
            \Project\Foxcity\CloneData::fetchProducts(1201, 1250),
            \Project\Foxcity\CloneData::fetchProducts(1251, 1300),
            \Project\Foxcity\CloneData::fetchProducts(1301, 1350),
            \Project\Foxcity\CloneData::fetchProducts(1351, 1400),
            
            \Project\Foxcity\CloneData::fetchProductInitPrice(1, 100),
            \Project\Foxcity\CloneData::fetchProductInitPrice(101, 200),
            \Project\Foxcity\CloneData::fetchProductInitPrice(201, 300),
            \Project\Foxcity\CloneData::fetchProductInitPrice(301, 400),
            \Project\Foxcity\CloneData::fetchProductInitPrice(401, 500),
            \Project\Foxcity\CloneData::fetchProductInitPrice(501, 600),
            \Project\Foxcity\CloneData::fetchProductInitPrice(601, 700),
            \Project\Foxcity\CloneData::fetchProductInitPrice(801, 800),
            \Project\Foxcity\CloneData::fetchProductInitPrice(801, 900),
            \Project\Foxcity\CloneData::fetchProductInitPrice(901, 1000),
            \Project\Foxcity\CloneData::fetchProductInitPrice(1001, 1100),
            \Project\Foxcity\CloneData::fetchProductInitPrice(1101, 1200),
            \Project\Foxcity\CloneData::fetchProductInitPrice(1201, 1300),
            \Project\Foxcity\CloneData::fetchProductInitPrice(1301, 1400),

            \Project\Foxcity\CloneData::fetchProductPriceVariant(1, 100),
            \Project\Foxcity\CloneData::fetchProductPriceVariant(101, 200),
            \Project\Foxcity\CloneData::fetchProductPriceVariant(201, 300),
            \Project\Foxcity\CloneData::fetchProductPriceVariant(301, 400),
            \Project\Foxcity\CloneData::fetchProductPriceVariant(401, 500),
            \Project\Foxcity\CloneData::fetchProductPriceVariant(501, 600),
            \Project\Foxcity\CloneData::fetchProductPriceVariant(601, 700),
            \Project\Foxcity\CloneData::fetchProductPriceVariant(801, 800),
            \Project\Foxcity\CloneData::fetchProductPriceVariant(801, 900),
            \Project\Foxcity\CloneData::fetchProductPriceVariant(901, 1000),
            \Project\Foxcity\CloneData::fetchProductPriceVariant(1001, 1100),
            \Project\Foxcity\CloneData::fetchProductPriceVariant(1101, 1200),
            \Project\Foxcity\CloneData::fetchProductPriceVariant(1201, 1300),
            \Project\Foxcity\CloneData::fetchProductPriceVariant(1301, 1400),
            \Project\Foxcity\CloneData::fetchProductPriceFixed(1, 100),
            \Project\Foxcity\CloneData::fetchProductPriceFixed(101, 200),
            \Project\Foxcity\CloneData::fetchProductPriceFixed(201, 300),
            \Project\Foxcity\CloneData::fetchProductPriceFixed(301, 400),
            \Project\Foxcity\CloneData::fetchProductPriceFixed(401, 500),
            \Project\Foxcity\CloneData::fetchProductPriceFixed(501, 600),
            \Project\Foxcity\CloneData::fetchProductPriceFixed(601, 700),
            \Project\Foxcity\CloneData::fetchProductPriceFixed(801, 800),
            \Project\Foxcity\CloneData::fetchProductPriceFixed(801, 900),
            \Project\Foxcity\CloneData::fetchProductPriceFixed(901, 1000),
            \Project\Foxcity\CloneData::fetchProductPriceFixed(1001, 1100),
            \Project\Foxcity\CloneData::fetchProductPriceFixed(1101, 1200),
            \Project\Foxcity\CloneData::fetchProductPriceFixed(1201, 1300),
            \Project\Foxcity\CloneData::fetchProductPriceFixed(1301, 1400),
            \Project\Foxcity\CloneData::fetchUsers(1, 100),
            \Project\Foxcity\CloneData::fetchUsers(101, 200),
            \Project\Foxcity\CloneData::fetchUsers(201, 300),
            \Project\Foxcity\CloneData::fetchUsers(301, 400),
            \Project\Foxcity\CloneData::fetchUsers(401, 500),
            \Project\Foxcity\CloneData::fetchUsers(501, 600),
            \Project\Foxcity\CloneData::fetchUsers(601, 700),
            \Project\Foxcity\CloneData::fetchUsers(701, 800),
            \Project\Foxcity\CloneData::fetchUsers(801, 900),
            \Project\Foxcity\CloneData::fetchUsers(901, 1000),
            \Project\Foxcity\CloneData::fetchUsers(1001, 1100),
            \Project\Foxcity\CloneData::fetchUsers(1101, 1200),
            \Project\Foxcity\CloneData::fetchUsers(1201, 1300),
            \Project\Foxcity\CloneData::fetchUsers(1301, 1400),
            \Project\Foxcity\CloneData::fetchUsers(1401, 1500),
            \Project\Foxcity\CloneData::fetchUsers(1501, 1600),
            \Project\Foxcity\CloneData::fetchUsers(1601, 1700),
            \Project\Foxcity\CloneData::fetchUsers(1701, 1800),
            \Project\Foxcity\CloneData::fetchUsers(1801, 1900),
            \Project\Foxcity\CloneData::fetchUsers(1901, 2000),
            \Project\Foxcity\CloneData::fetchUsers(2001, 2100),
            \Project\Foxcity\CloneData::fetchUsers(2101, 2200),
            \Project\Foxcity\CloneData::fetchUsers(2201, 2300),
            \Project\Foxcity\CloneData::fetchUsers(2301, 2400),
            \Project\Foxcity\CloneData::fetchUsers(2401, 2500),
            \Project\Foxcity\CloneData::fetchUsers(2501, 2600),
            \Project\Foxcity\CloneData::fetchUsers(2601, 2700),
            \Project\Foxcity\CloneData::fetchUsers(2701, 2800),
            \Project\Foxcity\CloneData::fetchUsers(2801, 2900),
            \Project\Foxcity\CloneData::fetchUsers(2901, 2000),
            \Project\Foxcity\CloneData::fetchUsers(2001, 3100),
            \Project\Foxcity\CloneData::fetchUsers(3101, 3200),
            \Project\Foxcity\CloneData::fetchUsers(3201, 3300),
            \Project\Foxcity\CloneData::fetchUsers(3301, 3400),
            \Project\Foxcity\CloneData::fetchUsers(3401, 3500),
            \Project\Foxcity\CloneData::fetchUsers(3501, 3600)
        ];
        
        if($json_exist) {
            $cronjob    = \App\Http\Controllers\plugin_json_data\Get::getJSON($file_path);
            $length     = count($list) - 1;
            $index      = $cronjob['index'];

            if($length == $index) {
                $index = 0;
            }
            else {
                $index = $index + 1;
            }
            $cronjob    = ["index" => $index];
            \App\Http\Controllers\plugin_json_data\Create::createJSON($file_path, $cronjob);
        }
        else {
            $cronjob    = ["index" => 0];
            \App\Http\Controllers\plugin_json_data\Create::createJSON($file_path, $cronjob);
            $index      = 0;
        }

        $execute        = $list[$index];

        return [
            "index"     => $index,
            "length"    => $length,
            "execute"   => $execute,
            "cronjob"   => $cronjob
        ];
    }
}