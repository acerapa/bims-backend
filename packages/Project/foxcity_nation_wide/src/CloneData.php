<?php

namespace Project\Foxcity;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

/**
 * https://www.tutorialrepublic.com/php-tutorial/php-mysql-connect.php
 */

class CloneData extends Controller
{
    /**
     * Create connection to old database
     */
    public static function connection() {
        $servername     = "185.201.9.191";
        $username       = "foxc_foxcity";
        $password       = "ovy2hcHxx22uLwqe";
        $database       = "foxc_foxcity";
        $connection     = mysqli_connect($servername, $username, $password, $database);
        $connection->set_charset("utf8");
        return $connection;
    }

    /**
     * Clone store data by creating or updating existing
     * RUN: foxcity/fetchStores/1/10
     * RUN: \Project\Foxcity\CloneData::fetchStores(1, 250);
    */
    public static function fetchStores($from, $to) {

        $from   = floatval($from) - 1;
        $to     = floatval($to) + 1;

        $connection     = CloneData::connection();
        $sql = "SELECT * FROM shop_food WHERE dataid > " . $from . " AND dataid < " . $to;
        if($result = mysqli_query($connection, $sql)){
            if(mysqli_num_rows($result) > 0){
                $list = [];
                while($row = mysqli_fetch_array($result)){
                    $exist                      = \App\Http\Controllers\plugin_query\IsExist::isExist("plugin_store", [['reference_id','=', $row['reference_id']]]);
                    $store                      = [
                        "reference_id"          => $row['reference_id'],
                        "name"                  => $row['name'],
                        "branch_refid"          => $row['branch'],
                        "store_type"            => $row['service_type'],
                        "description"           => $row['about'],
                        "mobile"                => $row['mobile'],
                        "email"                 => $row['email'],
                        "address"               => $row['address_text'],
                        "geo_lat"               => json_decode($row['address_geo'])->lat,
                        "geo_lng"               => json_decode($row['address_geo'])->lon,
                        "loc_region"            => $row['location_region'],
                        "loc_province"          => $row['location_province'],
                        "loc_city"              => $row['location_city'],
                        "loc_brgy"              => $row['location_brgy'],
                        "photo_refid_cover"     => $row['img_refid_banner'],
                        "photo_refid_logo"      => $row['img_refid_logo'],
                        "created_by"            => "USR-033121093459-TCS",
                        "last_modefied"         => date("Y-m-d h:i:s"),
                        "open"                  => $row['open'],
                    ];

                    if($exist == 0) {
                        DB::table("plugin_store")->insert($store);
                        $action = "Created";
                    }
                    else {
                        DB::table("plugin_store")
                        ->where("reference_id", $row['reference_id'])
                        ->update($store);
                        $action = "Updated";
                    }

                    $list[] = [
                        "data"      => $store,
                        "action"    => $action
                    ];
 
                }
                \App\Http\Controllers\plugin_user_notifications\Create::create("USR-033121093459-TCS", "info", "Clone Data", "fetchStores from ".$from." to ".$to);
                return $list;
            }
            else {
                return [
                    "success"   => false
                ];
            }
        }
    }

