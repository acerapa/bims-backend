<?php

namespace App\Http\Controllers\plugin_photo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * plugin_photo/upload?image=[blob]&tagged=PRODUCT_REFID&tag_list=['PRODUCT_REFID','STORE_REFID']&filename=&description=&user_refid=&fetch_list_key=PRODUCT_REFID
 */

class Upload extends Controller
{
    public static function upload(Request $request) {

        $ext            = $request['image']->extension();
        $path           = $request['image']->path();
        $file           = $request['image']->getRealPath();
        $size           = $request['image']->getSize();

        $ftp_hostname 	= env("FTP_SERVER_HOSTNAME_1");
        $ftp_username 	= env("FTP_SERVER_USERNAME_1");
        $ftp_password 	= env("FTP_SERVER_PASSWORD_1");
        $date   		= date('m').date('d').date('Y').date('h').date('i').date('s');
        $char   		= str_shuffle("1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ");
        $reference_id  	= "IMG-".$date."-".substr($char, 0, 3);

        $ftpcon 		= ftp_connect($ftp_hostname) or die('Error connecting to ftp server...');
        $ftplogin 		= ftp_login($ftpcon, $ftp_username, $ftp_password);
        $remote_path 	= date('Y').'/'.date('m') . '/'. $reference_id . '.' .$ext;
        $server_no      = 1;
        $hostlink       = env("FTP_SERVER_HOSTLINK_1");

        if (ftp_put($ftpcon, env("FTP_SERVER_ROOR_DIR_1") . $remote_path, $_FILES['image']['tmp_name'], FTP_BINARY)) {

            $header = DB::table("plugin_photo")->insert([
                "reference_id"      => $reference_id,
                "filepath"          => $remote_path,
                "tagged"            => $request['tagged'],
                "filename"          => $request['filename'],
                "description"       => $request['description'],
                "size"              => $size,
                "extension"         => $ext,
                "server_no"         => $server_no,
                "created_by"        => $request['user_refid']
            ]);

            $tag_list = json_decode($request['tag_list']);

            foreach($tag_list as $tag) {
                DB::table("plugin_photo_tagging")->insert([
                    "photo_refid"       => $reference_id,
                    "tagged"            => $tag,
                    "created_by"        => $request['user_refid']
                ]);
            }

            $fetch_list_key = $request['fetch_list_key'];

            $list = DB::table("plugin_photo")
                ->select("reference_id","filepath","filename","description","size","extension")
                ->where("tagged", $fetch_list_key)
                ->orderBy("dataid","DESC")
                ->get();

            return [
                "success"		=> true,
                "reference_id" 	=> $reference_id,
                "remote_path"	=> $remote_path,
                "ext"           => $ext,
                "size"          => $size,
                "upload_list"   => $list,
                "hostlink"      => $hostlink
            ];
        }
        else {
            return [
                "success"		=> false,
                "reference_id" 	=> null,
                "remote_path"	=> null,
                "ext"           => null,
                "size"          => 0,
                "upload_list"   => []
            ];
        }
        ftp_close($ftpcon);
    }
}
