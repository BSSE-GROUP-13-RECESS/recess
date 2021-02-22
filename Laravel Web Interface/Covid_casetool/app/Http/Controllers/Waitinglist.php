<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class Waitinglist extends Controller
{
  public function getlist(){
    $consultants = DB::select("SELECT username FROM Covid19Consultant WHERE present='Yes' and ISNULL(position);");
    $consultants = json_decode(json_encode($consultants),true);
    return view::make('waitinglist')->with(['Wconsultants'=>$consultants,'total_cons'=>count($consultants)]);
  }

  public function registerPosition(Request $request){
    $consultants = DB::select("SELECT username FROM Covid19Consultant WHERE present='Yes' and ISNULL(position);");
    foreach ($consultants as $consultant){
      $str = $consultant->username;
      DB::update("UPDATE Covid19Consultant set position=? where username=?;",[$request->$str,$str]);
    }
    return redirect(route('getlist'));

  }
}
