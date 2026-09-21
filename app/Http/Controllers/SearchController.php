<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\product;
use Illuminate\Http\Request;
use Log;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $title = $request->input('title');
        $results = [];
        $products = product::where('title', 'like', '%' . $title . '%')
            ->orWhere('summary', 'like', '%' . $title . '%')
            ->orWhere('description', 'like', '%' . $title . '%')
            ->orWhere('writer', 'like', '%' . $title . '%')
            ->orWhere('publication', 'like', '%' . $title . '%')
            ->get();

        $categories = category::where('title', 'like', '%' . $title . '%')
            ->orWhere('description', 'like', '%' . $title . '%')
            ->get();

        $results['products'] = $products;
        $results['categories'] = $categories;
        return response()->json($results);
    }

    public function getFilters(Request $request)
    {
        // $filters = json_decode($request->input('filters'), true);
        $filters = $request->input('filters');
        // return response()->json($filters);
        $results = [];
        $writer = $filters['writer'] ?? null;
        $category = $filters['category'] ?? null;
        $exists = $filters['exists'] ?? 1;
        $hasDescount = $filters['hasDescount'] ?? 0;
        $fromPrice = $filters['fromPrice'] ?? 0;
        $toPrice = $filters['toPrice'] ?? 9999999999;
        $sortType = $filters['sortType'] ?? 'asc';
        $sortBy = $filters['sortBy'] ?? 'created_at';
        $page = $filters['page'] ?? 1;
        $keyword = $filters['keyword'] ?? null;
        $products = product::
        // where(function ($q) use ($keyword) {
        //     $q
        //         ->where('summary', 'like', '%' . $keyword . '%')
        //         ->orWhere('description', 'like', '%' . $keyword . '%');
        // })
            where(function ($query) use ($writer, $exists, $hasDescount, $fromPrice, $toPrice, $category) {
                if (isset($writer)) {
                    $query->where('products.writer', 'like', '%' . $writer . '%');
                }
                if (isset($fromPrice) && !isset($toPrice)) {
                    
                    $query->where('products.primary_price', '>', $fromPrice);
                }
                if (isset($toPrice) && !isset($fromPrice)) {
                    
                    $query->where('products.primary_price', '<', $toPrice);
                }
                // if (isset($fromPrice) && isset($toPrice)) {
                    
                //     $query->whereBetween('products.primary_price', [$fromPrice, $toPrice]);
                // }
                if (isset($exists)) {
                    
                    if ($exists == 1) {
                        
                        $query->where('products.count', '!=', 0);
                    } else {
                        
                        $query->where('products.count', 0);
                    }
                }
                if (isset($hasDescount) && $hasDescount == 1) {
                    
                    $query->whereNotNull('products.secondary_price');
                }
                if (isset($hasDescount) && $hasDescount == 0) {
                    
                    $query->whereNull('products.secondary_price');
                }
            })
            ->orderBy($sortBy, $sortType)
            ->get();
            $results['products']=$products;
            if($category){
                $cats = [];
                foreach($category as $cat){
                    $cats []= category::where('title', $cat)->with('products')->get();
                }
                $results['categories']=$cats;
            }
        return response()->json(['results'=>$results, 'filters'=>$filters]);
    }

    public function page(){
        $categories = category::all();
        return view('search', ['categories'=>$categories]);
    }
}
