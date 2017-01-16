<?php
include "connection.php";
$message = $_POST['message'];
$receiver = $_POST['idreceiver'];
$title = $_POST['title'];
$pathFCM = "https://fcm.googleapis.com/fcm/send";
$serverKey = "AIzaSyDPnGGCUpJmfjFFt4h9HYBZjNbC6ZVH-xQ";
$sql = "SELECT device_id FROM device WHERE user_id='$receiver'";
$res = mysqli_query($con,$sql);
$found=mysqli_num_rows($res);
	$num=0;
    // kalau id device ditemukan
    if ($found > 0){
    	while($r = mysqli_fetch_row($res)) {
			$num++;
			$token = $r[0];
			$data[] = array('no' =>$num,'token' =>$token);
			$headers = array(
				'Authorization:key='.$serverKey,
				'Content-Type:application/json'
				);

			$fields = array(
				'to' => $token,
				'notification' => array('title' => $title,'body' => $message)
				);

			$payload = json_encode($fields);
			$curl_session = curl_init();
			curl_setopt($curl_session, CURLOPT_URL, $pathFCM);
			curl_setopt($curl_session, CURLOPT_POST, true);
			curl_setopt($curl_session, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl_session, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($curl_session, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
			curl_setopt($curl_session, CURLOPT_POSTFIELDS, $payload);
			$result = curl_exec($curl_session);
			if ($result) {
				echo $result;
			}else {
				echo "Failed";
			}
			curl_close($curl_session);


		}
		echo json_encode($data);

			mysqli_close($con);
}else{
	echo mysqli_error($con);
}

?>
