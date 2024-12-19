<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::latest()->when(request()->q, function($invoices){
            $invoices = $invoices->where('invoices', 'like', '%' . request()->q . '%');
        })->paginate(10);

        return view('admin.order.index', compact('invoices'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('admin.order.show', compact('invoice'));
    }
}
