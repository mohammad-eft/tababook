<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\classes\homeSetting;
use App\Models\attribute;
use App\Models\category;
use App\Models\publication;
use App\Models\brand;
use App\Models\package_attribute;
use App\Models\product;
use App\Models\product_attributes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class BrandController extends Controller
{
    public function create(){
        $setting = homeSetting::document();
        return view('admin.brand.create',['setting'=>$setting]);
        dd('create');
    }
    public function store(Request $request){
        // dd($request->all());

        $validate=$request->validate(
        [
            'title'=>['required'],
        ],[
            'title.required'=>'فیلد مورد نظر را پر کنید',
        ]);
        $path=null;
        if(isset($request->logo_path) && $request->logo_path!=null){
            $fullName=Str::uuid().$request->logo_path->getClientOriginalName();
            $path=$request->file("logo_path")->storeAs("brand_medias",$fullName,"public");
        }
        $created_brand=brand::create([
            'title'=>$validate['title'],
            'logo_path'=>$path,
            'description'=>$request['description'],
            'show_in_home'=>$request['show_in_home'],
            'is_active'=>$request['is_active'],
        ]);
        return to_route('brand.list');
        dd('store');
    }
    public function list(){
        $setting = homeSetting::document();
        $brands=brand::all();
        foreach($brands as $brand){
            if(!$brand->logo_path){
                $brand->logo_path = 'noImage.png';
            }
        }
        return view('admin.brand.list',['brands'=>$brands,'setting'=>$setting]);
        dd('list');
    }
    public function single(brand $brand){
        $setting = homeSetting::document();
        return view('admin.brand.single',['brand'=>$brand,'setting'=>$setting]);
        dd('single');
    }
    public function edit(brand $brand){
        $setting = homeSetting::document();
        return view('admin.brand.edit',['brand'=>$brand,'setting'=>$setting]);
        dd('edit');
    }
    public function update(Request $request, brand $brand){
        $setting = homeSetting::document();
        // dd($request->all());
        $validate=$request->validate(
        [
            'title'=>['required'],
        ],[
            'title.required'=>'فیلد مورد نظر را پر کنید',
        ]);
        if(isset($request->logo_path)){
            $fullName=Str::uuid().$request->logo_path->getClientOriginalName();
            $path=$request->file("logo_path")->storeAs("brand_medias",$fullName,"public");
            if($brand->logo_path!=null){
                Storage::disk('public')->delete($brand->logo_path);
            }
            $brand->logo_path=$path;
        }
        $brand->title=$validate['title'];
        $brand->description=$request['description'];
        $brand->show_in_home=$request['show_in_home'];
        $brand->is_active=$request['is_active'];
        $brand->save();
        return to_route('brand.list');
        dd('update');
    }
    public function delete(brand $brand){
        $setting = homeSetting::document();
        if($brand->logo_path!=null){
            Storage::disk('public')->delete($brand->logo_path);
        }
        if(count($brand->products)>0){
            foreach ($brand->products as $product) {
                $product->brand_id=null;
                $product->save();
            }
        }
        $brand->delete();
        return to_route('brand.list');
        dd('delete');
    }
}
