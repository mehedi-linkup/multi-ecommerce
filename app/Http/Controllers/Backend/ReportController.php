<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use DateTime;

class ReportController extends Controller
{
    
    public function index()
    {
        return view('backend.pages.reports.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reportByDate(Request $request)
    {
        $date = new DateTime($request->date);
        $formatDate = $date->format('d F Y');
        $orders = Order::where('order_date', $formatDate)->latest()->get();
        return view('backend.pages.reports.datewise_report', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reportByMonth(Request $request)
    {
        $orders = Order::where('order_month', $request->month_name)->where('order_year', $request->year_name)->latest()->get();
        return view('backend.pages.reports.datewise_report', compact('orders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reportByYear(Request $request)
    {
        $orders = Order::where('order_year', $request->year)->latest()->get();
        return view('backend.pages.reports.datewise_report', compact('orders'));
    }

    
}
