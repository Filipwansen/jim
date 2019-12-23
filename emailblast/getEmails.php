<?php

include("../config.php");

$mysqli = new mysqli($host,$user,$pass,$db);

if(isset($_GET['term']) && !empty($_GET['term']))
{
$sql = "SELECT id,name FROM users WHERE name like '%".$_GET['term']."%'"; 
$result = $mysqli->query($sql);
}
else
{
$sql = "SELECT id,name FROM users"; 
$result = $mysqli->query($sql);	
}



$json = [];
while($row = $result->fetch_assoc()){
     $json[] = ['id'=>$row['name'], 'text'=>$row['name']];
}


echo json_encode($json);


 ?>