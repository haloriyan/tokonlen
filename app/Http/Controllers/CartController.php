<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Cart;
use App\Config;
use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index() {
        $myId = Auth::user()->iduser;
        $myCart = Cart::where('user_id', $myId);
        $conf = Config::first();
        $myData = Auth::user();

        $myCart = DB::table('cart')
                    ->where('user_id', $myId)
                    ->join('products', 'product_id', '=', 'products.idproduct')
                    ->get();

        return view('keranjang')->with(['config' => $conf, 'myData' => $myData, 'myCart' => $myCart]);
    }
    public function getProductPrice($id) {
        $p = Product::find($id);
        return $p->price;
    }
    public function store(Request $req) {
        $cart = new Cart;

        $cart->qty         = $req->qty;
        $cart->product_id  = $req->product_id;
        $cart->user_id     = Auth::user()->iduser;
        $cart->total            = $req->qty * $this->getProductPrice($req->product_id);

        $cart->save();

        return redirect()->route('cart');
    }
    public function delete($id) {
        $cart = Cart::find($id);
        $cart->delete();

        return redirect()->route('cart');
    }
}
