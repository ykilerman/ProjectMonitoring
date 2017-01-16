<?php
	require_once('connection.php');

	$id = $_POST['id'];
	$user = $_POST['username'];
	$password = $_POST['password'];
	$nama = $_POST['name'];
	$position = $_POST['position'];
	$data = array();

	if ($password =="") {
			$sql = "UPDATE users SET username='$user',name='$nama',position='$position'WHERE
			id='$id'";
		}else{
			$sql = "UPDATE users SET  username='$user',name='$nama',password='$password',position='$position' WHERE
			id='$id'";
		}


	if (mysqli_query($con, $sql)) {
		$status = "success";
		$message ="congrats ! account with ID : ".$id. " has been change";
		$data[] = array('status' =>$status , 'message'=>$message);
	} else {
		$status = "error";
		$message ="Error: " . $sql . "<br>" . mysqli_error($con);
		$data[] = array('status' =>$status , 'message'=>$message);
	}
	mysqli_close($con);


	echo json_encode($data);



?>
