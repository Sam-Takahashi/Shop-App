<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        // SORT Function (intergration example) https://www.youtube.com/watch?v=VKLyS59d3f0&list=PLW-lITXBwAP8zqZTps7RYDlDHgXDw6RwR&index=8
        if (request()->category) {
            if (!request()->sort) {
                $products = Product::whereHas('categories', function ($query) {
                    $query->where('slug', request()->category);
                })->inRandomOrder()->get(['name', 'slug', 'price', 'image']);
                $categoryName = optional($categories->where('slug', request()->category)->first())->name; // optional: wont throw error if empty
                $categorySlug = $categories->where('slug', request()->category)->first()->slug;
            } else {
                $products = Product::whereHas('categories', function ($query) {
                    $query->where('slug', request()->category);
                });
                $categoryName = optional($categories->where('slug', request()->category)->first())->name;
                $categorySlug = $categories->where('slug', request()->category)->first()->slug;
                if (request()->sort == 'low_high') {
                    $products = $products->orderBy('price')->get(['name', 'slug', 'price', 'image']);
                } else {
                    $products = $products->orderBy('price', 'desc')->get(['name', 'slug', 'price', 'image']);
                }
            }
        } else {
            $products = Product::inRandomOrder()->get(['name', 'slug', 'price', 'image']);
            $categoryName = 'All';
            $categorySlug = NULL;
        }

        // (If) the request is category, then we are going to create a products vaiable, we're going to look for where the product has categories, where the slug equals the request category, and then we're going display them in random order.
        // (else) get all products in random order
        // $categories = Category::all();
        // if (request()->category) {
        //     $products = Product::whereHas('categories', function ($query) {
        //         $query->where('slug', request()->category);
        //     })->inRandomOrder()->get();
        //     $categoryName = $categories->where('slug', request()->category)->first()->name;
        // } else {
        //     $products = Product::inRandomOrder()->get();
        //     $categoryName = 'All';
        // }

        return Inertia::render('Shop/Index', [ // ::all() is bad for performance, needs to be changed
            'products' => $products,
            'categories' => $categories,
            'categoryName' => $categoryName,
            'categorySlug' => $categorySlug,
        ]);

        /*
        return Inertia::render('Shop/Index', [ // ::all() is bad for performance, needs to be changed
            'products' => Product::all(),
            'categories' => Category::all(),
        ]);
        */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return Inertia::render('Shop/Show', [
            'product' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
