<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RajaongkirController extends Controller
{
    protected $key = "c568e39b6403b4bfa2f41284c2f85d30";
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
    public function getCost(Request $req) {
        $endpoint = "https://api.rajaongkir.com/starter/cost";

        $origin = $req->origin;
        $destination = $req->destination;
        $weight = $req->weight;
        $courier = $req->courier;
        
        $c = new \GuzzleHttp\Client();
        $opt = [
            'headers' => [
                'key' => $this->key
            ],
            'form_params' => [
                'origin'        => $origin,
                'destination'   => $destination,
                'weight'        => $weight,
                'courier'       => $courier,
            ]
        ];
        $res = $c->request('POST', $endpoint, $opt);
        $ret = $res->getBody()->getContents();
        return $ret;
    }
}
