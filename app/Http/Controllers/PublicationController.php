<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\classes\homeSetting;
use App\Models\attribute;
use App\Models\category;
use App\Models\brand;
use App\Models\publication;
use App\Models\package_attribute;
use App\Models\product;
use App\Models\product_attributes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class PublicationController extends Controller
{
    public function create(){
        $setting = homeSetting::document();
        return view('admin.publication.create',['setting'=>$setting]);
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
            $path=$request->file("logo_path")->storeAs("publication_medias",$fullName,"public");
        }
        $created_publication=publication::create([
            'title'=>$validate['title'],
            'logo_path'=>$path,
            'description'=>$request['description'],
            'show_in_home'=>$request['show_in_home'],
            'is_active'=>$request['is_active'],
        ]);
        return to_route('publication.list');
        dd('store');
    }
    public function list(){
        $setting = homeSetting::document();
        $publications=publication::all();
        return view('admin.publication.list',['publications'=>$publications,'setting'=>$setting]);
        dd('list');
    }
    public function single(publication $publication){
        $setting = homeSetting::document();
        return view('admin.publication.single',['publication'=>$publication,'setting'=>$setting]);
        dd('single');
    }
    public function edit(publication $publication){
        $setting = homeSetting::document();
        return view('admin.publication.edit',['publication'=>$publication,'setting'=>$setting]);
        dd('edit');
    }
    public function update(Request $request, publication $publication){
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
            $path=$request->file("logo_path")->storeAs("publication_medias",$fullName,"public");
            if($publication->logo_path!=null){
                Storage::disk('public')->delete($publication->logo_path);
            }
            $publication->logo_path=$path;
        }
        $publication->title=$validate['title'];
        $publication->description=$request['description'];
        $publication->show_in_home=$request['show_in_home'];
        $publication->is_active=$request['is_active'];
        $publication->save();
        return to_route('publication.list');
        dd('update');
    }
    public function delete(publication $publication){
        $setting = homeSetting::document();
        if($publication->logo_path!=null){
            Storage::disk('public')->delete($publication->logo_path);
        }
        if(count($publication->products)>0){
            foreach ($publication->products as $product) {
                $product->brand_id=null;
                $product->save();
            }
        }
        $publication->delete();
        return to_route('publication.list');
        dd('delete');
    }
}
