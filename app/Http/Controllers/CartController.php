<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Cart;
use App\Config;
use App\Product;
use App\Orderan;
use App\DetailOrder;
use App\Notification;
use Illuminate\Http\Request;
use \App\Http\Controllers\RajaongkirController as RajaOngkir;
use \App\Http\Controllers\UserController as User;

class CartController extends Controller
{
    public static function get($userId) {
        $cartData = Orderan::where([['user_id', $userId], ['status', '9']])->get();
        return $cartData;
    }
    public function index() {
        $conf = Config::first();
        $myData = User::myData();

        // get orderId
        $myOrder = Orderan::where([['user_id', $myData->iduser], ['status', 9]])->get();
        if($myOrder->count() == 0) {
            $myCart = "null";
        }else {
            $myCart = DB::table('detail_order')
                        ->where('order_id', $myOrder[0]->idorder)
                        ->join('products', 'product_id', '=', 'products.idproduct')
                        ->get();
        }

        if($myData != "") {
            // add notif info
            $notifData = Notification::where([['user_id', $myData->iduser], ['readed', 0]])->get()->count();
            $myData->notifikasi = $notifData;
        }

        // $ong = new RajaOngkir;
        // $ongkirData = $ong->getCost(444, 444, 100, "pos");

        // $ongkir = json_decode($ongkirData, true);
        // $resOngkir = $ongkir['rajaongkir']['results'][0];
        // $resOngkir = json_encode($resOngkir);

        return view('keranjang')->with(['config' => $conf, 'myData' => $myData, 'myCart' => $myCart]);
    }
    public function getProductPrice($id) {
        $p = Product::find($id);
        return $p->price;
    }
    public function updateOrderan($id, $struktur, $value) {
        $q = Orderan::find($id);
        $q->$struktur = $value;
        $q->save();
    }
    public function store(Request $req) {
        // Dokumentasi Status : ["9" => "cart", "0" => "unpaid", "2" => "Paid", "1" => "success"]
        
        // define data
        $pernahOrder = 0;
        $myId = Auth::guard('buyer')->user()->iduser;
        $idorder = rand(1, 99999);

        // Cek order
        $cek = Orderan::where([['user_id', $myId], ['status', '9']])->first();
        if($cek == "") {
            // Jika tidak ada orderan
            $ord = new Orderan;
            $ord->idorder = $idorder;
            $ord->user_id = $myId;
            $ord->total = 0;
            $ord->tanggal = date('Y-m-d');
            $ord->status = 9;
            $ord->resi = '';
            $ord->bukti = '';
            $ord->shipping = '';
            $ord->shipping_price = 0;
            
            $ord->save();
        }else {
            $pernahOrder = 1;
            $idorder = $cek->idorder;
        }

        $total = $req->qty * $this->getProductPrice($req->product_id);

        // Insert to detail
        $det = new DetailOrder;
        $det->iddetail = rand(1, 99999);
        $det->order_id = $idorder;
        $det->qty = $req->qty;
        $det->total = $total;
        $det->product_id = $req->product_id;
        $det->save();

        if($pernahOrder == 1) {
            $totalOrder = $cek->total + $total;
        }else {
            $totalOrder = $total;
        }
        $this->updateOrderan($idorder, 'total', $totalOrder);

        return redirect()->route('cart');
    }
    public function delete($id) {
        $cart = DetailOrder::find($id);
        $ord = Orderan::find($cart->order_id);
        
        $cart->delete();

        $cekSemua = DetailOrder::where('order_id', $cart->order_id)->get();
        if($cekSemua->count() == 1) {
            $ord->delete();
        }else {
            // update orderan
            $ord->total = $ord->total - $cart->total;
            $ord->save();
        }

        return redirect()->route('cart');
    }
}
