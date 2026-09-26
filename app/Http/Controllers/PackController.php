<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\classes\homeSetting;
use App\Models\pack;
use App\Models\product;
use App\Models\packGallery;
use App\Models\product_pack;

class PackController extends Controller
{
    public function create(){
        $products = product::all();
        $setting = homeSetting::document();
        return view('admin.pack.create', ['setting'=>$setting, 'products'=>$products]);
    }

    public function store(Request $request){
        dd($request->all());
    }
}
