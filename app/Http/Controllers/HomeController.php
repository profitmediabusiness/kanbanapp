<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view("hello");
    }
    
    public function create(){
        return "Daftar para pengguna";
    }
    public function welcome()
    {
        $message= 'Ini adalah pengiriman data melalui method with, Selamat datang ke Laravel!';
        return view('welcome', ['message' => $message]);
    }
}
