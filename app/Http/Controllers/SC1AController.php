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
		$array_sps = [];
		$conventions = DB::table('a_sise_sousprojet')
						->select(DB::raw('count(*) as count'))->where('date_convention', '<=', date('Y').'-12-31')->where('date_convention', '>=', date('Y').'-01-01')->count();
		array_push($array_sps, $conventions);				
		$fes = DB::table('a_sise_sousprojet')
						->select(DB::raw('count(*) as count'))->where('fes_faisabilite', '=', 'OUI')->count();
		array_push($array_sps, $fes);
		$recep_date = DB::table('a_sise_sousprojet')
						->select(DB::raw('count(*) as count'))->where('recep_date', '!=', null)->count();
		array_push($array_sps, $recep_date);
		$recep_prov = DB::table('a_sise_sousprojet')
						->select(DB::raw('count(*) as count'))->where('recep_prov_date', '!=', null)->count();
		array_push($array_sps, $recep_prov);
		$recep_def = DB::table('a_sise_sousprojet')
						->select(DB::raw('count(*) as count'))->where('recepdef_date', '!=', null)->count();
		array_push($array_sps, $recep_def);
        return view('sc1achart', compact('labels', 'data', 'array_sps'));
    }
}
