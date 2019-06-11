<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Config;
use App\Orderan;
use Illuminate\Http\Request;

class OrderanController extends Controller
{
    public function checkout($id) {
        $ord = Orderan::find($id);
        $ord->status = 0;
        $ord->save();

        return redirect()->route('user.orderan');
    }
    public function mine() {
        $conf = Config::first();
        $myData = Auth::user();

        // get detail order
        // get orderId
        $myOrder = Orderan::where([['user_id', $myData->iduser], ['status', '!=', 9]])->get();
        // if($myOrder->count() == 0) {
        //     $myCart = "null";
        // }else {
        //     $myCart = DB::table('detail_order')
        //                 ->where('order_id', $myOrder[0]->idorder)
        //                 ->join('products', 'product_id', '=', 'products.idproduct')
        //                 ->get();
        // }

        if($myData != "") {
            // add orderan info
            $ordData = Orderan::where('user_id', $myData->iduser)->get()->count();
            $myData->orderan = $ordData;

            // add cart info
            $cartData = Orderan::where([['user_id', $myData->iduser], ['status', '9']])->get()->count();
            $myData->keranjang = $cartData;
        }

        return view('orderan')->with(['config' => $conf, 'myData' => $myData, 'myOrder' => $myOrder]);
    }
    public function detailOrder($id) {
        $conf = Config::first();
        $myData = Auth::user();

        // get detail order
        // get orderId
        $myOrder = Orderan::where([['idorder', $id], ['status', '!=', 9]])->first();
        if($myOrder->count() == 0) {
            $myCart = "null";
        }else {
            $myCart = DB::table('detail_order')
                        ->where('order_id', $myOrder->idorder)
                        ->join('products', 'product_id', '=', 'products.idproduct')
                        ->get();
        }

        return view('detailOrder')->with(['config' => $conf, 'myData' => $myData, 'myCart' => $myCart, 'myOrder' => $myOrder]);
    }
    public function confirmationPage($id = NULL) {
        $conf = Config::first();
        $myData = Auth::user();
        if($myData == "") {
            $myData = "private";
        }

        if($myData != "") {
            // add orderan info
            $ordData = Orderan::where('user_id', $myData->iduser)->get()->count();
            $myData->orderan = $ordData;

            // add cart info
            $cartData = Orderan::where([['user_id', $myData->iduser], ['status', '9']])->get()->count();
            $myData->keranjang = $cartData;
        }

        $myOrder = Orderan::where([['user_id', $myData->iduser], ['status', '0']])->get();
        return view('confirmation')->with(['config' => $conf, 'myData' => $myData, 'myOrder' => $myOrder, 'toPay' => $id]);
    }
    public function confirmation(Request $req) {
        $id = $req->idorder;

        $ord = Orderan::find($id);
        $ord->status = 1;
        $ord->save();

        return redirect()->route('payment.success');
    }
}
