<?php
if ($_SERVER['REQUEST_METHOD']=='POST') {


$user = $_POST['username'];
$password = $_POST['password'];
$nama = $_POST['name'];
$position = $_POST['position'];

$data = array();
require_once('connection.php');
$sql = "INSERT INTO users (username,password,name,position) VALUES ('$user','$password','$nama','$position')";


if (mysqli_query($con, $sql)) {
	$status = "success";
	$message ="congrats ! ".$nama. " has been active";
	$data[] = array('status' =>$status , 'message'=>$message);
} else {
	$status = "error";
	$message ="Error: " . $sql . "<br>" . mysqli_error($con);
	$data[] = array('status' =>$status , 'message'=>$message);
}
mysqli_close($con);

}else {
	$data[] = array('status' =>"error_connection" , 'message'=>"tidak Ada koneksi ke database");
}
echo json_encode($data);



?>
