<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Config;
use App\Product;
use App\User;

class UserController extends Controller
{
    public function cekUser($email) {
        $email = base64_decode($email);
        $u = User::where('email', $email)->first();
        if($u == "") {
            return response()->json(['status' => '0', 'msg' => 'User tidak ditemukan']);
        }else {
            if(!$u->alamat) {
                // 
            }else {
                return response()->json(['status' => '1']);
            }
        }
    }
    public function indexPage() {
        $conf = Config::first();
        $prod = Product::all();
        $user = Auth::user();

        return view('index')->with(['config' => $conf, 'products' => $prod, 'q' => '', 'myData' => $user]);
    }
    public function viewProduct($id) {
        $conf = Config::first();
        $user = Auth::user();
        $prod = Product::find($id);
        return view('product')->with(['config' => $conf, 'product' => $prod, 'myData' => $user]);
    }
    public function loginPage() {
        $conf = Config::first();
        return view('auth.login')->with('config', $conf);
    }
    public function registerPage($email = NULL, $nama = NULL) {
        $email = base64_decode($email);
        $nama = base64_decode($nama);
        $conf = Config::first();
        return view('auth.register')->with(['config' => $conf, 'data' => ['email' => $email, 'nama' => $nama]]);
    }
    public function cariProduct(Request $req) {
        $conf = Config::first();
        $myData = Auth::user();
        $q = $req->q;
        if($q == "") {
            return redirect()->route('user.index');
        }
        $prod = Product::where('title', 'LIKE', '%'.$q.'%')->get();
        return view('index')->with(['config' => $conf, 'products' => $prod, 'q' => $q, 'myData' => $myData]);
    }
    public function register(Request $req) {
        $u = new User;
        $u->iduser = rand(1, 9999);
        $u->nama = $req->nama;
        $u->email = $req->email;
        $u->password = bcrypt($req->password);
        $u->alamat = '';
        $u->save();
    }
    public function registerViaFacebook($email, $nama) {
        $email = base64_decode($email);
        $nama = base64_decode($nama);
        $u = new User;
        $u->iduser = rand(1, 9999);
        $u->nama = $nama;
        $u->email = $email;
        $u->password = bcrypt('facebook');
        $u->alamat = '';
        $u->save();

        return redirect()->route('user.index');
    }
    public function login(Request $req) {
        $email = $req->email;
        $login = Auth::attempt(['email' => $email, 'password' => "facebook"]);
        if(!$login) {
            return response()->json(['status' => 0, 'msg' => 'Wrong email / password', 'userData' => $password]);
        }

        return response()->json(['status' => 1, 'msg' => 'Login successful', 'data' => $login]);
    }
    public function logout() {
        Auth::logout();

        return redirect()->route('user.index');
    }
}