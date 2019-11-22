<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FurnitureController extends Controller
{
        function index(Request $request)
    {
     if(request()->ajax())
     {
      if(!empty($request->filter_state))
      {
       $data = DB::table('furniture')
         ->select('title', 'state', 'typeintervention', 'year', 'quality', 'totalcost', 'actualcost')
         ->where('state', $request->filter_state)
         ->where('typeintervention', $request->filter_typeintervention)
         ->where('year', $request->filter_year)
         ->where('quality', $request->filter_quality)
         ->get();
      }
      else
      {
       $data = DB::table('furniture')
         ->select('title', 'state', 'typeintervention', 'year', 'quality', 'totalcost', 'actualcost')
         ->get();
      }
      return datatables()->of($data)->make(true);
     }
     $state_name = DB::table('furniture')
          ->select('state')
          ->groupBy('state')
          ->orderBy('state', 'ASC')
          ->get();

    $year_name = DB::table('furniture')
          ->select('year')
          ->groupBy('year')
          ->orderBy('year', 'ASC')
          ->get();

     $quality_name = DB::table('furniture')
          ->select('quality')
          ->groupBy('quality')
          ->orderBy('quality', 'ASC')
          ->get();

          $interventiontype_name = DB::table('furniture')
          ->select('typeintervention')
          ->groupBy('typeintervention')
          ->orderBy('typeintervention', 'ASC')
          ->get();
     return view('custom_search', compact('quality_name', 'state_name', 'year_name', 'interventiontype_name'));
    }
}