<?php
	include "connection.php";
  date_default_timezone_set("Asia/Jakarta");
  $jam = date('G'); //format jamnya 0-23 bukan 00-23
	error_reporting(0);
  	$position = $_POST['position'];
  	$userid = $_POST['userid'];
  	switch ($position) {
  	 	case 'Stakeholder':
        $sqlSelect = "SELECT id,name,COUNT(created_at) as jumlah FROM projects where status='On Going' and datediff(ADDDATE(last_notification,update_schedule),current_date()) < 0 ";
        break;
      case 'Management':
        $sqlSelect = "SELECT id,name,COUNT(created_at) as jumlah FROM projects where status='On Going' and datediff(ADDDATE(last_notification,update_schedule),current_date()) < 0 ";
        break;

  	 	case 'Project Coordinator':

			$sqlSelect = "SELECT id,name,COUNT(created_at) as jumlah FROM projects where status='On Going' and datediff(ADDDATE(last_notification,update_schedule),current_date()) < 1 and user_id=$userid ";

  	 		break;

  	 	default:
  	 		$sqlSelect = "";
  	 		break;


  	 }

  	 if ($sqlSelect!="") {
  	 	$actionSelect = mysqli_query($con,$sqlSelect);
  		$count = mysqli_num_rows($actionSelect);

	    if ($count > 0){

			while($row = mysqli_fetch_row($actionSelect)) {

			  	$id = $row[0];
			  	$name = $row[1];
			  	$jumlah =$row[2];
			  	$data[] = array('id' =>$id ,'name' =>$name ,'jumlah' =>$jumlah,'jam' =>$jam);

				}
				echo json_encode($data);
	        }else{
	        	$data[] = array('id' =>"" ,'name' =>"",'jumlah' =>"",'jam' =>"");
	        	echo json_encode($data);
	        }

    mysqli_close($con);
  	 	}
 ?>
