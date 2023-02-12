<?php

namespace App\Http\Controllers\plugin_photo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*


\App\Http\Controllers\plugin_photo\Config::saveInfo($request);

Table Column:
status        0: Uploaded but temp
              1: Fully uploaded and confirmed

*/

class Config extends Controller
{
  public static function config() {
    return [
      "enable"           => true,
      "db_table"         => "photo",
      "hostname"         => "82.180.152.30",
      "username"         => "u604418523.MC_1231rich",
      "password"         => "8&*RLm/_677ui",
      "directory"        => "partition-file/"
    ];
  }

  public static function photoTagging($photo_refid, $package_refid, $created_by) {
    $tagged = Config::isTagExist($photo_refid, $package_refid);
    if($tagged) {
      return [
        "success"   => false,
        "message"   => "Requested tag already exist."
      ];
    }
    else {
      $created = DB::table("photo_tagging")->insert([
        "photo_refid" => $photo_refid,
        "tagged"      => $package_refid,
        "created_at"  => date("Y-m-d h:i:s"),
        "created_by"  => $created_by
      ]);

      if($created) {
        return [
          "success"   => true,
          "message"   => "Photo tagged successfully"
        ];
      }
      else {
        return [
          "success"   => false,
          "message"   => "Requested tag refused."
        ];
      }
    }
  }

  public static function getPhotos($request) {
    return DB::table("photo_tagging")
    ->join("photo", "photo_tagging.photo_refid", "=", "photo.reference_id")
    ->select(
      "photo.dataid",
      "photo.reference_id",
      "photo.filepath",
      "photo.filename",
      "photo.description",
      "photo.created_at",
      "photo.created_by"
    )
    ->where([
      ["photo_tagging.tagged", $request['tagged']],
      ["photo_tagging.status", "1"],
      ["photo.status", "1"]
    ])
    ->orderBy($request['orderByColumn'], $request['orderBySort'])
    ->paginate($request['row_per_page']);
  }

  public static function getPhotosByTagRefID($tagged_refid) {
    return DB::table("photo_tagging")
    ->join("photo", "photo_tagging.photo_refid", "=", "photo.reference_id")
    ->select(
      "photo.dataid",
      "photo.reference_id",
      "photo.filepath",
      "photo.filename",
      "photo.description",
      "photo.created_at",
      "photo.created_by"
    )
    ->where([
      ["photo_tagging.tagged", $tagged_refid],
      ["photo_tagging.status", "1"]
    ])
    ->orderBy("photo.dataid", "DESC")
    ->get();
  }

  public static function tagFixer() {

    $data = DB::table("photo")
    ->select("reference_id", "tagged", "created_by")
    ->where("status", "1")
    ->get();

    $list   = [];
    foreach($data as $photo) {
      $reference_id = $photo->reference_id;
      $tagged       = $photo->tagged;
      $created_by   = $photo->created_by;
      $tagExist     = Config::isTagExist($reference_id, $tagged);
      $tagCreated   = false;
      if($tagExist == false) {
      $tagCreated   = false;
        $tagCreated = DB::table("photo_tagging")->insert([
          "photo_refid"   => $reference_id,
          "tagged"        => $tagged,
          "created_at"    => date("Y-m-d h:i:s"),
          "created_by"    => $created_by
        ]);
      }

      $list[]       = [
        "reference_id"  => $reference_id,
        "tagged"        => $tagged,
        "tagExist"      => $tagExist,
        "tagCreated"    => $tagCreated
      ];
    }

    return $list;
  }

  public static function isTagExist($photo_refid, $tagged) {
    $exist = DB::table("photo_tagging")->where([
      ["photo_refid", $photo_refid],
      ["tagged", $tagged]
    ])
    ->get();

    if(count($exist) > 0) {
      return true;
    }
    else {
      return false;
    }
  }

  public static function saveInfoVerify($request) {
    $verified = DB::table(Config::config()['db_table'])
    ->where([
      ["reference_id", $request['reference_id']],
      ["status", "0"]
    ])
    ->update([
      "filename"    => $request['filename'],
      "description" => $request['description'],
      "status"      => "1"
    ]);

    if($verified) {
      return [
        "success" => true,
        "message" => "Photo information saved"
      ];
    }
    else {
      return [
        "success" => false,
        "message" => "Photo information not saved"
      ];
    }
  }

  public static function saveInfoTemp($request) {
    
    $saved = DB::table(Config::config()['db_table'])->insert([
      "reference_id"    => $request['reference_id'],
      "filepath"        => $request['filepath'],
      "tagged"          => $request['tagged'],
      "created_at"      => date("Y-m-d h:i:s"),
      "created_by"      => $request['user_refid'],
      "status"          => "0"
    ]);

    if($saved) {

      DB::table("photo_tagging")->insert([
        "photo_refid" => $request['reference_id'],
        "tagged"      => $request['tagged'],
        "created_at"  => date("Y-m-d h:i:s"),
        "created_by"  =>  $request['user_refid']
      ]);

      return [
        "success" => true,
        "message" => "Photo information saved",
        "photos"  => Config::getPhotosByTagRefID($request['tagged'])
      ];
    }
    else {
      return [
        "success" => false,
        "message" => "Photo information not saved",
        "photos"  => []
      ];
    }
  }

  public static function removeTag($photo_refid, $tagged) {
    $delete_tagging = DB::table("photo_tagging")
    ->where([
      ["photo_refid", $photo_refid],
      ["tagged", $tagged]
    ])
    ->delete();

    if($delete_tagging) {
      return [
        "success" => true,
        "message" => "Tag successfully removed",
        "tagging" => $delete_tagging
      ];
    }
    else {
      return [
        "success" => false,
        "message" => "System refused tag removal request"
      ];
    }
  }

  public static function delete($photo_refid) {

    $delete_photo   = DB::table("photo")->where("reference_id", $photo_refid)->delete();
    
    if($delete_photo) {
      $delete_tagging = DB::table("photo_tagging")->where("photo_refid", $photo_refid)->delete();
      return [
        "success" => true,
        "message" => "Photo successfully deleted",
        "tagging" => $delete_tagging
      ];
    }
    else {
      return [
        "success" => false,
        "message" => "System refused delete request"
      ];
    }
  }
}
