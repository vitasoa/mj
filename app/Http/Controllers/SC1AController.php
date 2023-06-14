<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SC1AController extends Controller
{
    public function index()
    {
		/** PROJETS PAR DISTRCICTS **/
        $projets = DB::table('a_sise_sousprojet')
						->select('a_sise_districts.name', DB::raw('count(*) as count'))
						->leftJoin('a_sise_districts', 'a_sise_districts.id', '=', 'a_sise_sousprojet.id_district')
						->groupBy("a_sise_districts.name")->get();

        $labels = [];
		$data = [];
		foreach($projets as $p){
			array_push($labels, $p->name);
			array_push($data, $p->count);
		}
		
		/** BAR CHART **/
              
        return view('sc1achart', compact('labels', 'data'));
    }
}
