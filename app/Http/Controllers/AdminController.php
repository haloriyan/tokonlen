<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Config;

class AdminController extends Controller
{
    public function productPage() {
        $p = Product::all();
        $conf = Config::first();
        return view('admin.product')->with(['products' => $p, 'config' => $conf]);
    }
    public function configPage() {
        $conf = Config::first();
        return view('admin.config')->with(['config' => $conf, 'notif' => '']);
    }
    public function category() {
        $conf = Config::first();
        return view('admin.category')->with(['config' => $conf, 'notif' => '']);
    }
}
