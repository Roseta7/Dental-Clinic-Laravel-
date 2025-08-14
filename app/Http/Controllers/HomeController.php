<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('home.index');
    }

    public function about(){
        return view('home.about_us');
    }

    public function services(){
        return view('home.services');
    }

    public function contact(){
        return view('home.contact');
    }
}