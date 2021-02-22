<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class DonationsController extends Controller
{
    public function index(){
      $results = DB::select("SELECT CONCAT(YEAR(created_at),',',MONTH(created_at)) as date, wellwisherName as well, amount FROM Donations;");
      $results = json_decode(json_encode($results),true);
      $months = array('no','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');

      $dat = array();
      $dat1 = array();
      $byMonth = array();
      $byWell = array();

      //grouping wellwishers according to months
      foreach ($results as $result) {
        $year = strtok($result['date'], ",");
        $mon_no = strtok(",");
        $mon_no = (int)$mon_no;
        $mon_no = $months[$mon_no];
        if (!array_key_exists($year, $dat)) {
          $dat[$year] = array();
          $byMonth[$year]=array();
        }
        if (!array_key_exists($mon_no, $dat[$year])) {
          $dat[$year][$mon_no] = array();
          $byMonth[$year][$mon_no] = array();
        }
        array_push($dat[$year][$mon_no], array($result['well'] => $result['amount']));
      }

      //grouping months according wellwisher
      foreach ($results as $result) {
        $year = strtok($result['date'], ",");
        $mon_no = strtok(",");
        $mon_no = (int)$mon_no;
        $mon_no = $months[$mon_no];
        $well = $result['well'];
        if (!array_key_exists($year, $dat1)) {
          $dat1[$year] = array();
          $byWell[$year] = array();
        }
        if (!array_key_exists($well, $dat1[$year])) {
          $dat1[$year][$well] = array();
          $byWell[$year][$well] = array();
        }
        array_push($dat1[$year][$well], array($mon_no => $result['amount']));
      }

      foreach ($dat as $x => $y) {
        foreach ($y as $i=>$j) {
          $string_labels = array();
          $string_data = array();
          foreach ($j as $mon => $data) {
            foreach ($data as $key=>$value) {
              array_push($string_labels, $key);
              array_push($string_data, $value);
            }
          }
          $byMonth[$x][$i] = array("labels"=>$string_labels,"dataArray"=>$string_data);
        }
      }

      foreach ($dat1 as $x => $y) {
        foreach ($y as $i=>$j) {
          $string_labels = array();
          $string_data = array();
          foreach ($j as $mon => $data) {
            foreach ($data as $key=>$value) {
              array_push($string_labels, $key);
              array_push($string_data, $value);
            }
          }
          $byWell[$x][$i] = array("labels"=>$string_labels,"dataArray"=>$string_data);
        }
      }

      return view::make('donations')->with(['byMonth'=>$byMonth,'byWell'=>$byWell,'total_dona'=>count($results)]);
    }
}
