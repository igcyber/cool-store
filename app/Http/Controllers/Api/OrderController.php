<?php

namespace App\Http\Controllers\Api;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * @return void
     */
    public function index()
    {
        $invoices = Invoice::where('customer_id', auth()->guard('api')->user()->id)->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar Invoices : '. auth()->guard('api')->user()->name,
            'data' => $invoices
        ], 200);
    }

    public function show($snap_token)
    {
        $invoice = Invoice::where('customer_id', auth()->guard('api')->user()->id)->where('snap_token', $snap_token)->latest()->first();

        return response()->json([
            'success' => true,
            'message' => 'Detail Invoices : '.auth()->guard('api')->user()->name,
            'data' => $invoice,
            'product' => $invoice->orders
        ], 200);
    }
}
