<?php
	require_once('connection.php');

	$project_id = $_POST['idproject'];
	$highlight = $_POST['highlight'];
	$description = $_POST['description'];
	$status = $_POST['status'];
	if (isset($project_id) && isset($highlight) && isset($status)) {


			$sqlInsertUpdate = "INSERT INTO updating_statuses(project_id,highlight,description) VALUES('$project_id','$highlight','$description')";
			$resInsert = mysqli_query($con,$sqlInsertUpdate);
			if ($resInsert) {

				$sqlUpdate = "UPDATE projects SET  status='$status' WHERE id='$project_id'";
				$resUpdate = mysqli_query($con,$sqlUpdate);
				if ($resUpdate) {
					$status = "success";

				}
			}else{
				$status = "error";

			}


	mysqli_close($con);

	echo $status;
	}



?>
