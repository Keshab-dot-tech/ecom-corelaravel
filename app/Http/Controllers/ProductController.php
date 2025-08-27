<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // public function index(Request $request)
    // {
    //     $query = Product::query()->with(['category', 'brand', 'sizes']);


    //     if ($request->filled('category')) {
    //         $selected = Category::where('category_name', $request->category)->first();

    //         if ($selected) {
    //             $ids = $this->collectCategoryIds($selected);
    //             $query->whereHas('category', function ($q) use ($ids) {
    //                 $q->whereIn('id', $ids);
    //             });
    //         } else {

    //             $query->whereHas('category', function ($q) use ($request) {
    //                 $q->where('category_name', $request->category);
    //             });
    //         }
    //     }


    //     if ($request->has('brands')) {
    //         $query->whereHas('brand', function ($q) use ($request) {
    //             $q->whereIn('brand_name', (array) $request->brands);
    //         });
    //     }


    //     // if ($request->has('sizes')) {
    //     //     $query->whereHas('sizes', function ($q) use ($request) {
    //     //         $q->whereIn('size', (array) $request->sizes);
    //     //     });
    //     // }


    //     if ($request->has('sizes')) {
    //         $query->whereHas('sizes', function ($q) use ($request) {
    //             $q->whereIn('sizes.id', (array) $request->sizes);
    //         });
    //     }


    //     // if ($request->filled('min_price') && $request->filled('max_price')) {
    //     //     $query->whereBetween('price', [(float) $request->min_price, (float) $request->max_price]);
    //     // }

    //     if ($request->filled('min_price') && $request->filled('max_price')) {
    //         $query->whereBetween('price', [(float) $request->min_price, (float) $request->max_price]);
    //     }



    //     // 
    //     $products   = $query->paginate(9)->withQueryString();
    //     $categories = Category::whereNull('parent_id')->with('children')->get();
    //     $brands     = Brand::orderBy('brand_name')->get();
    //     $sizes      = Size::orderBy('size')->get();

    //     // dd($request->all());


    //     return view('category.category', compact('products', 'categories', 'brands', 'sizes'));
    // }

    public function index(Request $request)
    {
        $query = Product::with(['category', 'brand', 'sizes']);

        // category filter
        $query->when($request->filled('category'), function ($q) use ($request) {
            $selected = Category::where('category_name', $request->category)->first();

            if ($selected) {
                $ids = $this->collectCategoryIds($selected);
                $q->whereHas('category', function ($q2) use ($ids) {
                    $q2->whereIn('id', $ids);
                });
            } else {
                $q->whereHas('category', function ($q2) use ($request) {
                    $q2->where('category_name', $request->category);
                });
            }
        });

        // brand filter
        $query->when($request->has('brands'), function ($q) use ($request) {
            $q->whereHas('brand', function ($q2) use ($request) {
                $q2->whereIn('brand_name', (array) $request->brands);
            });
        });

        // size filter
        // $query->when($request->has('sizes'), function ($q) use ($request) {
        //     $q->whereHas('sizes', function ($q2) use ($request) {
        //         $q2->whereIn('sizes.id', (array) $request->sizes);
        //     });
        // });
        // if ($request->filled('sizes')) {
        //     $query->whereIn('id', function ($sub) use ($request) {
        //         $sub->select('product_id')
        //             ->from('product_size')
        //             ->whereIn('size_id', $request->sizes);
        //     });
        // }
        if ($request->filled('sizes')) {
            $query->join('product_size', 'products.id', '=', 'product_size.product_id')
                ->whereIn('product_size.size_id', $request->sizes)
                ->select('products.*')
                ->distinct();
        }



        // price filter
        $query->when($request->filled('min_price') && $request->filled('max_price'), function ($q) use ($request) {
            $q->whereBetween('price', [(float) $request->min_price, (float) $request->max_price]);
        });

        // Run query
        $products   = $query->paginate(9)->withQueryString();
        $categories = Category::whereNull('parent_id')->with('children')->get();
        $brands     = Brand::orderBy('brand_name')->get();
        $sizes      = Size::orderBy('size')->get();

        // Debug: show query & bindings
        // dd($products->toSql(), $products->getBindings());

        return view('category.category', compact('products', 'categories', 'brands', 'sizes'));
    }



    protected function collectCategoryIds(Category $category): array
    {
        $ids = [$category->id];
        $category->loadMissing('children');
        foreach ($category->children as $child) {
            $ids = array_merge($ids, $this->collectCategoryIds($child));
        }
        return $ids;
    }

    public function show(Product $product)
    {
        // Load the product with all necessary relationships
        $product->load(['category', 'brand', 'sizes']);
        
        // Get related products from the same category
        $related_products = Product::where('category_id', optional($product->category)->id)
            ->where('id', '!=', $product->id)
            ->with(['category', 'brand']) // Eager load relationships for related products
            ->limit(3)
            ->get();

        return view('category.details2', compact('product', 'related_products'));
    }
}
