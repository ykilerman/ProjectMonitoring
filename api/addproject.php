<?php
if ($_SERVER['REQUEST_METHOD']=='POST') {
	include "connection.php";
	if (isset($_POST['image'])) {
		$now = DateTime::createFromFormat('U.u',microtime(true));
		$name = $now->format('YmdHisu');
		$path = "../web/system/storage/app/public/images/icon/$name.jpg";
		$image = $_POST['image'];
		$type = $_POST['type'];
		$title = $_POST['title'];
		$desc = $_POST['description'];
		$client_name = $_POST['client_name'];
		$value =$_POST['value'];
		$update_schedule=$_POST['update_schedule'];
		$userid=$_POST['userid'];



		$sql = "INSERT INTO projects(name,description,icon_path,client_name,value,update_schedule,user_id,type,created_at,updated_at)
		VALUES ('$title','$desc','$name.jpg','$client_name','$value','$update_schedule','$userid','$type',now(),now())";

		if (mysqli_query($con, $sql)) {
		file_put_contents($path, base64_decode($image));

			echo "Success";
			exit;
		}
		else{
			echo "Failed";
			exit;
		}


	}else {
		echo "no image selected";
	}


}else{
	echo "can't access this page with your method";
}

 ?>
