<?php
// if ($_SERVER['REQUEST_METHOD']=='POST') {
require_once('connection.php');

$sender = $_POST['sender'];
$room = $_POST['room'];
$subject = $_POST['subject'];
$message = $_POST['message'];
$receiver = $_POST['receiver'];
date_default_timezone_set("Asia/Jakarta");
$now = date('Y-m-d H-i-s');


$data = array();

$sql = "INSERT INTO messages (user_id,room,subject,message,created_at,updated_at) VALUES ('$sender','$room','$subject','$message','$now','$now')";


if (mysqli_query($con, $sql)) {
	$idMessage = mysqli_insert_id($con);

	if ($idMessage != null) {
		$sqlDetail = "INSERT INTO message_details (message_id,user_id,room) VALUES ('$idMessage','$receiver','$room')";
		if (mysqli_query($con,$sqlDetail)) {

			$status = "success";
			$message ="Your message has been sent, click ok to see your message";

		}else{
			$status = "error";
			$message ="gagal insert ke tabel detail ";

		}

			$data[] = array('status' =>$status , 'message'=>$message);

	}
} else {
	$status = "error";
	$message ="Gagal insert ketabel messages karena : " . $sql . "<br>" . mysqli_error($con);
	$data[] = array('status' =>$status , 'message'=>$message);
}
mysqli_close($con);

// }else {
// 	$data[] = array('status' =>"error_connection" , 'message'=>"tidak Ada koneksi ke database");
// }
echo json_encode($data);




?>
