<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Config;

class Sets extends Controller
{
    //
    function index(Request $request) {
        $search = $request->search;
        $page = $request->page ? $request->page : "1";
        $query = "";

        if($search != "") {
            $query .= "&q=name:".$search." OR series:".$search;
            $tmp = "&search=".$search;
        }

        $data = Http::withHeaders([
            'x-api-key' => Config::get('api-key')
        ])->get('https://api.pokemontcg.io/v2/sets?page='.$page.'&pageSize=10'.$query)->json();

        if(count($data['data']) > 0) {
            $pages = floor($data['totalCount']/20) + ($data['totalCount'] % 20 > 0 ? 1 : 0);
        } else {
            $pages = 1;
        }

        if($page > $pages) {
            $page = 1;
            return redirect('/sets?page='.$page.$tmp);
        }

        return View('sets/index', [
            'data' => $data['data'],
            'page' => $data['page'],
            'pages' => $pages
        ]);
    }
}
