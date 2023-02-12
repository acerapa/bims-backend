<?php

namespace App\Http\Controllers\plugin_photo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/*

plugin_photo/saveInfoTemp?reference_id=1&filepath=filepath&tagged=tagged&user_refid=
plugin_photo/saveInfoVerify?reference_id=IMG-01092023015558-UQ1&filename=filename&description=description
plugin_photo/tagFixer
plugin_photo/getPhotos?tagged=PCK-12292022095617-EU8&page=1&row_per_page=2&orderByColumn=photo.dataid&orderBySort=DESC
plugin_photo/photoTagging/photo_refid/package_refid/jason
plugin_photo/removeTag/photo_refid/tagged
plugin_photo/delete/photo_refid

*/

class Photos extends Controller
{
  public static function saveInfoTemp(Request $request) {
    return \App\Http\Controllers\plugin_photo\Config::saveInfoTemp($request);
  }

  public static function saveInfoVerify(Request $request) {
    return \App\Http\Controllers\plugin_photo\Config::saveInfoVerify($request);
  }

  public static function tagFixer(Request $request) {
    return \App\Http\Controllers\plugin_photo\Config::tagFixer($request);
  }

  public static function getPhotos(Request $request) {
    return \App\Http\Controllers\plugin_photo\Config::getPhotos($request);
  }

  public static function photoTagging($photo_refid, $package_refid, $created_by) {
    return \App\Http\Controllers\plugin_photo\Config::photoTagging($photo_refid, $package_refid, $created_by);
  }
  
  public static function removeTag($photo_refid, $tagged) {
    return \App\Http\Controllers\plugin_photo\Config::removeTag($photo_refid, $tagged);
  }

  public static function delete($photo_refid) {
    return \App\Http\Controllers\plugin_photo\Config::delete($photo_refid);
  }
}
