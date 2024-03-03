<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    
    public function bangla()
    {
        session('language');
        session()->forget('language');
        
        Session::put('language', 'bangla');
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function english()
    {
        session('language');
        session()->forget('language');
        
        Session::put('language', 'english');
        return redirect()->back();
    }

    
}
