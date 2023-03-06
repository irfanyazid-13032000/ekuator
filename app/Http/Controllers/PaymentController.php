<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::get();
        
        return response()->json(['data'=>$payments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Payment::create([
                "uuid_transaction" => Str::uuid(),
                "name" => $request->name,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "status" => 500,
                "message" => "Error menambahkan data payment: " . $e->getMessage()
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
        
        try {
            $transactions = Transaction::where('uuid_transaction',$uuid)
            ->join('products', 'transactions.products_id', '=', 'products.uuid')
            ->select('transactions.*','products.name as nama_produk')
            ->get();
            $transactions["total"] = $transactions->map(function($transaction){
                return $transaction->total;
            });
            $transactions["total"] = $transactions["total"]->sum();
            return $transactions;

        } catch (\Exception $e) {
            return response()->json([
                "status" => 500,
                "message" => "Error menambahkan data payment: " . $e->getMessage()
            ], 500);
        }

        return response()->json([
            "status" => 200,
            "message" => "data transaksi!!!",
            'data' => $transactions
        ]);
        
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
