<?php
include("dbconfig.php");
$id = $_GET['id'];
$sql = "SELECT i_descrizione FROM `immagini` where `i_id` = '$id'";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);
echo htmlspecialchars_decode(base64_decode($data['i_descrizione']));
?>