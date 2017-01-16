<?php
  	include "connection.php";
	sleep(2);

	$id = $_POST['id'];
	$offset = $_POST['offset'];

	$offsetSepuluh = "SELECT * FROM reports WHERE project_id='$id' ORDER BY created_at DESC LIMIT $offset,10";
	$query = mysqli_query($con,$offsetSepuluh);

      $count = mysqli_num_rows($query);
      $json_kosong = 0;


        if($count==0){
          $json_kosong = 1;
        }else{

        $num = $offset;
        $json = '[';

		  while ($row = mysqli_fetch_array($query)){
		    $num++;
		    $char ='"';
				$json .= '{
					"no": '.$num.',
					"id": "'.$row['id'].'",
					"highlight": "'.$row['highlight'].'",
					"activity": "'.$row['activity'].'",
					"activity_path": "'.$row['activity_path'].'",
					"income": "'.$row['income'].'",
					"income_path": "'.$row['income_path'].'",
					"expense": "'.$row['expense'].'",
					"expense_path": "'.$row['expense_path'].'"
				},';
			}
        }


	$json = substr($json,0,strlen($json)-1);


	if($json_kosong==1){
		$json = '[{ "no": "", "id": "", "name": "", "username": "", "position": ""}]';
	}else{
		$json .= ']';
	}
	echo $json;

	mysqli_close($con);
?>
