<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderanController extends Controller
{
    public function checkout($id) {
        $ord = Orderan::find($id);
        $ord->status = 0;
        $ord->save();

        return redirect()->route('user.orderan');
    }
}
