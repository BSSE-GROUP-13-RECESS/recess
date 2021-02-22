<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class FundsRegistrationController extends Controller
{
    public function index(Request $request){
      $email = Auth::user()->email;
      $name = $request->name;
      $amount = $request->amount;

      $ch = DB::insert("insert into Donations (created_at, updated_at, wellwisherName, amount, balance, adminEmail) VALUES(CURRENT_DATE ,CURRENT_DATE ,?,?,?,?)",[$name,$amount,$amount,$email]);

      if($ch==1) {
        echo 'Donation by '.$name.' recorded successfully.';
      }else{
        echo 'Error, record was not taken';
      }
    }

    //function that distributes the money
    public function distribute(){
        $available = json_decode(json_encode(DB::select("select sum(balance) as 'sum' from Donations;")),true);
        $sum = $available[0]['sum'];
        if($sum==null){
          $sum=0;
        }

        $month1 = json_decode(json_encode(DB::select("select CONCAT(YEAR(date),'-',MONTH(date)) AS month from Expenditure;")),true);;
        $month2 = json_decode(json_encode(DB::select("select CONCAT(YEAR(CURRENT_DATE),'-',MONTH(CURRENT_DATE)) as month;")),true);;
        if ($month1[0]['month']==$month2[0]['month']){
          echo "All officials received salary for this month.";
        } else if($sum<=100000000&&$sum>50000000){
            DB::insert("insert into Expenditure (date, spent, balance) VALUES (CURRENT_DATE ,?,?)",[0,$sum]);
            DB::update("update Donations set balance=0;");
            echo "The funds are not greater than 100M.<br>All money was saved.";
        } else if ($sum>100000000){
            $sum = $sum - 100000000;

            $directors = json_decode(json_encode(DB::select("select director from users where director is not null and name!='unknown';")),true);

            $seniors = json_decode(json_encode(DB::select("select username from SenCovid19HealthOfficer where username not in
            (select head from HospitalHeads) and present='Yes';")),true);

            $covidhos = json_decode(json_encode(DB::select("select username from Covid19HealthOfficer where username not in
            (select head from HospitalHeads) and present='Yes';")),true);

            $admins = json_decode(json_encode(DB::select("select email from users where director is null;")),true);

            $supers = json_decode(json_encode(DB::select("select username from Covid19HealthOfficer where username in
            (select head from HospitalHeads) and present='Yes';")),true);

            $headcovidhos = json_decode(json_encode(DB::select("select username from SenCovid19HealthOfficer where username in
            (select head from HospitalHeads) and present='Yes';")),true);


            $director_sal = 5000000;
            $sup_sal = 0.5*$director_sal;
            $admin_sal = 0.75*$sup_sal;
            $covidho_sal = 1.6*$admin_sal;
            $senior_sal = $covidho_sal + 0.06*$covidho_sal;
            $headcovid_sal = $covidho_sal + 0.035*$covidho_sal;

            $salary = array($director_sal*count($directors),$sup_sal*count($supers),$admin_sal*count($admins),
              $covidho_sal*count($covidhos),$senior_sal*count($seniors),$headcovid_sal*count($headcovidhos));

            $remaining1 = $sum-(array_sum($salary));

            $director_b = 0.05*$remaining1;
            $sup_b = 0.5*$director_b;
            $admin_b = 0.75*$sup_b;
            $covidho_b = 1.6*$admin_b;
            $senior_b = $covidho_b + 0.06*$covidho_b;
            $headcovid_b = $covidho_b + 0.035*$covidho_b;

            $bonus = array($director_b*count($directors),$sup_b*count($supers),$admin_b*count($admins),
              $covidho_b*count($covidhos),$senior_b*count($seniors),$headcovid_b*count($headcovidhos));
            $remaining2 = $remaining1-(array_sum($bonus));

            if($remaining1>=0){
              if ($remaining2>=0){
                foreach ($directors as $director) {
                  DB::insert("insert into Salary(date, amount, staffUsername) VALUES (CURRENT_DATE,?,?)", [$director_sal+$director_b, $director['director']]);
                }
                foreach ($seniors as $senior) {
                  DB::insert("insert into Salary(date, amount, SCHOUsername) VALUES (CURRENT_DATE,?,?)", [$senior_sal+$senior_b, $senior['username']]);
                }
                foreach ($admins as $admin) {
                  DB::insert("insert into Salary(date, amount, adminEmail) VALUES (CURRENT_DATE,?,?)", [$admin_sal+$admin_b, $admin['email']]);
                }
                foreach ($headcovidhos as $headcovidho) {
                  DB::insert("insert into Salary(date, amount, CHOUsername) VALUES (CURRENT_DATE,?,?)", [$headcovid_sal+$headcovid_b, $headcovidho['username']]);
                }
                foreach ($covidhos as $covidho) {
                  DB::insert("insert into Salary(date, amount, CHOUsername) VALUES (CURRENT_DATE,?,?)", [$covidho_sal+$covidho_b, $covidho['username']]);
                }
                foreach ($supers as $super) {
                  DB::insert("insert into Salary(date, amount, SCHOUsername) VALUES (CURRENT_DATE,?,?)", [$sup_sal+$sup_b, $super['username']]);
                }
                DB::insert("insert into Expenditure (date, spent, balance) VALUES (CURRENT_DATE ,?,?)",[array_sum($salary)+array_sum($bonus),$remaining2+100000000]);
                DB::update("update Donations set balance=0;");
                echo "Money spent on salary: ".(array_sum($salary)+array_sum($bonus))."/=\n
                      Money saved: ".($remaining2+100000000)."/=";
              }else {
                foreach ($directors as $director) {
                  DB::insert("insert into Salary(date, amount, staffUsername) VALUES (CURRENT_DATE,?,?)", [$director_sal, $director['director']]);
                }
                foreach ($seniors as $senior) {
                  DB::insert("insert into Salary(date, amount, SCHOUsername) VALUES (CURRENT_DATE,?,?)", [$senior_sal, $senior['username']]);
                }
                foreach ($admins as $admin) {
                  DB::insert("insert into Salary(date, amount, adminEmail) VALUES (CURRENT_DATE,?,?)", [$admin_sal, $admin['email']]);
                }
                foreach ($headcovidhos as $headcovidho) {
                  DB::insert("insert into Salary(date, amount, CHOUsername) VALUES (CURRENT_DATE,?,?)", [$headcovid_sal, $headcovidho['username']]);
                }
                foreach ($covidhos as $covidho) {
                  DB::insert("insert into Salary(date, amount, CHOUsername) VALUES (CURRENT_DATE,?,?)", [$covidho_sal, $covidho['username']]);
                }
                foreach ($supers as $super) {
                  DB::insert("insert into Salary(date, amount, SCHOUsername) VALUES (CURRENT_DATE,?,?)", [$sup_sal, $super['username']]);
                }
                DB::insert("insert into Expenditure (date, spent, balance) VALUES (CURRENT_DATE,?,?)",[array_sum($salary),$remaining1+100000000]);
                DB::update("update Donations set balance=0;");
                echo "Money spent on salary: ".(array_sum($salary))."/=\n
                      Money saved: ".($remaining1+100000000)."/=";
              }
            }else{
              $needed = 0-$remaining1;
              echo "You need ".$needed."/= more to pay all officers.\nNo distributions were made.";
            }
        }else{
          echo "No distributions made because funds are less than 50M";
        }
    }
}
