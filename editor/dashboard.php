<?php
include("header.php");
$card = $_SESSION['card'];
// include("dbconfig.php");
$sql = "SELECT * FROM `cards` where `link`='{$card}'";
// $sql = "SELECT * FROM `links`,`cards` where `l_nome`='{$card}' and link='{$card}'";
// echo $sql;
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);
// echo json_encode($data);
$contact = $data['l_contact'];
$email = $data['l_email'];
$fb = $data['l_fb'];
$insta = $data['l_insta'];
$linkedin = $data['l_linked'];
$twitter = $data['l_twitter'];
$gpay = $data['l_gpay'];
$phonepe = $data['l_phonepe'];
$paytm = $data['l_paytm'];
$bhim = $data['l_bhim'];
$bankname = $data['l_bank'];
$accountnumber = $data['l_accno'];
$ifsc = $data['l_ifsc'];
$gst = $data['l_gst'];
$cin = $data['l_cin'];
$pan = $data['l_pan'];
$name = $data['u_name'];
$company = $data['c_company'];
$url = $data['c_web'];
$maps = $data['c_maps'];
$work = $data['c_hours'];
$logo = $data['c_logo'];
$logo = explode("/", $logo);
$logo = $logo[3];
$_SESSION['expiry'] = $data['c_enddate'];
if ($logo == "") {
  $logo = "Choose File";
}
$theme = $data['theme'];

if (isset($_POST['general'])) {
  // echo json_encode($_POST);
  $contact = $_POST['contact'];
  $email = $_POST['email'];
  $fb = $_POST['fb'];
  $insta = $_POST['insta'];
  $linkedin = $_POST['linkedin'];
  $twitter = $_POST['twitter'];
  $gpay = $_POST['gpay'];
  $phonepe = $_POST['phonepe'];
  $paytm = $_POST['paytm'];
  $bhim = $_POST['bhim'];
  $bank = $_POST['bankname'];
  $bankno = $_POST['accountnumber'];
  $ifsc = $_POST['ifsc'];
  $gst = $_POST['gst'];
  $cin = $_POST['cin'];
  $pan = $_POST['pan'];
  $sql = "UPDATE `links` SET `l_contact`='{$contact}',`l_email`='{$email}',`l_fb`='{$fb}',`l_insta`='{$insta}',`l_linked`='{$linkedin}',`l_twitter`= '{$twitter}',`l_gpay`= '{$gpay}',`l_phonepe`= '{$phonepe}',`l_paytm`= '{$paytm}',`l_bhim`= '{$bhim}',l_bank='{$bank}',l_accno='{$bankno}',l_ifsc='{$ifsc}',l_gst='{$gst}',l_cin='{$cin}',l_pan='{$pan}'  WHERE `l_nome`='{$card}'";
//   $sql = "UPDATE `links` SET `l_contact`='{$contact}',`l_email`='{$email}',`l_fb`='{$fb}',`l_insta`='{$insta}',`l_linked`='{$linkedin}',`l_twitter`= '{$twitter}',`l_gpay`= '{$gpay}',`l_phonepe`= '{$phonepe}',`l_paytm`= '{$paytm}',`l_bhim`= '{$bhim}' WHERE `l_nome`='{$card}'";
  if (mysqli_query($conn, $sql)) {
  }
}

if(isset($_POST['theme'])){
//   echo json_encode($_POST);
  $theme = $_POST['imagecheck'];
  $sql = "UPDATE `cards` SET `theme`='{$theme}' where `link`='{$card}'";
  if (mysqli_query($conn, $sql)) {
  }
}

