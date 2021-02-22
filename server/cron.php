<?php
//function that adds data to database
function write($enrollment_file, $conn, $drs){
    if ($enrollment_file!=NULL){
        while(!feof($enrollment_file)){
            $line = trim(fgets($enrollment_file));
            $line_array = explode(",",$line);
            if($line_array[0]!="") {
                $name = $line_array[0];
                $date = $line_array[1];
                $gender = $line_array[2];
                $category = $line_array[3];
                $user = $line_array[4];
                //query template
                $sql ="insert into Patients (patientName, dateOfId, gender, category,";
                if (array_search($user,$drs["CHO"])!==false){
                    $sql.= "CHOUsername)VALUES ('".$name."','".$date."','".$gender."','".$category."','".$user."');";
                    $conn->query($sql);
                }else if(array_search($user,$drs["SCHO"])!==false){
                    $sql.= "SCHOUsername)VALUES ('".$name."','".$date."','".$gender."','".$category."','".$user."');";
                    $conn->query($sql);
                }else if(array_search($user,$drs["CC"])!==false){
                    $sql.= "CCUsername)VALUES ('".$name."','".$date."','".$gender."','".$category."','".$user."');";
                    $conn->query($sql);
                }
            }
        }
    }
}

//connecting to database
$servername = "localhost"; //change servername
$username = "root";        //change username
$password = "o##e8ii4#?";  //change password
$database = "casetool";

$connection = new mysqli($servername,$username,$password,$database);

//Array of doctors available
$doctors = array("CHO"=>array(),"SCHO"=>array(),"CC"=>array());

$result1 = $connection->query("select username from Covid19HealthOfficer where present='Yes'");
$result2 = $connection->query("select username from SenCovid19HealthOfficer where present='Yes'");
$result3 = $connection->query("select username from Covid19Consultant where present='Yes'");

if($result1->num_rows>0){
    while ($row = $result1->fetch_assoc()){
        array_push($doctors["CHO"],$row['username']);
    }
}

if($result2->num_rows>0){
    while ($row = $result2->fetch_assoc()){
        array_push($doctors["SCHO"],$row['username']);
    }
}

if($result3->num_rows>0){
    while ($row = $result3->fetch_assoc()){
        array_push($doctors["CC"],$row['username']);
    }
}

//directory where files are
$directory = getcwd();

if(strpos($directory,"server")){
    $directory .= "/enrollment_files/";
} else{
    $directory .= "/server/enrollment_files/";
}

$direct_container = opendir($directory);  //opening directory

//getting files in directory
while (($file_name = readdir($direct_container))!== false){
    //if file is an enrollment file
    if(strpos($file_name,"enroll.txt")){
        $file = fopen($directory.$file_name,"r");
        write($file,$connection,$doctors);
        fclose($file);
        $file = fopen($directory.$file_name,"w");
        fclose($file);
    }
}
$connection->query("CALL ToSenior;");
$connection->query("CALL ToConsultant;");
closedir($direct_container);
$connection->close();
