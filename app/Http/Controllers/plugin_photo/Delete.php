<?php

namespace App\Http\Controllers\plugin_photo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * plugin_photo/delete_photo?path=2023/05/IMG-05132023051910-X8C.jpg&photo_refid=PHOTO_REFID&fetch_list_key=PRODUCT_REFID
 * 
 */

class Delete extends Controller
{
    public static function delete(Request $request) {

        $ftp_hostname 	= env("FTP_SERVER_HOSTNAME_1");
        $ftp_username 	= env("FTP_SERVER_USERNAME_1");
        $ftp_password 	= env("FTP_SERVER_PASSWORD_1");
        $file_to_remove	= $request['path'];
        $photo_refid    = $request['photo_refid'];

        $ftpcon         = ftp_connect($ftp_hostname) or die('Error connecting to ftp server...');
        $ftplogin       = ftp_login($ftpcon, $ftp_username, $ftp_password);

        if (ftp_delete($ftpcon, env("FTP_SERVER_ROOR_DIR_1") . $file_to_remove)) {

            DB::table("plugin_photo")->where("reference_id", $photo_refid)->delete();
            DB::table("plugin_photo_tagging")->where("photo_refid", $photo_refid)->delete();

            if($request['fetch_list_key'] !== null) {
                $fetch_list_key = $request['fetch_list_key'];
                $upload_list    = DB::table("plugin_photo")->select("reference_id","filepath","filename","description","size","extension")->where("tagged", $fetch_list_key)->orderBy("dataid","DESC")->get();
            }
            else {
                $upload_list    = [];
            }

            return [
                "success"       => true,
                "message"       => "Successfully deleted",
                "upload_list"   => $upload_list
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Deletion denied",
            ];
        }
    }
}

