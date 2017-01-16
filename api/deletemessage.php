<?php
include 'connection.php';
	$idroom = $_POST['idroom'];
	$sqlDeleteDetail = "DELETE FROM message_details WHERE room =$idroom";
	$result = mysqli_query($con,$sqlDeleteDetail);
	if ($result) {
		$sqldeleteMessage = mysqli_query($con,"DELETE FROM messages WHERE room =$idroom");
		if ($sqldeleteMessage) {
			echo "success";
		}else{
			echo "gagal";
		}

	}else{
		echo "gagal delete detail messages";
	}
 ?>