if (isset($_POST['basic'])) {
  $name = $_POST['name'];
  $company = $_POST['company'];
  
    if (basename($_FILES['attachment']['name']) != '') {
    $attachment = $_FILES['attachment']['name'];
    $db = "assets/attachments/{$card}/";
    $target_dir = "./../assets/attachments/{$card}/";
    $dbpath = $db . basename($_FILES["attachment"]["name"]);
    $target_file = $target_dir . basename($_FILES["attachment"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  }
  
//   $attachment = $_FILES['attachment']['name'];
//   $db = "assets/attachments/{$card}/";
//   $target_dir = "./../assets/attachments/{$card}/";
//   $dbpath = $db . basename($_FILES["attachment"]["name"]);
//   $target_file = $target_dir . basename($_FILES["attachment"]["name"]);
//   $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $url = $_POST['url'];
    $maps = $_POST['maps'];
    $work = $_POST['time'];

    if (basename($_FILES['attachment']['name']) != '') {
        move_uploaded_file($_FILES['attachment']['tmp_name'], $target_dir . $attachment);
         $sql = "UPDATE `cards` SET `u_name`='{$name}',`c_company`='{$company}',`c_logo`='{$dbpath}',`c_web`='{$url}',`c_maps`='{$maps}',`c_hours`='{$work}' WHERE `link`='{$card}'";
    }
    else{
        $sql = "UPDATE `cards` SET `u_name`='{$name}',`c_company`='{$company}', `c_web`='{$url}',`c_maps`='{$maps}',`c_hours`='{$work}' WHERE `link`='{$card}'";
    }

//   echo $sql;
  if (mysqli_query($conn, $sql)) {
  }
}

?>

<style>
.social-grid {
  display: grid;
  grid-template-columns: 0.2fr 1fr;
  grid-template-rows: 1fr;
  gap: 0px 0px;
  grid-auto-flow: row;
  align-items:center;
  padding:8px 20px;
  grid-template-areas:
    ". .";
}

@media (max-width: 990px) {
    .social-grid {
      display: grid;
      grid-template-columns: 0.25fr 1fr;
      grid-template-rows: 1fr;
      gap: 0px 0px;
      grid-auto-flow: row;
      align-items:center;
      padding:8px 20px;
      grid-template-areas:
        ". .";
    }
}

</style>

<style>
        .razorpay-payment-button {
            background-color: yellowgreen;
            border: 1px solid #00bd56 !important;
            color: #ffffff !important;
            cursor: pointer;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            -ms-border-radius: 3px;
            padding: 10px 30px;
            border-radius: 3px;
            /* margin: 20px 0px; */
            -webkit-box-shadow: 0px 24px 36px -11px rgba(0, 0, 0, 0.09);
            -moz-box-shadow: 0px 24px 36px -11px rgba(0, 0, 0, 0.09);
            box-shadow: 0px 24px 36px -11px rgba(0, 0, 0, 0.09);
            display: inline-block;
            font-weight: 400;
            text-align: center;
            vertical-align: middle;
            user-select: none;
            width: 100% !important;
            /* padding: 0.375rem 0.75rem; */
            font-size: 1.2rem;
            line-height: 1.5;
            -webkit-transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            -o-transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
        }

    </style>
<body>

<?php
// $sqlcount1 = "SELECT * FROM `views` where `link`='{$card}'";
// $resultcount1 = mysqli_query($conn, $sqlcount1);
// $datacount1 = mysqli_fetch_assoc($resultcount1);
$sqlcount2 = "SELECT COUNT(*) from `immagini` where `i_sezione`='products' and `i_persona`='{$card}' and `i_schermo` ='true';";
$resultcount2 = mysqli_query($conn, $sqlcount2);
$datacount2 = mysqli_fetch_assoc($resultcount2);
$sqlcount3 = "SELECT COUNT(*) from `immagini` where `i_sezione`='testimonial' and `i_persona`='{$card}' and `i_schermo` ='true';";
$resultcount3 = mysqli_query($conn, $sqlcount3);
$datacount3 = mysqli_fetch_assoc($resultcount3);
?>
  <div class="main-content">
    <section class="section">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
          <div class="card card-statistic-2">
            <div class="card-icon shadow-primary bg-primary">
              <i class="fas fa-eye"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Views</h4>
              </div>
              <div class="card-body">
                3
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
          <div class="card card-statistic-2">
            <div class="card-icon shadow-primary bg-primary">
              <i class="fas fa-shopping-bag"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Products</h4>
              </div>
              <div class="card-body">
                <?= $datacount2['COUNT(*)'] ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
          <div class="card card-statistic-2">
            <div class="card-icon shadow-primary bg-primary">
              <i class="fas fa-users"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Testimonials</h4>
              </div>
              <div class="card-body">
                <?= $datacount3['COUNT(*)'] ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <?php 
$str = " + 8 days";
// $validity = date('Y-m-d',strtotime(date("Y-m-d", mktime()) . $str));
// echo $validity;
// echo $validity.$_SESSION['expiry'];
if($validity <= $_SESSION['expiry']){

}
else{
    ?>
    
    <div class="row">
            <div class="col-md-12">
                 <div class="alert alert-danger" role="alert" style="background-color:#fc544bc7;border:1px solid #fc544b">
                     <div class="row">
                         <div class="col-lg-8 col-sm-6 col-12">
                                <p style="font-size:1rem">Your Card is will expire on <?php echo date("d M, Y",strtotime($_SESSION['expiry'])); ?>. Renew the Digital Card to enjoy our service!</p>
                         </div>
                         <div class="col-lg-2 col-md-3 col-12 mt-2">
                            <form action="./success.php" method="POST" style="float:right;width:100%">
                                <input type="hidden" name="months" value="12">
                            <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="rzp_live_2QGsWYWIPKPmSY" // Enter the Test API Key ID generated from Dashboard → Settings → API Keys 
                            data-amount="49900" // Amount is in currency subunits. Hence, 29935 refers to 29935 paise or ₹299.35. data-currency="INR" // You can accept international payments by changing the currency code. Contact our Support Team to enable International for your account data-buttontext="Buy 1 Year" data-name="myecompany" data-description="Digital vCard - 1 Year" data-image="https://myecompany.co.in/index/images/logo.png" data-theme.color="#6777ef"></script>
                            <input type="hidden" custom="Hidden Element" name="hidden">
                            </form>
                         </div>
                         
                         <div class="col-lg-2 col-md-3 col-12 mt-2">
                            <form action="./success.php" method="POST" style="float:right;width:100%">
                                <input type="hidden" name="months" value="36">
                            <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="rzp_live_2QGsWYWIPKPmSY" // Enter the Test API Key ID generated from Dashboard → Settings → API Keys 
                            data-amount="125000" // Amount is in currency subunits. Hence, 29935 refers to 29935 paise or ₹299.35. data-currency="INR" // You can accept international payments by changing the currency code. Contact our Support Team to enable International for your account data-buttontext="Buy 3 Years" data-name="myecompany" data-description="Digital vCard - 3 Year" data-image="https://myecompany.co.in/index/images/logo.png" data-theme.color="#6777ef"></script>
                            <input type="hidden" custom="Hidden Element" name="hidden">
                            </form>
                         </div>
                     </div>
                
                </div>
            </div>
        </div>
    
    <?php
}

?>


      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header" style="width:100%">
              <h4>General</h4>
              <!--<span>Expiry</span>-->
              <div class="alert alert-success" style="text-align:center;float:right;width:fit-content;margin-left:auto"> Valid Till : <?= date("d M, Y",strtotime($data['c_enddate'])) ?></div>
            </div>
            <div class="card-body p-0">

              <div class="row">
                
                <div class="col-md-6 col-12" style="padding:16px">

                  <form method="POST" enctype="multipart/form-data">
                    <div class="col-12 mt-3">
                      <label>Name</label>
                      <input type="text" class="form-control" value="<?= $name ?>" name="name" placeholder="Enter Name">
                    </div>
                    <div class="col-12 mt-3">
                      <label>Company Name / Designation</label>
                      <input type="text" class="form-control" value="<?= $company ?>" name="company" placeholder="Enter Company Name / Designation">
                    </div>
                    <div class="col-12 mt-3">
                      <label>Website URL</label>
                      <input type="text" class="form-control" value="<?= $url ?>" name="url" placeholder="Enter URL">
                    </div>
                    <div class="col-12 mt-3">
                      <label>Address</label>
                      <input type="text" class="form-control" value="<?= $maps ?>" name="maps" placeholder="Enter Address">
                    </div>
                    <div class="col-12 mt-3">
                      <label>Working Hours</label>
                      <input type="text" class="form-control" value="<?= $work ?>" name="time" placeholder="Enter Working Hours">
                    </div>
                    <div class="col-12 mt-3">
                      <label>Company Logo / Person Image</label>
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="attachment" id="customFile">
                        <label class="custom-file-label" id="label" for="customFile"><?= $logo ?></label>
                      </div>
                    </div>
                    <div class="col-12 mt-3">
                      <input type="submit" class="btn btn-success" value="Save Details" style="width: 100%;" name="basic">
                    </div>
                  </form>
                </div>
<div class="col-md-6 col-12" style="padding:16px">
                  <form method="POST">
                    <div class="form-group" style="padding:16px">
                      <label class="form-label">Theme</label>
                      <div class="row gutters-sm">
                        <div class="col-6 col-sm-4">
                          <label class="imagecheck mb-4">
                            <input name="imagecheck" type="radio" value="1" class="imagecheck-input" <?php if($theme=="1") echo "checked" ?>/>
                            <figure class="imagecheck-figure">
                              <img src="./assets/themes/dark1.png" alt="}" class="imagecheck-image">
                            </figure>
                          </label>
                        </div>
                        <div class="col-6 col-sm-4">
                          <label class="imagecheck mb-4">
                            <input name="imagecheck" type="radio" value="2" class="imagecheck-input" <?php if($theme=="2") echo "checked" ?>/>
                            <figure class="imagecheck-figure">
                              <img src="./assets/themes/light2.png" alt="}" class="imagecheck-image">
                            </figure>
                          </label>
                        </div>
                        <div class="col-6 col-sm-4">
                          <label class="imagecheck mb-4">
                            <input name="imagecheck" type="radio" value="3" class="imagecheck-input" <?php if($theme=="3") echo "checked" ?>/>
                            <figure class="imagecheck-figure">
                              <img src="./assets/themes/full.png" alt="}" class="imagecheck-image">
                            </figure>
                          </label>
                        </div>
                        <div class="col-6 col-sm-4">
                          <label class="imagecheck mb-4">
                            <input name="imagecheck" type="radio" value="4" class="imagecheck-input" <?php if($theme=="4") echo "checked" ?> />
                            <figure class="imagecheck-figure">
                              <img src="./assets/themes/light1.png" alt="}" class="imagecheck-image">
                            </figure>
                          </label>
                        </div>
                        <div class="col-6 col-sm-4">
                          <label class="imagecheck mb-4">
                            <input name="imagecheck" type="radio" value="5" class="imagecheck-input" <?php if($theme=="5") echo "checked" ?> />
                            <figure class="imagecheck-figure">
                              <img src="./assets/themes/dark2.png" alt="}" class="imagecheck-image">
                            </figure>
                          </label>
                        </div>
                        <div class="col-6 col-sm-4">
                          <label class="imagecheck mb-4">
                            <input name="imagecheck" type="radio" value="6" class="imagecheck-input" <?php if($theme=="6") echo "checked" ?>/>
                            <figure class="imagecheck-figure">
                              <img src="./assets/themes/light3.png" alt="}" class="imagecheck-image">
                            </figure>
                          </label>
                        </div>
                        <div class="col-6 col-sm-4">
                          <label class="imagecheck mb-4">
                            <input name="imagecheck" type="radio" value="7" class="imagecheck-input" <?php if($theme=="7") echo "checked" ?>/>
                            <figure class="imagecheck-figure">
                              <img src="./assets/themes/d3.png" alt="}" class="imagecheck-image">
                            </figure>
                          </label>
                        </div>
                        <div class="col-6 col-sm-4">
                          <label class="imagecheck mb-4">
                            <input name="imagecheck" type="radio" value="8" class="imagecheck-input" <?php if($theme=="8") echo "checked" ?>/>
                            <figure class="imagecheck-figure">
                              <img src="./assets/themes/light4.png" alt="}" class="imagecheck-image">
                            </figure>
                          </label>
                        </div>
                        <div class="col-6 col-sm-4">
                          <label class="imagecheck mb-4">
                            <input name="imagecheck" type="radio" value="9" class="imagecheck-input" <?php if($theme=="9") echo "checked" ?>/>
                            <figure class="imagecheck-figure">
                              <img src="./assets/themes/dark4.png" alt="}" class="imagecheck-image">
                            </figure>
                          </label>
                        </div>
                        <div class="col-6 col-sm-4">
                          <label class="imagecheck mb-4">
                            <input name="imagecheck" type="radio" value="10" class="imagecheck-input" <?php if($theme=="10") echo "checked" ?>/>
                            <figure class="imagecheck-figure">
                              <img src="./assets/themes/light5.png" alt="}" class="imagecheck-image">
                            </figure>
                          </label>
                        </div>
                        <div class="col-6 col-sm-4">
                          <label class="imagecheck mb-4">
                            <input name="imagecheck" type="radio" value="11" class="imagecheck-input" <?php if($theme=="11") echo "checked" ?>/>
                            <figure class="imagecheck-figure">
                              <img src="./assets/themes/dark5.png" alt="}" class="imagecheck-image">
                            </figure>
                          </label>
                        </div>
                        <div class="col-6 col-sm-4">
                          <label class="imagecheck mb-4">
                            <input name="imagecheck" type="radio" value="12" class="imagecheck-input" <?php if($theme=="12") echo "checked" ?>/>
                            <figure class="imagecheck-figure">
                              <img src="./assets/themes/light6.png" alt="}" class="imagecheck-image">
                            </figure>
                          </label>
                        </div>
                      </div>
                      <div class="col-12 mt-3">
                        <input type="submit" class="btn btn-success" name="theme" style="width: 100%;" value="Update Theme">
                      </div>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- <div class="col-md-4">
              <div class="card card-hero">
                <div class="card-header">
                  <div class="card-icon">
                    <i class="far fa-question-circle"></i>
                  </div>
                  <h4>14</h4>
                  <div class="card-description">Customers need help</div>
                </div>
                <div class="card-body p-0">
                  <div class="tickets-list">
                    <a href="#" class="ticket-item">
                      <div class="ticket-title">
                        <h4>My battery isnt working</h4>
                      </div>
                      <div class="ticket-info">
                        <div>Laila Tazkiah</div>
                        <div class="bullet"></div>
                        <div class="text-primary">1 min ago</div>
                      </div>
                    </a>
                    <a href="#" class="ticket-item">
                      <div class="ticket-title">
                        <h4>Please cancel my order</h4>
                      </div>
                      <div class="ticket-info">
                        <div>Rizal Fakhri</div>
                        <div class="bullet"></div>
                        <div>2 hours ago</div>
                      </div>
                    </a>
                    <a href="#" class="ticket-item">
                      <div class="ticket-title">
                        <h4>Physical Damage</h4>
                      </div>
                      <div class="ticket-info">
                        <div>Syahdan Ubaidillah</div>
                        <div class="bullet"></div>
                        <div>6 hours ago</div>
                      </div>
                    </a>
                    <a href="features-tickets.html" class="ticket-item ticket-more">
                      View All <i class="fas fa-chevron-right"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div> -->
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="assets/js/stisla.js"></script>

  <!-- JS Libraies -->
  <script src="node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
  <script src="node_modules/chart.js/dist/Chart.min.js"></script>
  <script src="node_modules/owl.carousel/dist/owl.carousel.min.js"></script>
  <script src="node_modules/summernote/dist/summernote-bs4.js"></script>
  <script src="node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>

  <!-- Page Specific JS File -->
  <script src="assets/js/page/index.js"></script>

  <script type="text/javascript">
    $('#customFile').on('change', function() {
      file = $('#customFile').val().replace(/C:\\fakepath\\/i, '')
      $('#label').html(file)
    });
  </script>
</body>

</html>