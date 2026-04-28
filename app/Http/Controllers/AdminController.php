<?php

namespace App\Http\Controllers; // <--- Cek apakah ini sudah benar

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
}