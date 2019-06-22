<?php

namespace App\Http\Controllers;

use App\Config;
use App\Orderan;
use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function paymentPage() {
        $conf = Config::first();
        $datas = Payment::all();
        return view('payment')->with(['config' => $conf, 'myData' => 'public', 'data' => $datas]);
    }
    public function create() {
        $conf = Config::first();
        return view('admin.payment.create')->with(['config' => $conf]);
    }
    public function store(Request $req) {
        $pay = new Payment;

        $pay->idpayment = rand(1, 9999);
        $pay->bank_name = $req->bank_name;
        $pay->bank_number = $req->bank_number;
        $pay->account_name = $req->account_name;

        $pay->save();
        return redirect()->route('admin.payment');
    }
    public function edit($id) {
        $p = Payment::find($id);
        $conf = Config::first();
        return view('admin.payment.edit')->with(['data' => $p, 'config' => $conf]);
    }
    public function update($id, Request $req) {
        $pay = Payment::find($id);

        $pay->bank_name = $req->bank_name;
        $pay->bank_number = $req->bank_number;
        $pay->account_name = $req->account_name;

        $pay->save();

        return redirect()->route('admin.payment');
    }
    public function delete(Request $req) {
        $p = Payment::find($req->id);
        $p->delete();

        return redirect()->route('admin.payment');
    }
    public function allPayment() {
        header("Access-Control-Allow-Origin");
        $allCat = Payment::all();
        return response()->json($allCat);
    }
    public function confirmation(Request $req) {
        $id = $req->invoice;

        $fileName = $req->file('bukti')->getClientOriginalName();
        $upl = $req->file('bukti')->move('storage/evidence/', $fileName);

        $ord = Orderan::find($id);
        $ord->status = 3;
        $ord->bukti = $fileName;
        $ord->save();

        return redirect()->route('user.orderan');
    }
    public function showEvidence($id) {
        $ord = Orderan::find($id);
        $bukti = $ord->bukti;

        echo "<img src='".asset('storage/evidence/'.$bukti)."'>";
    }
    public function paymentConfirmation($id, Request $req) {
        $ord = Orderan::find($id);

        $ord->status = 2;
        $ord->save();

        // $noticeUser = app('App\Http\Controllers\NotificationController')->notice($ord->user_id, "Orderan telah dikirim ke alamat Anda");
        $noticeUser = \App\Http\Controllers\NotificationController::notice($ord->user_id, "Orderan telah dikirim ke alamat Anda");

        return redirect()->route('admin.confirmation');
    }
}
