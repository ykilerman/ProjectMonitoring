<?php
error_reporting(0);

$room = $_POST['room'];
$userid = $_POST['userid'];
$unread = $_POST['unread'];


//Importing database
$data = array();
require_once('connection.php');


$sql = "SELECT messages.id,users.name, messages.room, messages.message, messages.created_at FROM messages,users WHERE messages.sender_id=users.id AND messages.room =$room AND ( messages.sender_id =$userid OR messages.receiver_id=$userid) GROUP BY messages.id  ORDER BY created_at ASC";
$res = mysqli_query($con,$sql);


 if (isset($unread)) {
    $sqlUpdateReadMessage = mysqli_query($con,"UPDATE messages SET asread='1' WHERE room=$room AND receiver_id=$userid");
 }
$found=mysqli_num_rows($res);

    if ($found > 0){
    	while($r = mysqli_fetch_row($res)) {
        	$idmessage        = $r[0];
          $sender        = $r[1];
          $room             = $r[2];
      		$message       = $r[3];
          $create_at   = $r[4];


      		$data[] = array('idmessage' =>$idmessage ,'sender' =>$sender ,'room' =>$room  , 'message'=>$message,'created_at'=>$create_at);


    	}



    }
    else{

		$data[] = array('idmessage' =>"" ,'sender' =>"" ,'room' =>""  , 'message'=>"",'created_at'=>"");

	}
echo json_encode($data);

?>
