<?php

namespace App\Http\Controllers\Cart;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CartService;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CartService $cartService)
    {
        return Inertia::render('Cart/Index', [ // cartService = laravel Service Container (https://laravel.com/docs/9.x/container)
            'cartItems' => $cartService->setCartValues()->get('cartItems'),
            'cartTaxRate' => $cartService->setCartValues()->get('cartTaxRate'),
            'cartSubtotal' => $cartService->setCartValues()->get('cartSubtotal'),
            'newTax' => $cartService->setCartValues()->get('newTax'),
            'code' => $cartService->setCartValues()->get('code'),
            'discount' => $cartService->setCartValues()->get('discount'),
            'newSubtotal' => $cartService->setCartValues()->get('newSubtotal'),
            'newTotal' => $cartService->setCartValues()->get('newTotal'),
            'laterItems' => $cartService->setCartValues()->get('laterItems'),
            'laterCount' => $cartService->setCartValues()->get('laterCount'),
        ]);
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

        Cart::instance('default')->add($request->id, $request->name, $request->quantity, $request->price, 0, ['totalQty' => $request->totalQty, 'product_code' => $request->product_code, 'image' => $request->image, 'slug' => $request->slug, 'details' => $request->details])->associate('App\Models\Product');
        return redirect()->route('cart.index');

        // passing in the (id, name, quantity, price, weight(0)) then OPTIONS info[totalQty, product_code, image, slug, details] useful for Stripe setup and displaying UI
        // ->associate(Model) will attach that product itself to the cart.
        // Cart::instance('default')
        //     ->add(
        //         $request->id,
        //         $request->name,
        //         $request->quantity,
        //         $request->price,
        //         0,
        //         [
        //             'totalQty' => $request->totalQty,
        //             'product_code' => $request->product_code,
        //             'image' => $request->image,
        //             'slug' => $request->slug,
        //             'details' => $request->details
        //         ]
        //     )
        //     ->associate('App\Models\Product');
        // // Cart info needs to be passed on in Session?
        // return redirect()->route('cart.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Route::patch('cart/{product}', [CartController::class, 'update'])->name('cart.update');
        Cart::instance('default')->update($id, $request->quantity);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Cart::instance('default')->remove($id);
        return back();
    }
}
