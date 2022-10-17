<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ZipCode;
use App\Models\Settlement;
use App\Models\Municipality;

class ZipCodeController extends Controller
{
    public function getZipCode($zip_code)
    {
        $headers = ['Content-Type' => 'application/json; charset=UTF-8'];
        $zip_code = ZipCode::with('federal_entity', 'settlement','municipality')->where('zip_code', $zip_code)->first();
        return response()->json($zip_code, 200, $headers, JSON_UNESCAPED_UNICODE);
    }

    public function webZipCode($zip_code)
    {
        $zip_code = ZipCode::with('federal_entity', 'settlement','municipality')->where('zip_code', $zip_code)->first();
        return view('home', compact('zip_code'));
    }
}
