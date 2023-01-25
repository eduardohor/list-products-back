<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StringController extends Controller
{
    public function convertString(Request $request)
    {
        $convert = strtoupper($request->text);

        return response()->json($convert, 200);
    }
}
