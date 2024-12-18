<?php

namespace App\Http\Controllers\Admin;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //hitung invoice
        $pending = Invoice::where('status', 'pending')->count();
        $success = Invoice::where('status', 'success')->count();
        $expired = Invoice::where('status', 'expired')->count();
        $failed = Invoice::where('status', 'failed')->count();

        //tahun dan bulan
        $year = date('Y');
        $month = date('m');

        //statistik keuntungan
        $revenueMonth = Invoice::where('status', 'success')->whereMonth('created_at', '=', $month)->whereYear('created_at', $year)->sum('grand_total');
        $revenueYear = Invoice::where('status', 'success')->whereYear('created_at', $year)->sum('grand_total');
        $revenueAll = Invoice::where('status', 'success')->sum('grand_total');

        return view('admin.dashboard', compact('revenueMonth', 'revenueYear', 'revenueAll', 'pending', 'success', 'failed', 'expired'));
    }
}
