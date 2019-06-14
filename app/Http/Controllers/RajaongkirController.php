<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RajaongkirController extends Controller
{
    protected $key = "c568e39b6403b4bfa2f41284c2f85d30";
    public function test(Request $req) {
        $endpoint = $req->endpoint;
        $option = $req->option;

        $c = new \GuzzleHttp\Client();
        $res = $c->request('GET', $endpoint, $option);
        return $res;
    }
    public function getProvince($id = NULL) {
        header("Access-Control-Allow-Origin: *");
        if($id != "") {
            $endpoint = "https://api.rajaongkir.com/starter/province?id=".$id;
        }else {
            $endpoint = "https://api.rajaongkir.com/starter/province";
        }
        $opt = [
            'headers' => [
                'key' => $this->key
            ]
        ];
        $c = new \GuzzleHttp\Client();
        $res = $c->request('GET', $endpoint, $opt);
        echo $res->getBody();
    }
    public function getCity($provinceId) {
        $endpoint = "https://api.rajaongkir.com/starter/city?province=".$provinceId;
        $opt = [
            'headers' => [
                'key' => $this->key
            ]
        ];
        $c = new \GuzzleHttp\Client();
        $res = $c->request('GET', $endpoint, $opt);
        echo $res->getBody();
    }
}
