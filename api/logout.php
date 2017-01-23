<?php
include "connection.php";
$userid = $_POST['userid'];
$deviceid = $_POST['deviceid'];
if (isset($deviceid) and isset($userid)) {
	# code...

$sql = "DELETE FROM devices WHERE device_id='$deviceid' and user_id ='$userid'";

$res = mysqli_query($con,$sql);
if ($res) {
	echo "Success";
	# code...
}else {
	$ada = "Failed ".mysqli_error($con);
	echo $ada;
}
mysqli_close($con);
}

 ?>
