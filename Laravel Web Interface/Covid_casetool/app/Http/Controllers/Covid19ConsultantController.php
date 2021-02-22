<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class Covid19ConsultantController extends Controller
{
    public function index(){
        $consultants = DB::select("SELECT t1.username, t1.fullName, t2.position, t3.hospitalName FROM HealthWorkers t1
                        INNER JOIN Covid19Consultant t2 on t1.username = t2.username
                        INNER JOIN Hospitals t3 on t2.hospitalId = t3.hospitalId WHERE t2.present='Yes';");

        $consultants = json_decode(json_encode($consultants),true);
        return view::make('nationalOfficers')->with(['consultants'=>$consultants,'total_con'=>count($consultants)]);
    }
}
