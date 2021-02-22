<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class OfficerRegistrationController extends Controller
{
    public function index(Request $request){
      $results = DB::select("select staffUsername from Staff where staffUsername=? UNION select username from HealthWorkers t2 where t2.username=?",[$request->username,$request->username]);
      $results = json_decode(json_encode($results),true);
      $total = count($results);

      if ($total>0) {
        echo -1;
      }else{
        echo 0;
      }
    }

    public function keep(Request $request){
      $results = DB::select("select staffUsername from Staff where staffUsername=? UNION select username from HealthWorkers t2 where t2.username=?",[$request->username,$request->username]);
      $results = json_decode(json_encode($results),true);
      $total = count($results);

      if ($total>0) {
        echo "This data already exists hence not taken.";
      }else{
        $ch = DB::insert("insert into HealthWorkers (username, fullName) VALUES (?,?)",[$request->username,$request->name]);

        $hosp = DB::select("select hospitalId from Hospitals where Type='General_Hospital' 
                   and hospitalId not in (select hospitalId from Covid19HealthOfficer)");

        if(count(json_decode(json_encode($hosp),true))>0) {
          DB::insert("insert into Covid19HealthOfficer (username, hospitalId) values (?,?)", [$request->username, $hosp[0]->hospitalId]);
        }else{
          $hosp = DB::select("select hospitalId, min(number) from (select hospitalId, count(hospitalId) as 'number' from Covid19HealthOfficer where present='Yes' group by hospitalId) as tempt3 group by hospitalId;");
          $hosp = json_decode(json_encode($hosp),true);
          DB::insert("insert into Covid19HealthOfficer (username, hospitalId) values (?,?)", [$request->username, $hosp[0]['hospitalId']]);
        }

        if($ch==1) {
          echo 'You recorded ' . $request->name . ' successfully.';
        }else{
          echo 'Error, record was not taken';
        }
      }
    }

    public function displayForm(){
      $gen = json_encode(DB::select("select hospitalId, hospitalName from Hospitals where Type='General_Hospital';"));
      $reg = json_encode(DB::select("select hospitalId, hospitalName from Hospitals where Type='Regional_Referral_Hospital';"));
      return view::make('officerRegistration')->with(['generals'=>$gen,'regionals'=>$reg]);
    }

    public function getDoctors(Request $request){
      $genDrs = json_decode(json_encode(DB::select("select username, fullname from HealthWorkers where username in (select username from Covid19HealthOfficer where hospitalId=? and present='Yes') and username not in (select head from HospitalHeads);",[$request->id])),true);
      $regDrs = json_decode(json_encode(DB::select("select username, fullname from HealthWorkers where username in (select username from SenCovid19HealthOfficer where hospitalId=? and present='Yes') and username not in (select head from HospitalHeads);",[$request->id])),true);
      $head = json_decode(json_encode(DB::select("select fullName from HealthWorkers where username in (select head from HospitalHeads where hospitalId=?);",[$request->id])),true);
      if ($request->type=="General_Hospital"){
        $genDrs = array($genDrs,$head);
        echo json_encode($genDrs);
      }else{
        $regDrs = array($regDrs,$head);
        echo json_encode($regDrs);
      }
    }

    public function promote(Request $request){
      $count = count(json_decode(json_encode(DB::select("select * from HospitalHeads where hospitalId=?;",[$request->id])),true));
      if ($count==0){
        $x = DB::insert("insert into HospitalHeads (hospitalId, head) values (?,?);",[$request->id,$request->username]);
        if ($x==1){
          echo "Promotion successful";
        }
      }else{
        $y = DB::update("update HospitalHeads set head=? where hospitalId=?;",[$request->username,$request->id]);
        if ($y==1){
          echo "Promotion successful";
        }
      }
    }
}

