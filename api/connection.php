<?php
define('HOST','localhost');// hostname komputer

define('USER','root');// username untuk akses web server

define('PASS','');//password untuk akses web server

define('DB','pmonitoring');// nama database

//konekin ke Database
$data = array();
$con = mysqli_connect(HOST,USER,PASS,DB) ;
if (!$con) {

$data[] = array('username' =>"" , 'name'=>"error_connection",'position'=>"");
echo json_encode($data);

}
 ?>
