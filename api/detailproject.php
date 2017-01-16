<?php
// error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

require_once('connection.php');
	error_reporting(0);
	$id = $_POST['id'];

//Importing database
$data = array();


$sql = "SELECT projects.id, projects.name, projects.client_name, projects.type, users.name as coordinator, users.id as idcoor,projects.update_schedule, projects.value, projects.created_at, description, percent,icon_path FROM projects,users WHERE projects.user_id = users.id and projects.id=$id";
$res = mysqli_query($con,$sql);

$found=mysqli_num_rows($res);

    // Apabila username dan password ditemukan
    if ($found > 0){
    	while($row = mysqli_fetch_row($res)) {
    			$id= $row[0];
				$judul = $row[1] ;
				$client = $row[2] ;
				$type = $row[3] ;
				$coordinator = $row[4] ;
				$idcoor = $row[5] ;
				$schedule = $row[6] ;
				$cost = $row[7] ;
    			$tgl	= date("d M Y", strtotime($row[8]));
				$isi = $row[9] ;
				$complate = $row[10] ;
				$gambar = $row[11];
      		$data[] = array('id' =>$id ,'judul' =>$judul ,'tgl' =>$tgl , 'client'=>$client,'type'=>$type,'coordinator'=>$coordinator,'idcoor'=>$idcoor,'schedule'=>$schedule,'cost'=>$cost,'isi'=>$isi,'complate'=>$complate,'gambar'=>$gambar);

    	}

        echo json_encode($data);


    }
    else{

		$data[] = array('id' =>"" ,'judul' =>"" ,'tgl' =>"" , 'client'=>"",'type'=>"",'coordinator'=>"",'idcoor'=>"",'schedule'=>"",'cost'=>"",'isi'=>"",'complate'=>"",'gambar'=>"");
		echo json_encode($data);
	}

?>
