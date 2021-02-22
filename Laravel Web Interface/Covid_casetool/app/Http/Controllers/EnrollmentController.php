<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class EnrollmentController extends Controller
{
  public function index()
  {
    $figures = DB::select("SELECT Month, COUNT('Month') AS 'Number' FROM
                    (SELECT CONCAT(YEAR(dateOfId),',',MONTH(dateOfId)) AS 'Month' from Patients) AS Temp_patient
                    GROUP BY Month ORDER BY Month;");
    $figures = json_decode(json_encode($figures), true);
    $dat = array();
    $hold = array();

    $message = array();

    //grouping months according to year
    foreach ($figures as $figure) {
      $year = strtok($figure['Month'], ",");
      $mon_no = strtok(",");
      $mon_no = "".(int)$mon_no."";
      if (!array_key_exists($year, $dat)) {
        $dat[$year] = array();
        $message[$year] = array();
      }
      if (!array_key_exists($year, $hold)) {
        $hold[$year] = array();
      }
      array_push($dat[$year], array($mon_no => $figure['Number']));
      array_push($hold[$year], array($mon_no => "a"));

      //if month is december, create month "0" for 1 to use
      if($mon_no=="12"){
        $mon_no="0";
        $year = (int)$year + 1;
        $year = "".$year."";
        if (!array_key_exists($year, $dat)) {
          $dat[$year] = array();
          $hold[$year] = array();
          $message[$year] = array();
        }
        array_push($dat[$year], array($mon_no => $figure['Number']));
        array_push($hold[$year], array($mon_no => "a"));
      }
    }

    //calcutation
    foreach ($dat as $x => $y) {
      for ($i = 0; $i < count($y); $i++) {
        foreach ($y[$i] as $mon => $numb) {
          $mon = (int)$mon;
          $numb = (int)$numb;
          if ($mon > 0){
            $prev = "".($mon - 1)."";
            foreach ($y as $ind=>$val){
              foreach ($val as $k=>$v) {
                if ($k == $prev) {
                  $percentage = (($numb-$v)/$v)*100;
                  $hold[$x][$i]["".$mon.""] = $percentage;
                }
              }
            }
          }
        }
      }
    }


    foreach ($hold as $x => $y) {
      for ($i = 0; $i < count($y); $i++) {
        foreach ($y[$i] as $mon => $numb) {
          $mon = (int)$mon;
          if ($hold[$x][$i]["".$mon.""]!="a"){
            array_push($message[$x],$hold[$x][$i]);
          }
        }
      }
    }

    $info = array();
    $months = array('no','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
    foreach ($message as $x => $y) {
      $yr = $x;
      $string_labels = array();
      $string_data = array();
      for ($i = 0; $i < count($y); $i++) {
        if(count($y[$i])>0) {
          foreach ($y[$i] as $mon => $numb) {
            $mon = (int)$mon;
            if ($mon > 0) {
              array_push($string_labels, $months[$mon]);
              array_push($string_data, $message[$x][$i]["" . $mon . ""]);
            }
          }
        }
      }
      $info[$yr] = array("labels"=>$string_labels,"dataArray"=>$string_data);
    }
    return view::make('enrollmentGraphs')->with(['info' => $info]);
  }
}
