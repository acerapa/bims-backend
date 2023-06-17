<?php

namespace App\Http\Controllers\plugin_project_sync;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

/**
 * 
 * http://127.0.0.1:8000/api/plugin_project_sync/init
 * http://127.0.0.1:8000/api/plugin_project_sync/target
 * http://127.0.0.1:8000/api/plugin_project_sync/sync
 * 
 * 
 * Code References:
 *  https://www.php.net/manual/en/function.scandir.php
 *  https://www.itsolutionstuff.com/post/how-can-i-get-the-path-from-laravel-application-rootexample.html
 *  https://laravel.com/api/7.x/Illuminate/Support/Facades/File.html#method_lastModified
 * 
 * Sync process:
 * 1: Make a JSON File with list of all files
 *      file_masterlist.json
 *      [
 *          {
 *              dirname: '',
 *              basename: '',
 *              extension: '',
 *              filename: '',
 *              last_modefied: [DATE],
 *              last_synced: [DATE],
 *          }
 *      ]
 *      
 * 
 */

class ReadFiles extends Controller
{
    public static function init() {
        
        $project_root       = base_path();
        $filesInFolder      = File::allFiles($project_root, true);
        $list               = [];

        foreach ($filesInFolder as $path) {
            $dirname                    = pathinfo($path)['dirname'];
            $basename                   = File::basename($path);
            $list[]     = [
                "dirname"               => $dirname,
                "extension"             => File::extension($path),
                "last_modefied"         => File::lastModified($path),
                "dirname"               => File::dirname($path),
                "basename"              => $basename,
                "synchronization"       => [
                    "target"            => substr($dirname, 50) .'\\'. $basename,
                    "synced"            => true,
                    "datetime_compared" => null,
                    "datetime_synced"   => null,
                ],
            ];
        }

        $file_path      = "plugin_project_sync/file_masterlist.json";
    
        \App\Http\Controllers\plugin_json_data\Create::createJSON($file_path, $list);
        return $list;
        
    }

    public static function target() {

        $project_root       = base_path();
        $filesInFolder      = File::allFiles($project_root, true);
        $compare_list       = [];
        
        $last_sync_date     = date("2023-05-24 00:00:00");
        $last_sync_unix     = strtotime($last_sync_date);

        foreach ($filesInFolder as $path) {
            
            $dirname                    = pathinfo($path)['dirname'];
            $basename                   = File::basename($path);
            $last_modefied              = File::lastModified($path);
            $target                     = substr($dirname, 50) .'\\'. $basename;
        
            if( $last_modefied > $last_sync_unix) {
                if(substr($target, 0, 7) == 'storage') {
                    //Skip
                }
                else {
                    $compare_list[]     = [
                        "last_modefied"     => $last_modefied,
                        "last_sync"         => $last_sync_unix,
                        "dirname"           => $dirname,
                        "target"            => $target,
                        "synced"            => false,
                        "synced_date"       => null
                    ];
                }
            }
        }

        $file_path      = "plugin_project_sync/target_files.json";
    
        \App\Http\Controllers\plugin_json_data\Create::createJSON($file_path, $compare_list);
        
        return $compare_list;
    }

    public static function sync() {

        $ftp_hostname 	= env("FTP_SERVER_HOSTNAME_1");
        $ftp_username 	= env("FTP_SERVER_USERNAME_1");
        $ftp_password 	= env("FTP_SERVER_PASSWORD_1");

        $ftpcon 		= ftp_connect($ftp_hostname) or die('Error connecting to ftp server...');
        $ftplogin 		= ftp_login($ftpcon, $ftp_username, $ftp_password);

        $jsonFile       = \App\Http\Controllers\plugin_json_data\Get::getJSON("plugin_project_sync/target_files.json");

        $synced = [];
        foreach($jsonFile as $index => $each_file) {
            
            $remote_path    = "public_html\\dataserver-nation-wide\\version-1\\" . $each_file['target'];
            $fixed_path     = str_replace("\\","/", $remote_path);
            $origin_path    = "E:\\Client-Projects\\Multi-Purpose-Back-end\\laravel\\" . $each_file['target'];

            if (ftp_put($ftpcon, $fixed_path , $origin_path, FTP_BINARY)) {
                $jsonFile[$index]['synced'] = true;
                \App\Http\Controllers\plugin_json_data\Create::createJSON("plugin_project_sync/target_files.json", $jsonFile);
                $synced[] = [
                    "success"       => true,
                    "fixed_path"    => $fixed_path,
                    "origin_path"   => $origin_path
                ];
            }
            else {
                $synced[] = [
                    "success"       => true,
                    "fixed_path"    => $fixed_path,
                    "origin_path"   => $origin_path
                ];
            }
        }

        return $synced;

        ftp_close($ftpcon);
    }
}
