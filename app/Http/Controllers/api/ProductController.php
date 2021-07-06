<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProducts(Request $request)
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
                'places.id as place_id',
                'places.name as place',
                'images.image as product_image',
                'product_desc',
                'product_price',
                'product_title',
            );
        $products = $products
            ->groupBy('products.id')
            ->orderBy('date', 'asc')
            ->orderByDesc('products.id')
            ->paginate(10);
        return response()->json($products);
    }
}
