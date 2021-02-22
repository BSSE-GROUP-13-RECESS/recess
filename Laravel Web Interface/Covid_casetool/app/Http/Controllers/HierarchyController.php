<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HierarchyController extends Controller
{
    public function national(){
        $results = DB::select("select t1.staffFullName, t3.hospitalName from Staff t1
                    INNER JOIN NationalHeads t2 on t1.staffUsername = t2.Director
                    INNER JOIN Hospitals t3 on t2.hospitalId = t3.hospitalId;");

        $results = json_decode(json_encode($results),true);

        $natHierarchy = array();
        foreach ($results as $result){
            $temps = DB::select("select t1.staffFullName from Staff t1 INNER JOIN
                                        Hospitals t2 on t1.hospitalId = t2.hospitalId WHERE hospitalName=:x",$result['hospitalName']);

            $temps = json_decode(json_encode($temps),true);
            $temp_array = array();
            foreach ($temps as $temp){
                if($temp['staffFullName']!==$result['staffFullName']) {
                    array_push($temp_array, $temp['staffFullName']);
                }
            }
            $natHierarchy[$result['hospitalName']] = array($result['staffFullName']=>$temp_array);
        }
    }

    public function regional(){

    }
}
