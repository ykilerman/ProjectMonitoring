<?php
error_reporting(0);

$user = $_POST['login'];


//Importing database
$data = array();
require_once('connection.php');


$sql = "SELECT messages.id,messages.user_id,messages.room,messages.subject,messages.message,
        messages.created_at,messages.updated_at,message_details.user_id FROM messages,message_details
        WHERE message_details.message_id=messages.id
        AND ( messages.user_id =$user OR message_details.user_id=$user)
        GROUP BY room ORDER BY messages.updated_at DESC";
$res = mysqli_query($con,$sql);

$num =0;

$found=mysqli_num_rows($res);

    if ($found > 0){
    	while($r = mysqli_fetch_row($res)) {
        $num++;
          $idmessage        = $r[0];
          $idSender        = $r[1];
          $room             = $r[2];
          $subject   = $r[3];
      		$message       = $r[4];
          $create_at   = $r[5];
          $update_at   = $r[6];

          if ($idSender==$user) {
            $idSender = $r[7];
          }

          if ($room != "") {
            $SQLunread = mysqli_query($con,"SELECT COUNT(asread) FROM message_details WHERE asread=0 AND room=$room AND user_id=$user");
            $unread =mysqli_fetch_row($SQLunread);
          }

      		$data[] = array('no' =>$num ,'idmessage' =>$idmessage ,'idsender' =>$idSender ,'room' =>$room ,'subject' =>$subject , 'message'=>$message,'update_at'=>$update_at,'unreadmessage'=>$unread[0]);


    	}




    }
    else{

		$data[] = array('no' =>"",'idmessage' =>"" ,'idsender' =>"",'room' =>"" ,'subject' =>"" , 'message'=>"" ,'update_at'=>"",'unreadmessage'=>"");

	}
echo json_encode($data);
mysql_close($con)

?>
