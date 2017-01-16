<?php
  	include "connection.php";
	sleep(2);

	if (isset($_POST['login'])) {
	$data = array();

	$offsetSepuluh = "SELECT * FROM users ORDER BY name ASC";
	$query = mysqli_query($con,$offsetSepuluh);

      $count = mysqli_num_rows($query);



    if ($count > 0){

		  while($row = mysqli_fetch_row($query)) {

		  	$id = $row[0];
		  	$name = $row[3];
		  	$position =$row[4];
		  	$data[] = array('id' =>$id ,'name' =>$name ,'position' =>$position);

			}
			echo json_encode($data);
        }else{
        	$data[] = array('id' =>"" ,'name' =>"" ,'position' =>"");
        	echo json_encode($data);
        }




	mysqli_close($con);
}
else{
	echo "You can Access this Page";
}

?>
