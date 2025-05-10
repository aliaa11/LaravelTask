<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    private $sliderImages = [
        'storage/images/28479480_7431460.jpg',
        'storage/images/28479520_7400581.jpg',
        'storage/images/28479592_7391560.jpg'
    ];
    
    public function index()
    {
        return view('home', ['sliderImages' => $this->sliderImages]);
    }
}