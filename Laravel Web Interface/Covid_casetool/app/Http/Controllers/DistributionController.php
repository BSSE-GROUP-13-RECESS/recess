<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class DistributionController extends Controller
{
    public function staff(){
      $staff_money = DB::select("SELECT t1.date, t1.amount, t1.staffUsername, t2.staffFullName
                  FROM Salary t1 INNER JOIN Staff t2 USING(staffUsername);");

      $staff_money = json_decode(json_encode($staff_money),true);
      return view::make('staffSalaries')->with(['staffSalaries'=>$staff_money,'total_rw'=>count($staff_money)]);
    }

    public function doctors(){
        $doctor_money = DB::select("SELECT t1.date, t1.amount, t1.CHOUsername AS 'doctor',
        t2.fullName FROM Salary t1 INNER JOIN HealthWorkers t2
        ON t1.CHOUsername = t2.username
        UNION
        SELECT t4.date, t4.amount, t4.SCHOUsername AS 'doctor',
        t5.fullName FROM Salary t4 INNER JOIN HealthWorkers t5
        ON t4.SCHOUsername = t5.username
        UNION
        SELECT t7.date, t7.amount, t7.CCUsername AS 'doctor',
        t8.fullName FROM Salary t7 INNER JOIN HealthWorkers t8
        ON t7.CCUsername = t8.username;");

        $doctor_money = json_decode(json_encode($doctor_money),true);

        return view::make('doctorSalaries')->with(['doctorSalaries'=>$doctor_money,'total_doc'=>count($doctor_money)]);
    }
}
