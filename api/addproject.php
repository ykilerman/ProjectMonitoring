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

		$sql = "SELECT id FROM projects WHERE type = '$type' ORDER BY id DESC LIMIT 1";
		$res = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($res);
		$code = substr($row['id'], 0, 2);
		$last_id = (int)substr($row['id'], 2, 10);
		$next_id = 10000000001 + $last_id;
		$id = $code . substr("$next_id", 1, 10);

		$sql = "INSERT INTO projects(id,name,description,icon_path,client_name,value,update_schedule,user_id,type,created_at,updated_at)
		VALUES ('$id','$title','$desc','$name.jpg','$client_name','$value','$update_schedule','$userid','$type',now(),now())";

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
