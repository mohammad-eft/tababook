<?php

namespace App\Http\Controllers;

use App\classes\homeSetting;
use App\Models\pack;
use App\Models\packGallery;
use App\Models\product;
use App\Models\product_pack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PackController extends Controller
{
    public function create()
    {
        $products = product::all();
        $setting = homeSetting::document();
        return view('admin.pack.create', ['setting' => $setting, 'products' => $products]);
    }

    public function store(Request $request)
    {
        $path = null;
        if (isset($request->main_image)) {
            $name = $request->main_image->getClientOriginalName();
            $fullName = time() . '_' . $name;
            $path = $request->file('main_image')->storeAs('productPack', $fullName, 'public');
        }
        $packId = pack::insertGetId([
            'title' => $request->title,
            'summary' => $request->summary,
            'description' => $request->description,
            'primary_price' => $request->price,
            'secondary_price' => $request->discount,
            'image' => $path
        ]);
        foreach ($request->product as $proId) {
            product_pack::create([
                'product_id' => $proId,
                'pack_id' => $packId
            ]);
        }
        if (isset($request->gallery)) {
            foreach ($request->gallery as $gallery) {
                $gName = $gallery->getClientOriginalName();
                $fullGName = time() . '_' . $gName;
                $gPath = $gallery->storeAs('productPack', $fullGName, 'public');
                packGallery::create([
                    'image' => $gPath,
                    'pack_id' => $packId
                ]);
            }
        }
        return to_route('pack.list');
    }

    public function single(pack $pack)
    {
        dd($pack);
    }

    public function list()
    {
        $setting = homeSetting::document();
        $packs = pack::with('products')->with('gallery')->get();
        foreach ($packs as $pack) {
            $dateTime = explode(' ', verta($pack->created_at));
            $date = implode('/', explode('-', $dateTime[0]));
            $pack->date = $date;
            foreach ($pack->products as $product) {
                if ($product->media->isNotEmpty()) {
                    foreach ($product->media as $media) {
                        if ($media->is_main) {
                            $product->image = $media->media_path;
                            break;
                        } else {
                            $product->image = 'default.jpg';
                        }
                    }
                } else {
                    $product->image = 'default.jpg';
                }
                if ($product->secondary_price) {
                    $campare = $product->primary_price - $product->secondary_price;
                    $x = $campare / $product->primary_price;
                    $product->percent = intval($x * 100);
                }
            }
            if (!$pack->image) {
                $pack->image = 'default.jpg';
            }
            if ($pack->secondary_price) {
                $campare = $pack->primary_price - $pack->secondary_price;
                $x = $campare / $pack->primary_price;
                $pack->percent = intval($x * 100);
            }
        }
        return view('admin.pack.list', ['setting' => $setting, 'packs' => $packs]);
    }

    public function edit(Pack $pack)
    {
        $setting = HomeSetting::document();

        $pack->load(['products', 'gallery']);

        $products = Product::with('media')->get();

        $selectedProductIds = $pack->products->pluck('id')->toArray();

        foreach ($products as $product) {
            $product->image = 'default.jpg';
            if ($product->media->isNotEmpty()) {
                foreach ($product->media as $media) {
                    if ($media->is_main) {
                        $product->image = $media->media_path;
                        break;
                    }
                }
            }
            if ($product->secondary_price && $product->primary_price > 0) {
                $compare = $product->primary_price - $product->secondary_price;
                $x = $compare / $product->primary_price;
                $product->percent = intval($x * 100);
            } else {
                $product->percent = 0;
            }
        }

        if (!$pack->image) {
            $pack->image = 'default.jpg';
        }
        if ($pack->secondary_price && $pack->primary_price > 0) {
            $compare = $pack->primary_price - $pack->secondary_price;
            $x = $compare / $pack->primary_price;
            $pack->percent = intval($x * 100);
        } else {
            $pack->percent = 0;
        }

        return view('admin.pack.edit', [
            'setting' => $setting,
            'pack' => $pack,
            'products' => $products,
            'selectedProductIds' => $selectedProductIds,
        ]);
    }

    public function update(Request $request, pack $pack)
    {
        $pack->title = $request->title;
        $pack->summary = $request->sumary;
        $pack->description = $request->description;
        if (isset($request->product)) {
            product_pack::wehre('pack_id', $pack->id)->delete();
            foreach ($request->product as $productId) {
                product_pack::create([
                    'product_id' => $productId,
                    'pack_id' => $pack->id
                ]);
            }
        }
        if (isset($request->main_image)) {
            if ($pack->iamge) {
                Storage::disk('public')->delete($pack->image);
            }
            $name = $request->main_image->getClientOriginalName();
            $fullName = time() . '_' . $name;
            $path = $request->main_iamge->storeAs('productPack', $fullName, 'public');
            $pack->image = $path;
        }
        if (isset($request->gellery)) {
            if (count($pack->gallery)) {
                foreach($pack->gallery as $g){
                    Storage::disk('public')->delete($g->image);
                }
                packGallery::wehre('pack_id', $pack->id)->delete();
            }
            foreach ($request->gallery as $gallery) {
                $gName = $gallery->getClientOriginalName();
                $fullGName = time() . '_' . $gName;
                $gPath = $gallery->storeAs('productPack', $fullGName, 'public');
                packGallery::create([
                    'image' => $gPath,
                    'pack_id' => $pack->id
                ]);
            }
        }
        $pack->save();
        return to_route('pack.list');
    }

    public function delete(pack $pack)
    {
        dd($pack);
        if (count($pack->gallery)) {
            foreach($pack->gallery as $g){
                Storage::disk('public')->delete($g->image);
            }
            packGallery::wehre('pack_id', $pack->id)->delete();
        }
        if ($pack->iamge) {
            Storage::disk('public')->delete($pack->image);
        }
        $pack->delete();
        return to_route('pack.list');
    }
}
