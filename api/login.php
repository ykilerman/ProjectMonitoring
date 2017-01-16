<?php
error_reporting(0);

$user = $_POST['username'];
$password = $_POST['password'];
$deviceid = $_POST['deviceid'];


//Importing database
$data = array();
require_once('connection.php');


$sql = "SELECT * FROM users WHERE username='$user' and password='$password'";
$res = mysqli_query($con,$sql);



$found=mysqli_num_rows($res);

    // Apabila username dan password ditemukan
    if ($found > 0){
    	while($r = mysqli_fetch_row($res)) {
        	$uid         = $r[0];
          $username   = $r[1];
          $password   = $r[2];
      		$name       = $r[3];
          $position   = $r[4];
      		$data[] = array('uid' =>$uid ,'username' =>$username ,'password' =>$password , 'name'=>$name,'position'=>$position);
          $sqlUpdateID = mysqli_query($con,"INSERT INTO device (device_id,user_id) VALUES('$deviceid','$uid')");

    	}

        echo json_encode($data);


    }
    else{

		$data[] = array('uid' =>"" ,'username' =>"" , 'name'=>"errorpass",'position'=>"");
		echo json_encode($data);
	}


?>
