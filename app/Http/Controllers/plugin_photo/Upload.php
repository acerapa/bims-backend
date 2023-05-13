<?php

namespace App\Http\Controllers\plugin_photo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * api/plugin_photo/upload?test=1
 */

class Upload extends Controller
{
    public static function upload(Request $request) {

        $ext        = $request['image']->extension();
        $path       = $request['image']->path();
        $file       = $request['image']->getRealPath();
        $size       = $request['image']->getSize();

        $ftp_hostname 	= "185.201.9.191";
        $ftp_username 	= "admin_foxcity";
        $ftp_password 	= "FyDCGjynEt#yv8wG";
        $date   		= date('m').date('d').date('Y').date('h').date('i').date('s');
        $char   		= str_shuffle("1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ");
        $reference_id  	= "IMG-".$date."-".substr($char, 0, 3);

        $ftpcon 		= ftp_connect($ftp_hostname) or die('Error connecting to ftp server...');
        $ftplogin 		= ftp_login($ftpcon, $ftp_username, $ftp_password);
        $remote_path 	= date('Y').'/'.date('m') . '/'. $reference_id . '.' .$ext;

        if (ftp_put($ftpcon, 'public_html/fileserver/' . $remote_path, $_FILES['image']['tmp_name'], FTP_BINARY)) {
            return [
                "success"		=> true,
                "reference_id" 	=> $reference_id,
                "remote_path"	=> $remote_path,
                "ext"           => $ext,
                "path"          => $path,
                "file"          => $file,
                "size"          => $size
            ];
        }
        else {
            return [
                "success"		=> false,
                "reference_id" 	=> null,
                "remote_path"	=> null,
                "ext"           => null,
                "path"          => null,
                "file"          => null,
                "size"          => 0
            ];
        }
        ftp_close($ftpcon);
    }
}
