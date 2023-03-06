<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($limit,$sortBy,$orderBy)
    {
       

        $transactions = DB::table('transactions')
            ->join('payments', 'transactions.uuid_transaction', '=', 'payments.uuid_transaction')
            ->join('products', 'transactions.products_id', '=', 'products.uuid')
            ->select('transactions.*','payments.name as pembeli', 'products.name as nama_produk')
            ->orderBy($sortBy,$orderBy)->limit($limit)
            ->get();
        
            // dd($transactions);

        // $transactions = Transaction::orderBy($sortBy,$orderBy)->limit($limit)->get();
        return response()->json(["data"=>$transactions]);
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
            Transaction::create([
                "uuid_transaction" => $request->uuid,
                "products_id" => $request->products_id,
                "quantity" => $request->quantity,
                "price" => $request->price,
                "total" => $request->price * $request->quantity,
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
       

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
