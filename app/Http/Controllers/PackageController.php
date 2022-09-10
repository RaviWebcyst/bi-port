<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\package;

class PackageController extends Controller
{   
    public function packages(){
        $packages = package::orderBy("id","desc")->get();
        return response()->json($packages);
    }
}
