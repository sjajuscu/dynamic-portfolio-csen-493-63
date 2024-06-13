<?php 
include("dbconfig.php");
 $myObj = new \stdClass();
$id = $_GET['id'];
$sql = "SELECT * FROM `immagini` where `i_id`='{$id}'";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);
$myObj->title = $data['i_nome'];
$myObj->cost = $data['i_url'];
$file = explode("/", $data['i_allegato']);
$myObj->files = $file[3];
$myJSON = json_encode($myObj);
echo $myJSON;
// echo "<script>$('#title').val('".$data['i_nome']."')</script>";
?>