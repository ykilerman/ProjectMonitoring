<?php
	require_once('connection.php');

	$id = $_POST['uid'];
	$password = $_POST['password'];
	$data = array();


			$sql = "UPDATE users SET  password='$password' WHERE id='$id'";



	if (mysqli_query($con, $sql)) {
		$status = "success";
		$message ="congrats your password has been change";
		$data[] = array('status' =>$status , 'message'=>$message);
	} else {
		$status = "error";
		$message ="Error: " . $sql . "<br>" . mysqli_error($con);
		$data[] = array('status' =>$status , 'message'=>$message);
	}
	mysqli_close($con);

	echo json_encode($data);



?>
