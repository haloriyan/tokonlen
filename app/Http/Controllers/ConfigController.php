<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Config;

class ConfigController extends Controller
{
    public function setConfig(Request $req) {
        $conf = Config::find(1);

        $conf->nama_toko = $req->nama_toko;
        $conf->motto = $req->motto;
        $conf->alamat = $req->alamat;

        $conf->save();

        return redirect()->route('admin.config')->with('notif', 'Setelan berhasil diubah');
    }
}
