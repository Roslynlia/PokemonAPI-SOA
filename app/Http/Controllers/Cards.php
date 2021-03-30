<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Config;

class Cards extends Controller
{
    //

    function index(Request $request)
    {
        $name = $request->name;
        $type = $request->types;
        $subtype = $request->subtypes;
        $supertype = $request->supertypes;
        $rarities = $request->rarities;
        $page = $request->page ? $request->page : "1";

        $query = "";
        
        $tmp = "";

        if($type != "" && $type != "-1") {
            $query .= ' types:"'.$type.'"';
            $tmp .= "&types=".$type;
        }

        if($subtype != "" && $subtype != "-1") {
            $query .= ' subtypes:"'.$subtype.'"';
            $tmp .= "&subtypes=".$subtype;
        }

        if($supertype != "" && $supertype != "-1") {
            $query .= ' supertype:"'.$supertype.'"';
            $tmp .= "&supertypes=".$supertype;
        }

        if($rarities != "" && $rarities != "-1") {
            $query .= ' rarity:"'.$rarities.'"';
            $tmp .= "&rarities".$rarities;
        }
        
        if(trim($name) != "") {
            $query .= ' name:"*'.$name."*".'"';
            $tmp .= "&name=".$name;
        }

        if(strlen($query) > 0) {
            $query = '&q=' . $query;
        }

        $data = Http::withHeaders([
            'x-api-key' => Config::get('api-key')
        ])->get('https://api.pokemontcg.io/v2/cards?pageSize=20&page='.$page.$query)->json();
        
        if(count($data['data']) > 0) {
            $pages = floor($data['totalCount']/20) + ($data['totalCount'] % 20 > 0 ? 1 : 0);
        } else {
            $pages = 1;
        }

        if($page > $pages) {
            $page = 1;
            return redirect('/?page='.$page.$tmp);
        }

        $home_data = [
            'data' => $data['data'],
            'page' => $data['page'],
            'pages' => $pages
        ];

        $filter = $this->getFilter();
        return View('cards/index', array_merge((array)$home_data, (array)$filter));
    }

    function detail($id) {
        $data = Http::withHeaders([
            'x-api-key' => Config::get('api-key')
        ])->get('https://api.pokemontcg.io/v2/cards/'.$id)->json();

        return View('cards/detail', [
            'data' => $data['data']
        ]);
    }

    function getFilter() {
        $types = Http::withHeaders([
            'x-api-key' => Config::get('api-key')
        ])->get('https://api.pokemontcg.io/v2/types')->json();

        $subtypes = Http::withHeaders([
            'x-api-key' => Config::get('api-key')
        ])->get('https://api.pokemontcg.io/v2/subtypes')->json();

        $supertypes = Http::withHeaders([
            'x-api-key' => Config::get('api-key')
        ])->get('https://api.pokemontcg.io/v2/supertypes')->json();

        $rarities = Http::withHeaders([
            'x-api-key' => Config::get('api-key')
        ])->get('https://api.pokemontcg.io/v2/rarities')->json();

        return [
            'types' => $types['data'],
            'subtypes' => $subtypes['data'],
            'supertypes' => $supertypes['data'],
            'rarities' => $rarities['data']
        ];
    }
}
