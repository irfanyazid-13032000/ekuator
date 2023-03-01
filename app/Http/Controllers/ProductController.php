<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::get();
        $products = $products->map(function($product){
            return [
                'uuid'=>$product->uuid,
                'name'=>$product->name,
                'price'=>$product->price,
                'quantity'=>$product->quantity,
                'created_at'=>Carbon::parse($product->created_at)->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::parse($product->updated_at)->format('Y-m-d H:i:s'),
                'deleted_at'=>Carbon::parse($product->deleted_at)->format('Y-m-d H:i:s'),
            ];
            
        });
       
        // $products = Product::get();
        return response()->json([
            'status'=>200,
            'message'=>'data produk berhasil ditampilkan',
            'data' =>$products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Product::create([
                "uuid" => Str::uuid(),
                "name" => $request->name,
                "price" => $request->price,
                "quantity" => $request->quantity,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 500,
                "message" => "Error menambahkan data product: " . $e->getMessage()
            ], 500);
        }

        return response()->json([
            "status" => 200,
            "message" => "Data berhasil ditambahkan!!!",
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {

        try{
            $detailProduct = DB::table('products')->where('uuid', $uuid)->get();
            return $detailProduct;
        } catch (\Exception $e) {
            return response()->json([
                "status" => 500,
                "message" => "Error menampilkan data product: " . $e->getMessage()
            ]);

        return response()->json([
            "uuid"=>$uuid,
            "status"=>200,
            "message"=>"data detail produk berhasil didapatkan",
            "data"=>$detailProduct
        ]);
    }
    }

    /**
     * Show the form for editing the specified resource.
     */
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $uuid)
    {

        if (!DB::table('products')->where('uuid', $uuid)->exists()) {
            return response()->json([
                "status" => 404,
                "message" => "Data tidak ditemukan!",
            ]);
        }
    
        
        try {
            DB::table('products')->where('uuid', $uuid)->update([
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'quantity' => $request->input('quantity'),
                'updated_at' => now()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 500,
                "message" => "Error mengubah data product: " . $e->getMessage()
            ]);
        }
    
        return response()->json([
            "status" => 200,
            "message" => "Data berhasil diubah!!!",
        ]);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {

     if (!DB::table('products')->where('uuid', $uuid)->exists()) {
         return response()->json([
             "status" => 404,
             "message" => "Data tidak ditemukan!",
         ]);
        }
        
    $deleted = Product::where('uuid', $uuid)->delete();

    if ($deleted) {
        return response()->json(['message' => 'Record deleted successfully.']);
    } else {
        return response()->json(['message' => 'Record not found.'], 404);
    }
}

}
