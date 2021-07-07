<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function getProducts()
    {
        $products = DB::table('products')
            ->join('users', 'users.id', 'products.user_id')
            ->join('places', 'places.id', 'products.place_id')
            ->join('images', 'products.id', 'images.product_id')
            ->join('categories', 'categories.id', 'products.category_id');
        $products = $products
            ->select(
                'products.id',
                'users.id as user_id',
                'users.avatar as user_avatar',
                'full_name',
                'products.created_at',
                'places.name as place',
                'images.image as product_image',
                'product_desc',
                'product_price',
                'product_title',
            );
        $products = $products
            ->orderBy('products.created_at', 'desc')
            ->paginate(10);
        return response()->json($products);
    }

    public function createProduct(Request $request)
    {
        $now = date("Y-m-d H:i:s");
        if (auth()->user() == null) {
            return response()->json(["error" => "Your session has expired. Please sign in again."]);
        }
        $user_id = auth()->user()->id;
        $last_id = DB::table('products')->selectRaw("MAX(id) as last_id")->first()->last_id + 1;
        DB::table('products')->insert([
            'id' => $last_id,
            'place_id' => $request->place_id,
            'product_desc' => $request->description,
            'product_name'  => $request->name,
            'brand_id'      =>$request->brand_id,
            'category_id'   =>$request->category_id,
            'user_id'   =>$request->user_id,
            'product_title' => $request->title,
            'product_price' => $request->price,
            'product_status'=> 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('images')->insert([
            'product_id' => $last_id,
            'image' => $request->image,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        return response()->json(["message" => "Create new eating group successfully"]);
    }
    public function getProduct($id)
    {
        // if (auth()->user() == null) {
        //     return response()->json(["error" => "Your session has expired. Please sign in again."]);
        // }
        $product = DB::table('products')
            ->join('users', 'users.id', 'products.user_id')
            ->join('places', 'places.id', 'products.place_id')
            ->join('images', 'products.id', 'images.product_id')
            ->join('categories', 'categories.id', 'products.category_id')
            ->where('products.id', $id)
            ->select(
                'products.id',
                'users.id as user_id',
                'users.avatar as user_avatar',
                'full_name',
                'products.created_at',
                'places.name as place',
                'images.image as product_image',
                'product_desc',
                'product_price',
                'product_title',
            )->first();
        return response()->json($product);
    }

}
