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
        $headers = ['Content-Type' => 'application/json; charset=UTF-8']; //Header para ñ y acentos

        if(!is_numeric($zip_code)){return response()->json(['error' => 'El código postal debe ser numérico'], 400, $headers, JSON_UNESCAPED_UNICODE);}
       
        $zip_code = ZipCode::with('federal_entity', 'settlements','municipality')->where('zip_code', $zip_code)->first();

        if(!$zip_code){return response()->json(['error' => 'No se encontró el código postal'], 400, $headers, JSON_UNESCAPED_UNICODE);}

        return response()->json($zip_code, 200, $headers, JSON_UNESCAPED_UNICODE);
    }

    public function webZipCode($zip_code)
    {
        if(!is_numeric($zip_code)) {return redirect()->route('home')->with('error', 'El código postal debe ser numérico');}

        $zip_code = ZipCode::with('federal_entity', 'settlement','municipality')->where('zip_code', $zip_code)->first();

        if(!$zip_code) {return redirect()->route('home')->with('error', 'El código postal no existe');}

        return view('home', compact('zip_code'));
    }
}
