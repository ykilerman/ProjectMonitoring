<?php
	include "connection.php";
	$type = "Consultation";
	$sql = "SELECT id FROM projects WHERE type = '$type' ORDER BY id DESC LIMIT 1";
	$res = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($res);
	$code = substr($row['id'], 0, 2);
	$last_id = (int)substr($row['id'], 2, 10);
	$next_id = 10000000001 + $last_id;
	$id = $code . substr("$next_id", 1, 10);
	echo $last_id . " => " . $id;
?>
