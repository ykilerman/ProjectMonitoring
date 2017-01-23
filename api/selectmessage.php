<?php
error_reporting(0);

$user = $_POST['login'];


//Importing database
$data = array();
require_once('connection.php');


$sql = "SELECT id,sender_id,receiver_id,room,subject,message,
        created_at,updated_at FROM messages
        WHERE ( sender_id =$user OR receiver_id=$user)
        GROUP BY room ORDER BY updated_at DESC";
$res = mysqli_query($con,$sql);

$num =0;

$found=mysqli_num_rows($res);

    if ($found > 0){
      while($r = mysqli_fetch_row($res)) {
        $num++;
          $idmessage        = $r[0];
          $idSender        = $r[1];
          $room             = $r[3];
          $subject   = $r[4];
          $message       = $r[5];
          $create_at   = $r[6];
          $update_at   = $r[7];

          if ($idSender==$user) {
            $idSender = $r[2];
          }

          if ($room != "") {
            $SQLunread = mysqli_query($con,"SELECT COUNT(asread) FROM messages WHERE asread='0' AND room=$room AND receiver_id=$user");
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
