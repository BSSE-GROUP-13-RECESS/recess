<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class PatientlistController extends Controller{
    public function index(){
        $query = "SELECT t1.patientId, t1.patientName, t1.dateOfId, t1.gender, t1.category,
                    t3.fullName, t4.hospitalName FROM Patients t1 INNER JOIN Covid19HealthOfficer t2
                    ON t1.CHOUsername = t2.username INNER JOIN HealthWorkers t3
                    ON t2.username = t3.username INNER JOIN Hospitals t4
                    ON t2.hospitalId = t4.hospitalId
                    UNION
                    SELECT t1.patientId, t1.patientName, t1.dateOfId, t1.gender, t1.category,
                    t3.fullName, t4.hospitalName FROM Patients t1 INNER JOIN SenCovid19HealthOfficer t2
                    ON t1.SCHOUsername = t2.username INNER JOIN HealthWorkers t3
                    ON t2.username = t3.username INNER JOIN Hospitals t4
                    ON t2.hospitalId = t4.hospitalId
                    UNION
                    SELECT t1.patientId, t1.patientName, t1.dateOfId, t1.gender, t1.category,
                    t3.fullName, t4.hospitalName FROM Patients t1 INNER JOIN Covid19Consultant t2
                    ON t1.CCUsername = t2.username INNER JOIN HealthWorkers t3
                    ON t2.username = t3.username INNER JOIN Hospitals t4
                    ON t2.hospitalId = t4.hospitalId;";

        $patients = DB::select($query);
        $patients = json_decode(json_encode($patients),true);
        return view::make('patientlist')->with(['patients'=>$patients,'total'=>count($patients)]);
    }
}
