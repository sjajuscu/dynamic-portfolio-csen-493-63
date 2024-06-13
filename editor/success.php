<?php
session_start();
include("dbconfig.php");
error_reporting(E_ALL & ~E_NOTICE & ~E_USER_NOTICE);
// include("./connectivity/config.php");
require('razorpay/Razorpay.php');

use Razorpay\Api\Api;

$keyId = "rzp_live_2QGsWYWIPKPmSY"; 
$keysecret = "h9ov2kcTnvAWOOpS31SJjshp";
$api = new Api($keyId,$keysecret);
$razorpay_order_id = $_SESSION['razorpay_order_id'];
$razorpay_payment_id = $_POST['razorpay_payment_id'];
// $link = $_SESSION['link'];
if($_POST['razorpay_payment_id']){
    $months = $_POST['months'];
    $card = $_SESSION['card'];
    $expiry = $_SESSION['expiry'];
    $str = " + ".$months." months";
    $enddate = date('Y-m-d',strtotime($str,strtotime($expiry)));
    $sql = "UPDATE `cards` SET `c_enddate` = '{$enddate}' where `link`='{$card}'";
    $link = $_SESSION['card'];
    if(mysqli_multi_query($conn, $sql)){
        include("success-content.php");
    }
    else{
        echo mysqli_error($conn);
    }
}
else{
    echo "Err : 404";
}

?>


<script>
    if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>
