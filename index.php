<?php
session_start();
include("dbconfig.php");
      
$request = $_SERVER['REQUEST_URI'];
// echo $card = str_replace('/','',$request);
$card = trim(str_replace('/','',$request)) ;

$parts = explode("/", $request);
$card = end($parts);
// echo $card;
if($card != ""){
    // $card = $_GET['name'];
    $sql2 = "UPDATE views SET v_count = v_count + 1 WHERE v_link='{$card}'";
    if($result2 = mysqli_query($conn, $sql2)){
    }
    $sql = "SELECT * FROM `cards`,`about` where `link`='$card' and `a_nome`='{$card}'";
   // echo $sql;
    $result = mysqli_query($conn, $sql);
    //echo $result;exit;
    $data = mysqli_fetch_assoc($result);
    $theme = $data['theme'];
        if($data['c_status'] == 'true'){
            if($data['c_enddate'] < date("Y-m-d")){
            include("404.php");
            }
            else{
                include("card.php");
            }
        }
        else{
            include("404.php");
        }
    
    // echo json_encode($data);
}
else{
    header("location: /index");
}

include("contactmail.php");


function raf_create_vcard(){
    $sql = "SELECT * FROM `cards`,`about` where `link`='{$card}' and `link`=`a_nome`";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);
    $format_name = utf8_encode($data['u_name']);
    $format_email = utf8_encode($data['a_email']);
    $format_tel = utf8_encode($data['a_contact']);
    $format_fax = utf8_encode($data['a_contact']);
    $format_www = utf8_encode($data['c_web']);
    $format_address = utf8_encode($data['a_address']);
    return 'BEGIN%3AVCARD%0D%0AVERSION%3A4.0%0D%0AN%3A%3B'.$format_name.'%3B%3B%3B%0D%0AFN%3A'.$format_name.'%0D%0AEMAIL%3A'.$format_email.'%0D%0AORG%3A'.$format_name.'%0D%0ATEL%3A'.$format_tel.'%0D%0ATEL%3Btype%3DFAX%3A'.$format_fax.'%0D%0AURL%3Btype%3Dpref%3A'.$format_www.'%0D%0AADR%3A%3B'.$format_address.'%3B%3B%3B%3B%3BSpain%0D%0AEND%3AVCARD';   
}
?>
