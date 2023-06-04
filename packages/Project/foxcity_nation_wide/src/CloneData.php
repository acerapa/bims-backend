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
     * RUN: foxcity/fetchStores?from=5&to=9
    */
    public static function fetchStores(Request $request) {

        $from   = floatval($request['from']) - 1;
        $to     = floatval($request['to']) + 1;

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
     */
    public static function fetchStoresFixLogo() {
        $data = DB::table("plugin_store")
        ->select("dataid","name","photo_refid_logo")
        ->where("photo_refid_logo","like","IMG-%")
        ->limit(10)
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

        return $list;
    }

    /**
     * Fix store cover photo
     * RUN: foxcity/fetchStoresFixCover
     */
    public static function fetchStoresFixCover() {
        $data = DB::table("plugin_store")
        ->select("dataid","name","photo_refid_cover")
        ->where("photo_refid_cover","like","IMG-%")
        ->limit(10)
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

        return $list;
    }
}