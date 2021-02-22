<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DirectorForm extends Controller
{
  public function form()
  {
    $options = DB::select('select users.director, H.hospitalName from users INNER JOIN Staff S on users.director = S.staffUsername INNER JOIN Hospitals H on S.hospitalId = H.hospitalId;');

    return view('directorRegistration')->with(['options'=>$options,'resp'=>'register']);
  }

  use RegistersUsers;

  public function change(Request $data){
      $this->validate($data, [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
      ]);

      $name = $data->name;
      $email = $data->email;
      $director = $data->director;
      $pass = Hash::make($data->password);
      DB::update('update users set email=?, name=?, password=?, updated_at=CURRENT_TIMESTAMP where director=?',[$email,$name,$pass,$director]);
      $options = DB::select('select users.director, H.hospitalName from users INNER JOIN Staff S on users.director = S.staffUsername INNER JOIN Hospitals H on S.hospitalId = H.hospitalId;');
      return view('directorRegistration')->with(['options'=>$options,'resp'=>'success']);
  }
}
