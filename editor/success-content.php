<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta name="author" content="John Doe">
    <meta name="description" content="">
    <meta name="keywords" content="HTML,CSS,XML,JavaScript">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>myecompany - Payment Success</title>
    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="shortcut icon" type="image/ico" href="images/favicon.ico" />
    <!-- Plugin-CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/animate.css">
    <!-- Main-Stylesheets -->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>

    <!--[if lt IE 9]>
        <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]--> 
</head>

<style>
    .checkmark__circle {
  stroke-dasharray: 166;
  stroke-dashoffset: 166;
  stroke-width: 2;
  stroke-miterlimit: 10;
  stroke: #00bd56;
  fill: none;
  animation: stroke 0.9s cubic-bezier(0.65, 0, 0.45, 1) forwards;
  /* animation-iteration-count: 12; */
}

.checkmark {
  width: 156px;
  height: 156px;
  border-radius: 50%;
  display: block;
  stroke-width: 2;
  stroke: #00bd56;
  stroke-miterlimit: 10;
  margin: 5% auto 5% auto;
  box-shadow: inset 0px 0px 0px #7ac142;
  animation: fill .9s ease-in-out .9s forwards, scale .9s ease-in-out .9s both;
  animation-iteration-count: 120;
}

.checkmark__check {
  transform-origin: 50% 50%;
  stroke-dasharray: 48;
  stroke-dashoffset: 48;
  animation: stroke 1s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
  animation-iteration-count: 120;
}

@keyframes stroke {
  100% {
    stroke-dashoffset: 0;
  }
}
@keyframes scale {
  0%, 100% {
    transform: none;
  }
  50% {
    transform: scale3d(1.1, 1.1, 1);
  }
}
@keyframes fill {
  100% {
    box-shadow: inset 0px 0px 0px 30px #fff;
  }
}
</style>

<style>
    .all-course .nav-tabs .nav-item.show .nav-link,
    .all-course .nav-tabs .nav-link.active {
        background-color: #2d3092;
        color: white;
        padding: 12px;
    }

    .all-course .nav-tabs .nav-link {
        padding: 12px;
    }

    @media (max-width: 575px) {
        .cartbtn {
            right: 70px !important;
            width: 40px;
            height: 40px;
        }

    }

    .cartbtn {
        float: right;
        background-color: #2d3092;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        line-height: 60px;
        padding: 0px;
        text-align: center;
        color: white;
        overflow: inherit;
    }

    .cartbtn .badge {
        position: absolute;
        /* top: -5px;
  right: 10px; */
        /* padding: 5px 10px; */
        border-radius: 50%;
        width: 15px;
        font-size: 10px;
        height: 15px;
        text-align: center;
        background: red;
        color: white;
    }

    @media (max-width: 991px) {
        .header-area {
            padding: 20px;
        }

        .single-slider{
            padding: 26px 0px;
        }
    }
</style>

<body>


<!--<div style="padding:80px 0px">-->
<div class="categories-area section-padding30" style="padding:60px 100px!important;">
            <div class="container">
                <div class="row justify-content-sm-center">
                     <center>
                    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                        <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="white"/>
                        <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                    </svg>
                     <h1 class="mb-3" style="text-align: center;color:#00bd56">Payment Successful <h6> Valid Till : <?php echo date("d M, Y",strtotime($enddate)); ?>  |   Payment ID : <?= $_POST['razorpay_payment_id'] ?> </h6></h1>
                    <h1>Thank you for renewing your Digital vCard</h1>
                    <h2 style="margin-top: 10px;">Your Card : <a href="https://myecompany.co.in/<?= $link ?>" target="_blank">https://myecompany.co.in/<?= $link ?></a></h2>
                    <hr>
                <a href="./../editor" class="btn mt-4" style="background-color:#00bd56!important;color:white"> Edit your Card</a>
                </center>
             </div>
            </div>
        </div>
</body>