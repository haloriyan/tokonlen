<?php

namespace App\Http\Controllers;

use DB;
use App\Orderan;
use App\Product;
use Illuminate\Http\Request;
use \App\Http\Controllers\ConfigController as Config;

class AdminController extends Controller
{
    public function productPage() {
        $p = Product::all();
        $conf = Config::get();
        return view('admin.product')->with(['products' => $p, 'config' => $conf]);
    }
    public function configPage() {
        $conf = Config::get();
        return view('admin.config')->with(['config' => $conf, 'notif' => '']);
    }
    public function paymentPage() {
        $conf = Config::get();
        return view('admin.payment.index')->with(['config' => $conf, 'notif' => '']);
    }
    public function category() {
        $conf = Config::get();
        return view('admin.category')->with(['config' => $conf, 'notif' => '']);
    }
    public function confirmationPage() {
        $conf = Config::get();
        // $data = Orderan::where('status', 3)->get();
        $data = DB::table('orderan')
                    ->where('status', 3)
                    ->join('users', 'orderan.user_id', '=', 'users.iduser')
                    ->get();
        return view('admin.confirmation')->with(['config' => $conf, 'notif' => '', 'datas' => $data]);
    }
}
