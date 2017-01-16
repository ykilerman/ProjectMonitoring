<?php
	include "connection.php";

		$now = DateTime::createFromFormat('U.u',microtime(true));
		$name = $now->format('YmdHisu');
		$path = "Image/$name.jpg";
		$idProject = $_POST['id'];
		$image = $_POST['image'];
		$title = $_POST['title'];
		$type = $_POST['type'];
		$desc = $_POST['description'];
		$client_name = $_POST['client_name'];
		$value =$_POST['value'];
		$update_schedule=$_POST['update_schedule'];
		$userid=$_POST['userid'];


		$verifikasiGambar="SELECT icon_path FROM projects WHERE id=$idProject";
		$result = mysqli_query($con, $verifikasiGambar);
		if (mysqli_num_rows($result) > 0) {
		    $row = mysqli_fetch_assoc($result);
		    $pathIconProject = $row['icon_path'];

			if ($_POST['photopath'] == "") {
				$sql = "UPDATE projects SET user_id='$userid', type = '$type', name = '$title', description = '$desc',client_name='$client_name', value = '$value',update_schedule='$update_schedule' WHERE projects.id = $idProject";


			}else{
				$sql = "UPDATE projects SET user_id='$userid', type = '$type', name = '$title', description = '$desc',icon_path='http://10.0.3.2/pmonitoring/Image/$name.jpg',client_name='$client_name', value = '$value',update_schedule='$update_schedule' WHERE projects.id = $idProject";


			}

			if (mysqli_query($con, $sql)) {
			file_put_contents($path, base64_decode($image));

				echo "Success";
				exit;
			}
			else{
				echo "Failed";
				exit;
			}

		}







 ?>
