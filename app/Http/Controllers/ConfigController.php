<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Config;

class ConfigController extends Controller
{
    public static function get() {
        return Config::first();
    }
    public function setConfig(Request $req) {
        $conf = Config::find(1);

        $conf->nama_toko = $req->nama_toko;
        $conf->motto = $req->motto;
        $conf->alamat = $req->alamat;
        $conf->kota = $req->kota;
        $conf->provinsi = $req->provinsi;

        $conf->save();

        return redirect()->route('admin.config')->with('notif', 'Setelan berhasil diubah');
    }
}
