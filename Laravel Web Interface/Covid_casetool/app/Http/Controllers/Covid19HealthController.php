<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class Covid19HealthController extends Controller
{
    public function index(){
        $hworkers = DB::select("SELECT t1.username, t1.fullName, t3.hospitalName FROM HealthWorkers t1
                                        INNER JOIN Covid19HealthOfficer t2 on t1.username = t2.username
                                        INNER JOIN Hospitals t3 on t2.hospitalId = t3.hospitalId WHERE t2.present='Yes';");
        $hworkers = json_decode(json_encode($hworkers),true);
        return view::make('generalOfficers')->with(['hworkers'=>$hworkers,'total_hw'=>count($hworkers)]);
    }
}
