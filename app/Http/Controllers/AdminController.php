<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Orderan;
use App\Product;
use Illuminate\Http\Request;
use \App\Http\Controllers\ConfigController as Config;
use \App\Http\Controllers\MessagingController as Chat;

class AdminController extends Controller
{
    public static function myData() {
        return Auth::guard('admin')->user();
    }
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
    public function loginPage() {
        $conf = Config::get();
        return view('auth.admin')->with(['config' => $conf]);
    }
    public function login(Request $req) {
        $email = $req->email;
        $password = $req->password;

        $login = Auth::guard('admin')->attempt(['email' => $email, 'password' => $password]);
        if(!$login) {
            return "gagal login";
        }
        return redirect()->route('admin.dashboard');
    }
    public function dashboard() {
        $conf = Config::get();
        return view('admin.dashboard')->with(['config' => $conf]);
    }
    public function messagingPage() {
        $conf = Config::get();

        $messages = Chat::getChatList();
        return view('admin.messaging')->with(['config' => $conf]);
    }
}
