<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Cookie;
use App\User;
use App\Images;
use App\Config;
use App\Review;
use App\Orderan;
use App\Product;
use App\DetailOrder;
use App\Notification;
use \App\Http\Controllers\CartController as CartCtrl;
use \App\Http\Controllers\OrderanController as OrderanCtrl;
use \App\Http\Controllers\CategoryController as CategoryCtrl;

class UserController extends Controller
{
    public static function myData() {
        $myData = Auth::guard('buyer')->user();

        if($myData != "") {
            $cartData = CartCtrl::get($myData->iduser);
            $myData->keranjang = $cartData->count();

            $ordData = OrderanCtrl::get($myData->iduser);
            $myData->orderan = $ordData->count();
        }

        return $myData;
    }
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
        $user = $this->myData();

        if($user != "") {
            // 
        }

        return view('index')->with(['config' => $conf, 'products' => $prod, 'q' => '', 'myData' => $user]);
    }
    public static function ableToReview($product_id, $user_id) {
        $ordData = Orderan::where([['user_id', $user_id], ['status', 1]])->get();
        if($ordData->count() == 0) {
            return false;
        }
        foreach($ordData as $item) {
            $getDetailOrder = DetailOrder::where([['order_id', $item->idorder], ['product_id', $product_id]])->get();
            if($getDetailOrder->count() == 0) {
                return false;
            }else {
                $check = ReviewController::check($user_id, $product_id);
                if($check->count() != 0) {
                    return false;
                }
                return true;
            }
        }
    }
    public function viewProduct($id) {
        $conf = Config::first();
        $user = $this->myData();
        $prod = Product::find($id);
        $revs = Review::where('product_id', $id)->with(['users'])->get();

        if($user != "") {
            $ableWriteReview = $this->ableToReview($id, $user->iduser);
            $writeReview = (!$ableWriteReview) ? 0 : 1;
        }else {
            $writeReview = 0;
        }

        $productImages = Images::where('product_id', $prod->idproduct)->get();
        
        return view('product')
                ->with([
                    'config' => $conf,
                    'product' => $prod,
                    'myData' => $user,
                    'images' => $productImages,
                    'writeReview' => $writeReview,
                    'reviews' => $revs
                ]);
    }
    public function loginPage() {
        $conf = Config::first();
        return view('auth.login')->with('config', $conf);
    }
    public function loginFacebook() {
        $conf = Config::first();
        return view('auth.facebook')->with('config', $conf);
    }
    public function loginGoogle() {
        $conf = Config::first();
        return view('auth.google')->with('config', $conf);
    }
    public function registerPage($email = NULL, $nama = NULL) {
        $email = base64_decode($email);
        $nama = base64_decode($nama);
        $conf = Config::first();
        return view('auth.register')->with(['config' => $conf, 'data' => ['email' => $email, 'nama' => $nama]]);
    }
    public function cariProduct(Request $req) {
        $conf = Config::first();
        $myData = $this->myData();
        $q = $req->q;
        if($q == "") {
            return redirect()->route('user.index');
        }

        if($myData != "") {
            // add notif info
            $notifData = Notification::where([['user_id', $myData->iduser], ['readed', 0]])->get()->count();
            $myData->notifikasi = $notifData;
        }

        $cats = CategoryCtrl::get();

        $prod = Product::where('title', 'LIKE', '%'.$q.'%')->get();
        return view('search')->with(['config' => $conf, 'products' => $prod, 'q' => $q, 'myData' => $myData, 'categories' => $cats]);
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
        $u->kota = '';
        $u->provinsi = '';
        $u->save();

        return redirect()->route('user.index');
    }
    public function registerViaGoogle($email, $nama) {
        $email = base64_decode($email);
        $nama = base64_decode($nama);

        $u = new User;
        $u->iduser = rand(1, 9999);
        $u->nama = $nama;
        $u->email = $email;
        $u->password = bcrypt('google');
        $u->alamat = '';
        $u->kota = '';
        $u->provinsi = '';
        $u->save();

        return redirect()->route('login.google');
    }
    public function login(Request $req) {
        $email = $req->email;
        $login = Auth::guard('buyer')->attempt(['email' => $email, 'password' => $req->pwd]);
        if(!$login) {
            return response()->json(['status' => 0, 'msg' => 'Wrong email / password', 'userData' => $password]);
        }

        return response()->json(['status' => 1, 'msg' => 'Login successful', 'data' => $login]);
    }
    public function logout() {
        Auth::guard('buyer')->logout();

        return redirect()->route('user.index');
    }
    public function settings() {
        $myData = $this->myData();
        $conf = Config::first();
        $notif = Cookie::get('notif');

        if($myData != "") {
            // add notif info
            $notifData = Notification::where([['user_id', $myData->iduser], ['readed', 0]])->get()->count();
            $myData->notifikasi = $notifData;
        }

        return view('user.settings')->with(['myData' => $myData, 'config' => $conf, 'notif' => $notif]);
    }
    public function saveSettings(Request $req) {
        $myId = Auth::guard('buyer')->user()->iduser;

        $u = User::find($myId);
        $u->nama = $req->nama;
        $u->alamat = $req->alamat;
        $u->provinsi = $req->provinsi;
        $u->kota = $req->kota;

        $u->save();

        Cookie::queue('notif', 'Perubahan berhasil disimpan', '0.25');

        return redirect()->route('user.settings');
    }
    public function notificationPage() {
        $myData = $this->myData();
        $conf = Config::first();

        if($myData != "") {
            // add notif info
            $notifData = Notification::where([['user_id', $myData->iduser], ['readed', 0]])->get()->count();
            $myData->notifikasi = $notifData;
        }

        // get notification data
        $notif = Notification::where('user_id', $myData->iduser)
                    ->orderBy('readed', 'ASC')
                    ->orderBy('created_at', 'DESC')
                    ->get();

        $readNotification = \App\Http\Controllers\NotificationController::read($myData->iduser);

        return view('notification')->with(['myData' => $myData, 'config' => $conf, 'notif' => $notif]);
    }
    public function csPage() {
        $myData = $this->myData();
        $conf = Config::get();
        return view('user.cs')->with(['config' => $conf, 'myData' => $myData]);
    }
}
