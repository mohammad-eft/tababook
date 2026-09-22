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

    // public function getFilters(Request $request)
    // {
    //     // $filters = json_decode($request->input('filters'), true);
    //     $filters = $request->input('filters');
    //     // return response()->json($filters);
    //     $results = [];
    //     $writer = $filters['writer'] ?? null;
    //     $category = $filters['category'] ?? null;
    //     $exists = $filters['exists'] ?? 1;
    //     $hasDescount = $filters['hasDescount'] ?? 0;
    //     $fromPrice = $filters['fromPrice'] ?? 0;
    //     $toPrice = $filters['toPrice'] ?? null;
    //     $sortType = $filters['sortType'] ?? 'asc';
    //     $sortBy = $filters['sortBy'] ?? 'created_at';
    //     $page = $filters['page'] ?? 1;
    //     $keyword = $filters['keyword'] ?? null;
    //     $products = product::
    //     // where(function ($q) use ($keyword) {
    //     //     $q
    //     //         ->where('summary', 'like', '%' . $keyword . '%')
    //     //         ->orWhere('description', 'like', '%' . $keyword . '%');
    //     // })
    //         where(function ($query) use ($writer, $exists, $hasDescount, $fromPrice, $toPrice, $category) {
    //             if ($writer) {
    //                 $query->where('products.writer', 'like', '%' . $writer . '%');
    //             }
    //             if ($fromPrice && !$toPrice) {

    //                 $query->where('products.primary_price', '>', $fromPrice);
    //             }
    //             if ($toPrice && !$fromPrice) {

    //                 $query->where('products.primary_price', '<', $toPrice);
    //             }
    //             // if (isset($fromPrice) && isset($toPrice)) {

    //             //     $query->whereBetween('products.primary_price', [$fromPrice, $toPrice]);
    //             // }

    //             if ($exists == 1) {
    //                 $query->where('products.count', '!=', 0);
    //             }
    //             if ($exists == 0) {
    //                 $query->where('products.count', 0);
    //             }
    //             if (isset($hasDescount) && $hasDescount == 1) {
    //                 $query->whereNotNull('products.secondary_price');
    //             }
    //             if (isset($hasDescount) && $hasDescount == 0) {
    //                 $query->whereNull('products.secondary_price');
    //             }

    //         })
    //         ->orderBy($sortBy, $sortType)
    //         ->get();
    //         $results['products']=$products;
    //         // if($category){
    //         //     $cats = [];
    //         //     foreach($category as $cat){
    //         //         $cats []= category::where('title', $cat)->with('products')->get();
    //         //     }
    //         //     $results['categories']=$cats;
    //         // }
    //     return response()->json(['results'=>$results, 'filters'=>$filters]);
    // }

    public function getFilters(Request $request)
    {
        $filters = $request->input('filters');
        Log::info($filters);
        $writer = $filters['writer'] ?? null;
        $category = $filters['category'] ?? null;
        $exists = $filters['exists'] ?? 1;
        $hasDescount = $filters['hasDescount'] ?? 0;
        $fromPrice = $filters['fromPrice'] ?? 0;
        $toPrice = $filters['toPrice'] ?? null;
        $sortType = $filters['sortType'] ?? 'asc';
        $sortBy = $filters['sortBy'] ?? 'created_at';
        $keyword = $filters['keyword'] ?? null;

        $products = Product::where(function ($query) use ($writer, $exists, $hasDescount, $fromPrice, $toPrice) {
            if ($writer) {
                Log::info('writer');
                $query->where('products.writer', 'like', '%' . $writer . '%');
            }
            if ($fromPrice==0 && !$toPrice) {
                Log::info('fromPrice');
                $query->where('products.primary_price', '>', $fromPrice);
            }
            if ($toPrice && !$fromPrice!=0) {
                Log::info('toPrice');
                $query->where('products.primary_price', '<', $toPrice);
            }
            if ($fromPrice && $toPrice) {
                Log::info('fromToPrice');
                $query->whereBetween('products.primary_price', [$fromPrice, $toPrice]);
            }
            if ($exists == 1) {
                Log::info('exists');
                $query->where('products.count', '!=', 0);
            }
            if ($exists == 0) {
                Log::info('notExists');
                $query->where('products.count', 0);
            }
            if ($hasDescount == 1) {
                Log::info('hasDiscount');
                $query->whereNotNull('products.secondary_price');
            }
            if ($hasDescount == 0) {
                
                $query->whereNull('products.secondary_price');
            }
        });

        if ($category && is_array($category) && count($category) > 0) {
            $products = $products->whereHas('categories', function ($q) use ($category) {
                $q->whereIn('categories.id', $category);
            });
        }

        if ($keyword) {
            $products = $products->where(function ($q) use ($keyword) {
                $q
                    ->where('products.summary', 'like', '%' . $keyword . '%')
                    ->orWhere('products.description', 'like', '%' . $keyword . '%');
            });
        }

        $products = $products->orderBy($sortBy, $sortType)->get();
     

        return response()->json(['products' => $products, 'filters' => $filters]);
    }

    public function page()
    {
        $categories = category::all();
        return view('search', ['categories' => $categories]);
    }
}
