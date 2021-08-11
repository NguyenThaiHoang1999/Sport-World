<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Product;

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
            ->paginate(8);
        return response()->json($products);
    }

    public function getCategories()
    {
        $categories = DB::table('categories')->select(
                'categories.id',
                'categories.category_name',
            )->first();
        return response()->json($products);
    }

    public function createProduct(Request $request)
    {
        $images=array($request->image);
        $now = date("Y-m-d H:i:s");
        // if (auth()->user() == null) {
        //     return response()->json(["error" => "Your session has expired. Please sign in again."]);
        // }
        // $user_id = auth()->user()->id;
        $last_id = DB::table('products')->selectRaw("MAX(id) as last_id")->first()->last_id + 1;
        $last_place_id = DB::table('places')->selectRaw("MAX(id) as last_place_id")->first()->last_place_id + 1;
        DB::table('places')->insert([
            'id' => $last_place_id,
            'name' => $request->place_name,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('products')->insert([
            'id' => $last_id,
            'place_id' => $last_place_id,
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
            'image' => json_encode($images),
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        return response()->json(["message" => "Create new product successfully"]);
    }
    public function getProduct($id)
    {
        $product = DB::table('products')
            ->join('users', 'users.id', 'products.user_id')
            ->join('places', 'places.id', 'products.place_id')
            ->join('images', 'products.id', 'images.product_id')
            ->join('brands', 'brands.id', 'products.brand_id')
            ->join('categories', 'categories.id', 'products.category_id')
            ->where('products.id', $id)
            ->select(
                'products.id',
                'users.id as user_id',
                'users.avatar as user_avatar',
                'full_name',
                'categories.category_name',
                'brands.brand_name',
                'products.created_at',
                'places.name as place',
                'images.image as product_image',
                'product_desc',
                'product_price',
                'product_title',
            )->first();
        return response()->json($product);
    }

    public function getProductByCategory($categoryID)
    {
        $product = DB::table('products')
            ->join('users', 'users.id', 'products.user_id')
            ->join('places', 'places.id', 'products.place_id')
            ->join('images', 'products.id', 'images.product_id')
            ->join('categories', 'categories.id', 'products.category_id')
            ->where('categories.id', $categoryID)
            ->select(
                'products.id',
                'users.id as user_id',
                'products.created_at',
                'places.name as place',
                'images.image as product_image',
                'product_desc',
                'product_price',
                'product_title',
            )->orderBy('products.created_at', 'desc')->paginate(8);
        return response()->json($product);
    }

    public function getProductByUser($userID)
    {
        $product = DB::table('products')
            ->join('users', 'users.id', 'products.user_id')
            ->join('places', 'places.id', 'products.place_id')
            ->join('images', 'products.id', 'images.product_id')
            ->join('categories', 'categories.id', 'products.category_id')
            ->where('products.user_id', $userID)
            ->select(
                'products.id',
                'products.product_name',
                'users.id as user_id',
                'products.created_at',
                'places.name as place',
                'images.image as product_image',
                'product_desc',
                'product_price',
                'product_title',
            )->orderBy('products.created_at', 'desc')->get();
        return response()->json($product);
    }

    function search(Request $request){
            $type=$request->type;
            $brand=$request->brand;
            $mileage=$request->mileage;
            $filterAmoutInput=$request->filterPrice;
            $filterAmount=json_decode($filterAmoutInput);
            foreach($filterAmount as $key=>$i){
            $filterAmount[$key]=(float)$i;
            }

            $resultsQuery=Product::where('price','>=',$filterAmount[0])->where('price','<=',$filterAmount[1]);
            if($type!=''){
                $resultsQuery=$resultsQuery->where('type','like',$type);
            }
            if($brand!=''){
                $resultsQuery=$resultsQuery->where('brand','like',$brand);
            }
            if($mileage!=''){
                $resultsQuery=$resultsQuery->where('mileage','like',$mileage);
            }
            $results=$resultsQuery->paginate(9);

            return response()->json(
            [
                'products'=>$results,
                'brands'=>Product::select('brand')->orderBy('brand')->distinct()->get(),
                'mileages'=>Product::select('mileage')->orderBy('mileage')->distinct()->get(),
                'typeSearch'=>$type,
                'brandSearch'=>$brand,
                'mileageSearch'=>$mileage,
                'yearSearch'=>$year,
                'fillterAmoutSearch'=>$filterAmoutInput
            ]);

     }
    function searchText(Request $req){
        $text=$req->textSearch;
        // $query=Product::where('product_name','LIKE',"%".$text."%")->get();
        $query=DB::table('products')
        ->join('users', 'users.id', 'products.user_id')
        ->join('places', 'places.id', 'products.place_id')
        ->join('images', 'products.id', 'images.product_id')
        ->join('categories', 'categories.id', 'products.category_id')
        ->where('products.product_name','LIKE','%'.$text.'%')
        ->orWhere('products.product_price','=', $text)
        ->select(
        'products.id',
        'products.product_name',
        'users.id as user_id',
        'products.created_at',
        'places.name as place',
        'images.image as product_image',
        'products.product_desc',
        'products.product_price',
        'products.product_title',)
        ->orderBy('products.id', 'desc')
        ->get();
         return response()->json(['products'=>$query]);
    }
    function rate(Request $req){
        echo $req->productId;
        $productRate=ProductRate::where('user_id',Auth::user()->id)->where('product_id',$req->productId)->get();
        if(count($productRate)){
        $productRate[0]->rate=$req->rate;
        $productRate[0]->save();
        $this->updateRateScore($req->productId);
        }else{
            $Rate= new ProductRate();
            $Rate->user_id=Auth::user()->id;
            $Rate->product_id=$req->productId;
            $Rate->rate=$req->rate;
            $Rate->save();
            $this->updateRateScore($req->productId);
        }
        return redirect()->back();
    }
    function updateRateScore($productId){
           $product=Product::find($productId);
           $listRate=ProductRate::where('product_id',$product->id)->get();
           $avg=0;
           foreach($listRate as $r){
              $avg+=$r->rate;
           }
           $avg=(float)$avg/count($listRate);
           $product->rate=$avg;
           $product->save();
    }
}

