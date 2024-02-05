<?php

namespace Project\CIMS;

use Carbon\Carbon;
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
        $data = $request->all();

        $data['issue_date'] = Carbon::parse($data['issue_date']);

        $id = DB::table("cims_barangay_printables")->insertGetId($data);

        if ($id) {
            return [
                'data' => [
                    'id' => $id,
                    'captain' => $data['captain'],
                    'secretary' => $data['secretary'],
                    'requestor' => $data['requestor'],
                ],
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
