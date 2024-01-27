<?php

namespace Project\CIMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

/**
 * Schema
 * id
 * type: bgry-clearance, cert-residency, cert-indigency, subpoena
 * content
 * purpose
 * date (issue_date)
 * prepared_by
 * requestor
 */

 class PritableDocuments extends Controller
 {
    public static function register(Request $request) {
        $id = DB::table("cims_barangay_printables")->insertGetId($request->all());

        if ($id) {
            return [
                'success' => true,
                'message' => 'Successfully added!'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Failed to create!'
            ];
        }
    }
 }
