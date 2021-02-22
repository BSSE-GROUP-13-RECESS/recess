<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
      $ptotal = json_decode(json_encode(DB::select("select count(*) as ptotal from (select patientId from Patients) as t1;")),true);
      $ptotal_symp = json_decode(json_encode(DB::select("select count(*) as ptotal_symp from (select patientId from Patients where category='symptomatic') as t2;")),true);
      $ptotal_asymp = json_decode(json_encode(DB::select("select count(*) as ptotal_asymp from (select patientId from Patients where category='asymptomatic') as t3;")),true);
      $dtotal = json_decode(json_encode(DB::select("select count(*) as dtotal from (select username from HealthWorkers) as t4;")),true);

      $funds = json_decode(json_encode(DB::select("select sum(amount) as sum from Donations;")),true);
      $spent = json_decode(json_encode(DB::select("select sum(spent) as sum from Expenditure;")),true);
      $saved = json_decode(json_encode(DB::select("select sum(balance) as sum from Expenditure;")),true);

      if($funds[0]['sum'] != null) {
        $sp = ($spent[0]['sum'] / $funds[0]['sum']) * 100;
        $sav = ($saved[0]['sum'] / $funds[0]['sum']) * 100;
      }else{
        $sp = 0;
        $sav = 0;
      }

      if($ptotal[0]['ptotal']>0) {
        $symp_per = ($ptotal_symp[0]['ptotal_symp'] / $ptotal[0]['ptotal']) * 100;
        $asymp_per = ($ptotal_asymp[0]['ptotal_asymp'] / $ptotal[0]['ptotal']) * 100;
      }else{
        $symp_per = 0;
        $asymp_per = 0;
      }
      return view::make('home')->with(['ptotal'=>$ptotal[0]['ptotal'],'stotal'=>$ptotal_symp[0]['ptotal_symp'],'atotal'=>$ptotal_asymp[0]['ptotal_asymp'],'sper'=>$symp_per,'aper'=>$asymp_per,'dtotal'=>$dtotal[0]['dtotal'],'funds'=>$funds[0]['sum'],'spent'=>$spent[0]['sum'],'saved'=>$saved[0]['sum'],'savp'=>$sav,'spp'=>$sp]);
    }
}