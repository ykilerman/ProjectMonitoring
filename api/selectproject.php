<?php

  include "connection.php";
  sleep(2);
  $position = $_POST['position'];
  $status = $_POST['status'];
  $uid = $_POST['uid'];
  $offset = $_POST['offset'] ;

  switch ($position) {
    case 'Project Coordinator':


      $offsetSepuluh = "SELECT id,created_at,icon_path,name,description,name,datediff(ADDDATE(last_notification,update_schedule),current_date()) as 'update' FROM projects where user_id='$uid' and status='$status' ORDER BY `update` ASC LIMIT $offset,10";


      break;

    default:

      $offsetSepuluh = "SELECT id,created_at,icon_path,name,description,name,datediff(ADDDATE(last_notification,update_schedule),current_date()) as 'update' FROM projects where status='$status' ORDER BY `update` ASC LIMIT $offset,10";



      break;
  }
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
          $tgl  = date("d M Y", strtotime($row['created_at']));
          $string = substr(strip_tags($row['description']), 0, 200);
          $update = $row['update'];
          $json .= '{
            "no": '.$num.',
            "id": "'.$row['id'].'",
            "judul": "'.$row['name'].'",
            "tgl": "'.$tgl.'",
            "isi": "'.$string." ...".'",
            "update": "'.$update.'",
            "gambar": "'.$row['icon_path'].'"},';
        }
      }



  $json = substr($json,0,strlen($json)-1);


  if($json_kosong==1){
    $json = '[{ "no": "", "id": "", "judul": "", "tgl": "","update": "", "isi": "", "gambar": ""}]';
  }else{
    $json .= ']';
  }
  echo $json;

  mysqli_close($con);

?>
