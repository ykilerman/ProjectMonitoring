<?php
error_reporting(0);

$user = $_POST['username'];
$password = $_POST['password'];


//Importing database
$data = array();
require_once('connection.php');


$sql = "SELECT * FROM users WHERE position='Project Coordinator'";
$res = mysqli_query($con,$sql);



$found=mysqli_num_rows($res);

    // Apabila username dan password ditemukan
    if ($found > 0){
      while($r = mysqli_fetch_array($res)) {
          $uid         = $r['id'];
          $name         = $r['name'];

          $data[] = array('uid' =>$uid ,'name' =>$name );


      }

        $dataCoordinator['coordinator'] = $data;
        echo json_encode($dataCoordinator);


    }
    else{

    $data[] = array('name' =>"");
    echo json_encode($data);
  }


?>
