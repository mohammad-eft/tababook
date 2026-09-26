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
        $path=null;
        if(isset($request->image)){
            $name = $request->image->getClientOriginalName();
            $fullName = time()."_".$name;
            $path = $request->file('image')->storeAs('productPack', $fullName, 'public');
        }
        $packId = pack::insertGetId([
            'title'=>$request->title,
            'summary'=>$request->summary,
            'description'=>$request->description,
            'primary_price'=>$request->price,
            'secondary_price'=>$request->discount,
            'image'=>$path
        ]);
        foreach($request->product as $proId){
            product_pack::create([
                'product_id'=>$proId,
                'pack_id'=>$packId
            ]);
        }
        if(isset($request->gallery)){
            foreach($request->gallery as $gallery){
                $gName = $gallery->getClientOriginalName();
                $fullGName = time().'_'.$gName;
                $gPath = $gallery->storeAs('productPack', $fullGName, 'public');
                packGallery::create([
                    'image'=>$gPath,
                    'pack_id'=>$packId
                ]);
            }
        }
        return to_route('pack.list');
    }

    public function list(){
        $setting = homeSetting::document();
        return view('admin.pack.list', ['setting'=>$setting]);
    }

    public function edit(pack $pack){
        dd($pack);
    }
}
