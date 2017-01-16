<?php

  include "connection.php";
  sleep(2);
  $offset = $_POST['offset'] ;

  $offsetSepuluh = "SELECT * FROM projects ORDER BY id DESC LIMIT $offset,10";

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
          $json .= '{
            "no": '.$num.',
            "id": "'.$row['id'].'",
            "judul": "'.$row['name'].'",
            "tgl": "'.$tgl.'",
            "isi": "'.$string." ...".'",
            "gambar": "'.$row['icon_path'].'"},';
        }
      }



  $json = substr($json,0,strlen($json)-1);


  if($json_kosong==1){
    $json = '[{ "no": "", "id": "", "judul": "", "tgl": "", "isi": "", "gambar": ""}]';
  }else{
    $json .= ']';
  }
  echo $json;

  mysqli_close($con);

?>