    /**
     * Fix store logo
     * RUN: foxcity/fetchStoresFixLogo
     * RUN: \Project\Foxcity\CloneData::fetchStoresFixLogo();
     */
    public static function fetchStoresFixLogo() {
        $data = DB::table("plugin_store")
        ->select("dataid","name","photo_refid_logo")
        ->where("photo_refid_logo","like","IMG-%")
        ->limit(250)
        ->get();

        $list = [];
        if(count($data) > 0) {
            $connection     = CloneData::connection();
            for($i = 0; $i < count($data); $i++) {
                $sql = "SELECT * FROM photo WHERE reference_id = '".$data[$i]->photo_refid_logo."'";
                if($result = mysqli_query($connection, $sql)){
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_array($result)){
                            $formatted = [$data[$i]->photo_refid_logo, "https://foxcityph.tech/fileserver/" . $row['file_path']];
                            $list[] = [
                                "header"  => $data[$i],
                                "photo"   => [
                                    "file_path"     => "https://foxcityph.tech/fileserver/" . $row['file_path'],
                                    "extension"     => $row['extension']
                                ],
                                "formatted"         => $formatted
                            ];

                            DB::table("plugin_store")->where("dataid", $data[$i]->dataid)->update(["photo_refid_logo" => $formatted]);
                        }
                    }
                }
            }

        }
        \App\Http\Controllers\plugin_user_notifications\Create::create("USR-033121093459-TCS", "info", "Clone Data", "fetchStoresFixLogo");
        return $list;
    }

    /**
     * Fix store cover photo
     * RUN: foxcity/fetchStoresFixCover
     * RUN: \Project\Foxcity\CloneData::fetchStoresFixCover();
     */
    public static function fetchStoresFixCover() {
        $data = DB::table("plugin_store")
        ->select("dataid","name","photo_refid_cover")
        ->where("photo_refid_cover","like","IMG-%")
        ->limit(250)
        ->get();

        $list = [];
        if(count($data) > 0) {
            $connection     = CloneData::connection();
            for($i = 0; $i < count($data); $i++) {
                $sql = "SELECT * FROM photo WHERE reference_id = '".$data[$i]->photo_refid_cover."'";
                if($result = mysqli_query($connection, $sql)){
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_array($result)){
                            $formatted = [$data[$i]->photo_refid_cover, "https://foxcityph.tech/fileserver/" . $row['file_path']];
                            $list[] = [
                                "header"  => $data[$i],
                                "photo"   => [
                                    "file_path"     => "https://foxcityph.tech/fileserver/" . $row['file_path'],
                                    "extension"     => $row['extension']
                                ],
                                "formatted"         => $formatted
                            ];

                            DB::table("plugin_store")->where("dataid", $data[$i]->dataid)->update(["photo_refid_cover" => $formatted]);
                        }
                    }
                }
            }

        }

        \App\Http\Controllers\plugin_user_notifications\Create::create("USR-033121093459-TCS", "info", "Clone Data", "fetchStoresFixCover");
        return $list;
    }

    /**
     * Clone store menu group
     * RUN: foxcity/fetchStoresMenuGroup/151/200
     * RUN: \Project\Foxcity\CloneData::fetchStoresMenuGroup(1, 100);
     */
    public static function fetchStoresMenuGroup($from, $to) {
        $connection     = CloneData::connection();
        $sql            = "SELECT * FROM shop_food_product_group WHERE dataid > " . $from . " AND dataid < " . $to;
        $list           = [];
        if($result = mysqli_query($connection, $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                    $exist                      = \App\Http\Controllers\plugin_query\IsExist::isExist("plugin_store_menu_group", [['reference_id','=', $row['reference_id']]]);
                    if($exist) {
                        $action     = "Updated";
                        $executed   = DB::table("plugin_store_menu_group")
                        ->where("reference_id", $row['reference_id'])
                        ->update([
                            "store_refid"   => $row['shop_refid'],
                            "name"          => $row['name'],
                            "created_by"    => $row['created_by_refid']
                        ]);
                    }
                    else {
                        $action     = "Created";
                        $executed   = DB::table("plugin_store_menu_group")
                        ->insert([
                            "reference_id"  => $row['reference_id'],
                            "store_refid"   => $row['shop_refid'],
                            "name"          => $row['name'],
                            "created_by"    => $row['created_by_refid']
                        ]);
                    }
                    $list[] = [
                        "dataid"                => $row['dataid'],
                        "reference_id"          => $row['reference_id'],
                        "name"                  => $row['name'],
                        "shop_refid"            => $row['shop_refid'],
                        "created_by_refid"      => $row['created_by_refid'],
                        "exist"                 => $exist,
                        "executed"              => $executed
                    ];
                }
            }
            \App\Http\Controllers\plugin_user_notifications\Create::create("USR-033121093459-TCS", "info", "Clone Data", "fetchStoresMenuGroup from ". $from ." to ". $to);
            return $list;
        }
        else {
            return [];
        }
    }

    /**
     * Copy product basic info
     * RUN: foxcity/fetchProducts/881/900
     * RUN: \Project\Foxcity\CloneData::fetchProducts(1, 100);
     */
    public static function fetchProducts($from, $to) {

        $from   = floatval($from) - 1;
        $to     = floatval($to) + 1;

        $connection     = CloneData::connection();
        $sql = "SELECT * FROM product_food WHERE dataid > " . $from . " AND dataid < " . $to;
        if($result = mysqli_query($connection, $sql)){
            if(mysqli_num_rows($result) > 0){
                $list = [];
                while($row = mysqli_fetch_array($result)){
                    $action                     = "";
                    $exist                      = \App\Http\Controllers\plugin_query\IsExist::isExist("plugin_product", [['reference_id','=', $row['reference_id']]]);
                    $product                    = [
                        "reference_id"          => $row['reference_id'],
                        "store_SKU"             => $row['sku'],
                        "store_barcode"         => $row['barcode'],
                        "store_refid"           => $row['shop_refid'],
                        "name"                  => $row['name'],
                        "description"           => $row['description'],
                        "created_by"            => $row['created_by_refid'],
                        "status"                => $row['status']
                    ];
                    if($exist) {
                        DB::table("plugin_product")
                        ->where("reference_id", $row['reference_id'])
                        ->update($product);
                        $action = "Update";
                        
                    }
                    else {
                        DB::table("plugin_product")->insert($product);
                        $action = "Created";
                    }

                    $list[] = [
                        "product"   => $product,
                        "action"    => $action
                    ];
                }

                \App\Http\Controllers\plugin_user_notifications\Create::create("USR-033121093459-TCS", "info", "Clone Data", "fetchProducts from ". $from ." to ". $to);
                return $list;
            }
        }
    }

    /**
     * Create initial price data
     * RUN: foxcity/fetchProductInitPrice/1251/1300
     * RUN: \Project\Foxcity\CloneData::fetchProductInitPrice(1, 100);
     */
    public static function fetchProductInitPrice($from, $to) {

        $from       = floatval($from) - 1;
        $to         = floatval($to) + 1;
        $list       = [];

        $source     = DB::table("plugin_product")
        ->select("dataid","reference_id")
        ->where([
            ["dataid",">", $from],
            ["dataid","<", $to]
        ])
        ->get();

        for($i = 0; $i < count($source); $i++) {
            $exist           = \App\Http\Controllers\plugin_query\IsExist::isExist("plugin_product_pricing", [['product_refid','=', $source[$i]->reference_id]]);
            $list[]          = [
                "header"        => $source[$i],
                "exist"         => $exist
            ];
            if($exist == false) {
                DB::table("plugin_product_pricing")->insert([
                    "product_refid" => $source[$i]->reference_id,
                    "created_by"    => "USR-033121093459-TCS"
                ]);
            }
        }

        \App\Http\Controllers\plugin_user_notifications\Create::create("USR-033121093459-TCS", "info", "Clone Data", "fetchProductInitPrice from ". $from ." to ". $to);
        return $list;
    }

    /**
     * Update price variant
     * RUN: foxcity/fetchProductPriceVariant/251/300
     */
    public static function fetchProductPriceVariant($from, $to) {
        $from   = floatval($from) - 1;
        $to     = floatval($to) + 1;
        $list   = [];

        $connection     = CloneData::connection();
        $sql = "SELECT dataid,product_refid,label,options,created_by_refid FROM product_food_option_group WHERE dataid > " . $from . " AND dataid < " . $to;
        if($result = mysqli_query($connection, $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                    
                    $product_refid              = $row['product_refid'];
                    $label                      = $row['label'];
                    $options                    = json_decode($row['options']);
                    $new_options                = [];

                    if((is_array($options)) && (count($options) > 0)){
                        for($i = 0; $i < count($options); $i++) {
                            if((isset($options[$i]->price_origin)) && (isset($options[$i]->label))) {
                                $new_options[] = [
                                    "label" => $options[$i]->label,
                                    "price" => floatval($options[$i]->price_origin),
                                    "photo" => null
                                ];
                            }
                        }
                    }

                    $updated = DB::table("plugin_product_pricing")
                    ->where("product_refid", $product_refid)
                    ->update([
                        "price_variants_label"  => $label,
                        "price_variants"        => json_encode($new_options),
                        "price_type"            => "VP"
                    ]);

                    $list[] = [
                        "dataid"        => $row['dataid'],
                        "product_refid" => $product_refid,
                        "label"         => $label,
                        "options"       => $new_options,
                        "updated"       => $updated
                    ];

                }
            }

            \App\Http\Controllers\plugin_user_notifications\Create::create("USR-033121093459-TCS", "info", "Clone Data", "fetchProductPriceVariant from ". $from ." to ". $to);
            return $list;
        }
    }

    /**
     * Fix fixed price
     * RUN: foxcity/fetchProductPriceFixed/71/100
     */
    public static function fetchProductPriceFixed($from, $to) {
        
        $from   = floatval($from) - 1;
        $to     = floatval($to) + 1;
        $list   = [];

        $connection     = CloneData::connection();
        $sql            = "SELECT dataid,product_refid,price,price_origin,created_by_refid FROM product_food_price WHERE dataid > " . $from . " AND dataid < " . $to;
        if($result = mysqli_query($connection, $sql)){
            $list = [];
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                    $product_refid = $row['product_refid'];
                    $price = 0;
                    if($row['price_origin']) {
                        $price = $row['price_origin'];
                    }
                    else if($row['price']) {
                        $price = $row['price'];
                    }
                    else {
                        $price = 0;
                    }

                    $init = DB::table("plugin_product_pricing")->select("price_type")->where("product_refid", $product_refid)->get();
                    $price_type = "";
                    $executed = false;
                    if(count($init) > 0) {
                        if($init[0]->price_type == 'VP') {
                            $executed = DB::table("plugin_product_pricing")
                            ->where("product_refid", $product_refid)
                            ->update([
                                "price"         => $price,
                            ]);
                            $price_type = "VP";
                        }
                        else {
                            $executed = DB::table("plugin_product_pricing")
                            ->where("product_refid", $product_refid)
                            ->update([
                                "price"         => $price,
                                "price_type"    => "SP"
                            ]);
                            $price_type = "SP";
                        }
                    }

                    $list[] = [
                        "dataid"                => $row['dataid'],
                        "product_refid"         => $product_refid,
                        "price_origin"          => $price,
                        "price_type"            => $price_type,
                        "executed"              => $executed,
                        "created_by_refid"      => $row['created_by_refid']
                    ];
                }
            }
            \App\Http\Controllers\plugin_user_notifications\Create::create("USR-033121093459-TCS", "info", "Clone Data", "fetchProductPriceFixed from ". $from ." to ". $to);
            return $list;
        }
    }

    /**
     * Copy user info
     * RUN: foxcity/fetchUsers/401/450
     */
    public static function fetchUsers($from, $to) {

        $from   = floatval($from) - 1;
        $to     = floatval($to) + 1;
        $list   = [];

        $connection     = CloneData::connection();
        $sql            = "SELECT * FROM user WHERE dataid > " . $from . " AND dataid < " . $to;
        $list           = [];

        if($result = mysqli_query($connection, $sql)){
            $list = [];
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                    $exist              = \App\Http\Controllers\plugin_query\IsExist::isExist("plugin_user", [['reference_id','=', $row['reference_id']]]);
                    $user_info          = [
                        "reference_id"  => $row['reference_id'],
                        "firstname"     => $row['first_name'],
                        "lastname"      => $row['last_name'],
                        "mobile"        => $row['mobile'],
                        "email"         => $row['email'],
                        "password"      => $row['password'],
                        "location_json" => $row['location_json'],
                        "location_gps"  => $row['location_gps'],
                        "firebase_token"=> $row['firebase_notify_token']
                    ];
                    if($exist) {
                        $executed = DB::table("plugin_user")->where("reference_id", $row['reference_id'])->update($user_info);
                    }
                    else {
                        $executed = DB::table("plugin_user")->insert($user_info);
                    }

                    $list[] = [
                        "dataid"    => $row['dataid'],
                        "header"    => $user_info,
                        "exist"     => $exist,
                        "executed"  => $executed
                    ];
                }
            }

            \App\Http\Controllers\plugin_user_notifications\Create::create("USR-033121093459-TCS", "info", "Clone Data", "fetchUsers from ". $from ." to ". $to);
            return $list;
        }
    }

}