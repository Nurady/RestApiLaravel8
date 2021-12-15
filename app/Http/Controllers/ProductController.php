<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductSingleResource;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Product::get();
        return ProductResource::collection(Product::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        // if ($request->price <= 10000) {
        //     throw ValidationException::withMessages([
        //         'price' => 'Your Price is too low',
        //     ]);
        // }

        // $product = Product::create([
        //     'name' => $request->name,
        //     'description' => $request->description,
        //     'price' => $request->price,
        //     'category_id' => $request->category_id,
        // ]);

        $this->authorize('if_moderator');

        $product = Product::create($request->toArray());

        return response()->json([
            'message' => 'success added product',
            'product' => new ProductSingleResource($product),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        // return $product;
        return new ProductSingleResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        // if ($request->price <= 10000) {
        //     throw ValidationException::withMessages([
        //         'price' => 'Your Price is too low',
        //     ]);
        // }
        $this->authorize('if_admin');

        $product->update($request->toArray());

        return response()->json([
            'message' => 'success updated product',
            'product' => new ProductSingleResource($product),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->authorize('if_admin');
        
        $product->delete();

        return response()->json([
            'message' => 'success deleted product',
        ]);
    }
}
