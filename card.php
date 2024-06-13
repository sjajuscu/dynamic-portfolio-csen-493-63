<?php
$sql3 = "SELECT * FROM `cards`,`about` where `link`='{$card}' and `a_nome`='{$card}'";
// echo $sql3;
$result3 = mysqli_query($conn, $sql3);
//echo $theme ;exit;
$data3 = mysqli_fetch_assoc($result3);
// print_r($data3); exit;

$parts = explode("/", $request);
$card = end($parts);
// echo $card;
?>
<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $data['u_name'] . " - " . $data['c_company']  ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <meta name="description" content="myecompany" />
  <meta name="keywords" content="<?= $data['u_name'] ?>,<?= $data['c_company'] ?>,<?= $data3['l_email'] ?>,<?= $data3['l_contact'] ?>,vcard, resposnive, retina, resume, jquery, css3, bootstrap, Material CV, portfolio" />
  <meta name="author" content="lmpixels" />
  <link rel="shortcut icon" href="img/logo.png">
  <link rel="stylesheet" href="css/reset.css" type="text/css">
  <link rel="stylesheet" href="css/bootstrap-grid.min.css" type="text/css">
  <link rel="stylesheet" href="css/animations.css" type="text/css">
  <link rel="stylesheet" href="css/perfect-scrollbar.css" type="text/css">
  <link rel="stylesheet" href="css/owl.carousel.css" type="text/css">
  <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
  <link rel="stylesheet" href="css/css/<?= $theme ?>/main.css" type="text/css">
  <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.2.0-beta.2/css/lightgallery.min.css">
  <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.2.0-beta.2/css/lg-share.min.css">


  <style>
    ::-webkit-scrollbar {
      display: none;
    }


    @media (max-width: 430px) {
      .mobile {
        display: block !important;
      }
    }

    .mobile {
      display: none;
    }

    .btnwhatsapp:hover {
      background-color: #0ba376 !important;
    }
  </style>
</head>

<body>
  <!-- Animated Background -->
  <div class="lm-animated-bg" style="background-image: url(img/main_bg.png);"></div>
  <!-- /Animated Background -->

  <!-- Loading animation -->
  <div class="preloader">
    <div class="preloader-animation">
      <div class="preloader-spinner">
      </div>
    </div>
  </div>
  <!-- /Loading animation -->

  <div class="page">
    <div class="page-content">
      <header id="site_header" class="header mobile-menu-hide">
        <div class="header-content">
          <div class="header-photo">
            <?php
            if ($data['c_logo'] != "assets/attachments/{$card}/")
              echo "<img alt='/' src='" . $data['c_logo'] . "'>";
            else
              echo "<img src='img/main_photo.jpg' alt='Alex Smith'>";
            ?>
          </div>
          <div class="header-titles">
            <h2><?= $data['u_name'] ?></h2>
            <h4><?= $data['c_company'] ?></h4>
          </div>
        </div>

        <ul class="main-menu">
          <li class="active">
            <a href="#home" class="nav-anim">
              <span class="menu-icon lnr lnr-home"></span>
              <span class="link-text">Home</span>
            </a>
          </li>
          <li>
            <a href="#about-me" class="nav-anim">
              <span class="menu-icon lnr lnr-user"></span>
              <span class="link-text">About Us</span>
            </a>
          </li>
          <li>
            <a href="#products" class="nav-anim">
              <span class="menu-icon lnr lnr-briefcase"></span>
              <span class="link-text">Products</span>
            </a>
          </li>
          <li>
            <a href="#pricing" class="nav-anim">
              <span class="menu-icon fa fa-dollar-sign"></span>
              <span class="link-text">Pricing</span>
            </a>
          </li>
          <li>
            <a href='#testimonials' class='nav-anim'>
              <span class='menu-icon fas fa-comment'></span>
              <span class='link-text'>Testimonials</span>
            </a>
          </li>

          <!-- <li>
            <a href="#payments" class="nav-anim">
              <span class="menu-icon fa fa-credit-card" style="font-size:2rem"></span>
              <span class="link-text">Payments</span>
            </a>
          </li> -->

          <li>
            <a href="#contact" class="nav-anim">
              <span class="menu-icon lnr lnr-envelope"></span>
              <span class="link-text">Contact</span>
            </a>
          </li>
        </ul>

        <div class="social-links">
          <ul>
            <?php
            if ($data3['l_fb'] != "") {
              echo "<li><a href='" . $data3['l_fb'] . "' target='_blank'><i class='fab fa-facebook-f'></i></a></li>";
            }
            if ($data3['l_contact'] != "") {
              echo "<li><a href='tel:" . $data3['l_contact'] . "' target='_blank'><i class='fas fa-phone'></i></a></li>";
              echo "<li><a href='whatsapp://send?phone=" . $data3['l_contact'] . "&text=Hello " . $data['u_name'] . ", got your contact from myecompany' target='_blank'><i class='fab fa-whatsapp'></i></a></li>";
            }
            if ($data3['l_email'] != "") {
              echo "<li><a href=mailto:" . $data3['l_email'] . " target='_blank'><i class='fas fa-envelope'></i></a></li>";
            }
            if ($data3['l_linked'] != "") {
              echo "<li><a href='" . $data3['l_linked'] . "' target='_blank'><i class='fab fa-linkedin-in'></i></a></li>            ";
            }
            if ($data3['l_twitter'] != "") {
              echo "<li><a href='" . $data3['l_twitter'] . "' target='_blank'><i class='fab fa-twitter'></i></a></li>";
            }
            if ($data3['l_insta'] != "") {
              echo "<li><a href='" . $data3['l_insta'] . "' target='_blank'><i class='fab fa-instagram'></i></a></li>";
              // echo "<li><a href='".$data3['l_insta']."' target='_blank'><i class='fas fa-globe'></i></a></li>";
            }
            if ($data['c_web'] != "") {
              echo "<li><a href='" . $data['c_web'] . "' target='_blank'><i class='fas fa-globe'></i></a></li>";
            }

            ?>


          </ul>
        </div>
        <i class="fas fa-tick"></i>

        <div class="header-buttons" style="margin-top:0px!important">
          <div class="row">
            <!-- <div class="col-sm-12">

              <a href="./vcard.php?id=<?= $card ?>" target="_blank" class="btn btn-primary">Add to Contact</a>
            </div> -->
            <div class="col-sm-12">
              <a href="whatsapp://send?text=https://myecompany.co.in/<?= $card ?>" class="btn btn-primary">Share Card</a>
            </div>
          </div>
        </div>

        <!-- <div class="copyrights">© 2023 All rights reserved <a href="https://myecompany.co.in/" target="_blank" style="color:white"></a></div> -->
      </header>

      <!-- Mobile Navigation -->
      <div class="menu-toggle">
        <span></span>
        <span></span>
        <span></span>
      </div>
      <!-- End Mobile Navigation -->

      <!-- Arrows Nav -->
      <div class="lmpixels-arrows-nav">
        <div class="lmpixels-arrow-right"><i class="lnr lnr-chevron-right"></i></div>
        <div class="lmpixels-arrow-left"><i class="lnr lnr-chevron-left"></i></div>
      </div>
      <!-- End Arrows Nav -->

      <div class="content-area">
        <div class="animated-sections">
          <!-- Home Subpage -->
          <section data-id="home" class="animated-section start-page">
            <div class="section-content vcentered">
              <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                  <div class="header-photo mobile">
                    <?php
                    if (!empty($data['c_logo']) && $data['c_logo'] != "assets/attachments/{$card}/") {
                      echo "<img alt='/' loading='lazy' src='" . htmlspecialchars($data['c_logo'], ENT_QUOTES, 'UTF-8') . "'>";
                    } else {
                      echo "<img src='img/main_photo.jpg' alt='Alex Smith'>";
                    }
                    ?>
                  </div>
                  <div class="title-block">
                    <h2><?= htmlspecialchars($data['u_name'], ENT_QUOTES, 'UTF-8') ?></h2>
                    <div class="owl-carousel text-rotation">
                      <?php for ($i = 0; $i < 2; $i++) : ?>
                        <div class="item">
                          <div class="sp-subtitle"><?= htmlspecialchars($data['c_company'], ENT_QUOTES, 'UTF-8') ?></div>
                        </div>
                      <?php endfor; ?>
                    </div>
                    <!-- <div style="margin-top:30px!important"><label style="font-size:12px;">Share this Card on Whatsapp</label></div>
                    <div class="input-group mb-3" style="display:inline-flex;">
                      <input type="text" id="wpshare" class="form-control" placeholder="Whatsapp Number" aria-label="Recipient's username" style="display:inline;height:100%;border-radius:5px 0px 0px 5px!important;padding : 10px 19px 9px 12px!important;border : 2px solid #0ba376!important;border-right:0px!important" aria-describedby="basic-addon2">
                      <div class="input-group-append">
                        <a id='wpsharebtn' href='' onclick="clearwp()" target='_blank'><button class="btn btn-success btnwhatsapp" style="display:inline;border-radius:0px 5px 5px 0px!important;border : 2px solid #0ba376!important;"><i class='fab fa-whatsapp'></i></button></a>
                      </div>
                    </div>
                    <div><label style="font-size:10px">Enter Receiver's Whatsapp Number with Country Code</label></div>
                    <div class="mobile"><label style="font-size:14px"><strong>else</strong></label></div>
                    <a href="whatsapp://send?text=https://myecompany.co.in/<?= htmlspecialchars($card, ENT_QUOTES, 'UTF-8') ?>" class="btn btn-primary mobile" style="margin-top:10px">Share Card</a> -->
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!-- End of Home Subpage -->

          <!-- About Me Subpage -->
          <section data-id="about-me" class="animated-section">
            <div class="section-content">
              <div class="page-title">
                <h2>About <span>Us</span></h2>
              </div>

              <!-- Personal Information -->
              <div class="row">
                <div class="col-xs-12 col-sm-7">
                  <p><?= $data['a_about'] ?></p>
                </div>

                <div class="col-xs-12 col-sm-5">
                  <div class="info-list">
                    <ul>
                      <li>
                        <span class="title">Address</span>
                        <span class="value"><?= $data['a_address'] ?></span>
                      </li>

                      <li>
                        <span class="title">e-mail</span>
                        <span class="value"><?= $data['a_email'] ?></span>
                      </li>

                      <li>
                        <span class="title">Phone</span>
                        <span class="value"><?= $data['a_contact'] ?></span>
                      </li>
                      <?php
                      if ($data3['l_gst'] != "") {
                        echo "<li>
                                <span class='title'>GST No</span>
                                <span class='value'>" . $data3['l_gst'] . "</span>
                                </li>";
                      }
                      if ($data3['l_cin'] != "") {
                        echo "<li>
                                <span class='title'>CIN</span>
                                <span class='value'>" . $data3['l_cin'] . "</span>
                                </li>";
                      }
                      if ($data3['l_pan'] != "") {
                        echo "<li>
                                    <span class='title'>PAN</span>
                                    <span class='value'>" . $data3['l_pan'] . "</span>
                                    </li>";
                      }
                      ?>
                    </ul>
                  </div>
                </div>
              </div>
              <!-- End of Personal Information -->

              <div class="white-space-50"></div>

              <!-- Services -->
              <div class="row">
                <div class="col-xs-12 col-sm-12">
                  <div class="block-title">
                    <h3>What <span>we Do</span></h3>
                  </div>
                </div>
              </div>

              <div class="row">
                <?php
                $sql2 = "SELECT * FROM `immagini` where `i_persona`='{$card}' and `i_sezione`='wwd' and `i_schermo`='true'";
                // echo $sql2;
                $result2 = mysqli_query($conn, $sql2);
                while ($data2 = mysqli_fetch_assoc($result2)) {
                  echo "<div class='col-xs-12 col-sm-6'>
                  <div class='col-inner'>
                    <div class='info-list-w-icon'>
                      <div class='info-block-w-icon'>
                        <div class='ci-icon'>
                          <i class='" . $data2['i_url'] . "'></i>
                        </div>
                        <div class='ci-text'>
                          <h4>" . $data2['i_nome'] . "</h4>
                          <p>" . htmlspecialchars_decode(base64_decode($data2['i_descrizione'])) . "</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>";
                }
                if (mysqli_num_rows($result2) % 2 != 0) {
                  echo "<div class='col-xs-12 col-sm-6'>
                  <div class='col-inner'>
                    <div class='info-list-w-icon'>
                      <div class=''>
                        <div class='ci-icon'>
                          <i class=''></i>
                        </div>
                        <div class='ci-text'>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>";
                }
                // echo json_encode($data2);
                ?>
              </div>
              <!-- End of Services -->

              <div class="white-space-30"></div>

              <!-- <div class="white-space-50"></div> -->

              <!-- Clients -->

              <?php
              $sql2 = "SELECT * FROM `immagini` where `i_persona`='{$card}' and `i_sezione`='clients' and `i_schermo`='true'";
              // echo $sql2;
              $result2 = mysqli_query($conn, $sql2);
              $count = mysqli_num_rows($result2);
              // echo $count.$sql2;
              if ($count > 0) {
                echo "<div class='row'>
                                    <div class='col-xs-12 col-sm-12'>
                                      <div class='block-title'>
                                        <h3>Cilents</h3>
                                      </div>
                                    </div>
                                  </div>
                                   <div class='row'>
                                    <div class='col-xs-12 col-sm-12'>
                                      <div class='clients owl-carousel'>";
              }

              while ($data2 = mysqli_fetch_assoc($result2)) {
                echo "<div class='client-block'>
                                  <a href='" . $data2['i_url'] . "' target='_blank' title='" . $data2['i_nome'] . "'>
                                    <img src='" . $data2['i_allegato'] . "' style='border-radius:8px' alt='Logo'>
                                  </a>
                                </div>";
              }
              if ($count > 0) {
                echo "</div>
                                </div>
                              </div>";
              }

              ?>



              <!--<div class="client-block">-->
              <!--  <a href="#" target="_blank" title="Logo">-->
              <!--    <img src="img/clients/client-1.png" alt="Logo">-->
              <!--  </a>-->
              <!--</div>-->

              <!--<div class="client-block">-->
              <!--  <a href="#" target="_blank" title="Logo">-->
              <!--    <img src="img/clients/client-2.png" alt="Logo">-->
              <!--  </a>-->
              <!--</div>-->

              <!--<div class="client-block">-->
              <!--  <a href="#" target="_blank" title="Logo">-->
              <!--    <img src="img/clients/client-3.png" alt="Logo">-->
              <!--  </a>-->
              <!--</div>-->

              <!--<div class="client-block">-->
              <!--  <a href="#" target="_blank" title="Logo">-->
              <!--    <img src="img/clients/client-4.png" alt="Logo">-->
              <!--  </a>-->
              <!--</div>-->

              <!--<div class="client-block">-->
              <!--  <a href="#" target="_blank" title="Logo">-->
              <!--    <img src="img/clients/client-5.png" alt="Logo">-->
              <!--  </a>-->
              <!--</div>-->

              <!--<div class="client-block">-->
              <!--  <a href="#" target="_blank" title="Logo">-->
              <!--    <img src="img/clients/client-6.png" alt="Logo">-->
              <!--  </a>-->
              <!--</div>-->

              <!--<div class="client-block">-->
              <!--  <a href="#" target="_blank" title="Logo">-->
              <!--    <img src="img/clients/client-7.png" alt="Logo">-->
              <!--  </a>-->
              <!--</div>-->


              <!-- End of Clients -->

              <div class="white-space-50"></div>

              <!-- Fun Facts -->
              <!-- <div class="row">
                <div class="col-xs-12 col-sm-12">

                  <div class="block-title">
                    <h3>Fun <span>Facts</span></h3>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-xs-12 col-sm-4">
                  <div class="fun-fact gray-default">
                    <i class="lnr lnr-heart"></i>
                    <h4>Happy Clients</h4>
                    <span class="fun-fact-block-value">578</span>
                    <span class="fun-fact-block-text"></span>
                  </div>
                </div>

                <div class="col-xs-12 col-sm-4">
                  <div class="fun-fact gray-default">
                    <i class="lnr lnr-clock"></i>
                    <h4>Working Hours</h4>
                    <span class="fun-fact-block-value">4,780</span>
                    <span class="fun-fact-block-text"></span>
                  </div>
                </div>

                <div class="col-xs-12 col-sm-4 ">
                  <div class="fun-fact gray-default">
                    <i class="lnr lnr-star"></i>
                    <h4>Awards Won</h4>
                    <span class="fun-fact-block-value">15</span>
                    <span class="fun-fact-block-text"></span>
                  </div>
                </div>
              </div> -->
              <!-- End of Fun Facts -->

            </div>
          </section>
          <!-- End of About Me Subpage -->

          <!-- Resume Subpage -->
          <section data-id="testimonials" class="animated-section">
            <div class="section-content">
              <div class="page-title">
                <h2>Testimonials</h2>
              </div>

              <div class="row">
                <!--<div class="row">-->
                <?php
                
                $sql2 = "SELECT * FROM `immagini` where `i_persona`='{$card}' and `i_sezione`='testimonial' and `i_schermo`='true'";
                // echo $sql2;
                $result2 = mysqli_query($conn, $sql2);
                while ($data2 = mysqli_fetch_assoc($result2)) {
                  echo "<div class='col-xs-12 col-sm-6'>
                    <div class='testimonial'>
                      <div class='img'>
                        <img src='img/testimonials/testimonial-1.jpg' loading='lazy' alt=''>
                      </div>
                      <div class='text'>
                        <p>" . htmlspecialchars_decode(base64_decode($data2['i_descrizione'])) . "</p>
                      </div>

                      <div class='author-info'>
                        <h4 class='author'>" . $data2['i_nome'] . "</h4>
                        <div class='icon'>
                          <i class='fas fa-quote-right'></i>
                        </div>
                      </div>
                    </div>
                </div>";
                }
                ?>
                <!--</div>-->
                <!-- End of Testimonials -->
              </div>

              <div class="white-space-50"></div>

              <!-- Certificates -->

              <!-- End of Certificates -->
            </div>
          </section>
          <!-- End of Resume Subpage -->

          <!-- Portfolio Subpage -->
          <section data-id="products" class="animated-section">
            <div class="section-content">
              <div class="page-title">
                <h2>Products</h2>
              </div>

              <div class="row">
                <div class="col-xs-12 col-sm-12">
                  <!-- Portfolio Content -->
                  <div class="portfolio-content">
                    <!-- Portfolio Grid -->
                    <div class="portfolio-grid two-columns">

                      <?php $sql2 = "SELECT * FROM `immagini` where `i_persona`='{$card}' and `i_sezione`='products' and `i_schermo`='true'";
                      //   echo $sql2;
                      $result2 = mysqli_query($conn, $sql2);
                      while ($data2 = mysqli_fetch_assoc($result2)) {
                        $url = "https://" . $_SERVER['SERVER_NAME'] . "/" . $data['i_allegato'];
                        echo "<figure class='item standard'>
                        <div class='portfolio-item-img'>
                          <img src='" . $data2['i_allegato'] . "' alt='Media Project 2' title='' loading='lazy' />
                          <a href='#'></a>
                        </div>

                        <i class='far fa-file-alt'></i>
                        <h4 class='name'>" . $data2['i_nome'];
                        if ($data2['i_url'] != "") {
                          echo "- $" . $data2['i_url'] . "</h4>";
                        }
                        echo " </figure>";
                      }
                      ?>
                    </div>
                  </div>
                  <!-- End of Portfolio Content -->
                </div>
              </div>
            </div>
          </section>
          <!-- End of Portfolio Subpage -->

          <!-- Blog Subpage -->
          <section data-id="pricing" class="animated-section">
            <div class="section-content">
              <div class="page-title">
                <h2>Pricing</h2>
              </div>

              <!-- <div class="row"> -->
              <!-- <div class="col-xs-12 col-sm-12"> -->
              <div class="row">
                <div class=" col-xs-12 col-sm-12 ">

                  <div class="fw-pricing clearfix row">

                    <?php $sql2 = "SELECT * FROM `immagini` where `i_persona`='{$card}' and `i_sezione`='pricing' and `i_schermo`='true'";
                    // echo $sql2;
                    $result2 = mysqli_query($conn, $sql2);
                    while ($data2 = mysqli_fetch_assoc($result2)) {
                      echo "<div class='fw-package-wrap col-md-6 '>
                                <div class='fw-package'>
                                    <div class='fw-heading-row'>
                                        <span>" . $data2['i_nome'] . "</span>
                                    </div>
                            
                                    <div class='fw-pricing-row'>
                                        <span> $" . $data2['i_url'] . "</span>
                                        
                                    </div>
                            
                                    <div class='fw-default-row'>" . htmlspecialchars_decode(base64_decode($data2['i_descrizione'])) . "</div>
                                </div>
                            </div>";
                    }
                    ?>
                  </div>
                </div>
              </div>
              <!-- End of Pricing -->
              <!-- </div>
              </div> -->
            </div>


          </section>
          <!-- End of Blog Subpage -->

          <!-- Payments Subpage -->
          <section data-id="payments" class="animated-section">
            <div class="section-content">
              <div class="page-title">
                <h2>Payments</h2>
              </div>

              <!-- <div class="row"> -->
              <!-- <div class="col-xs-12 col-sm-12"> -->
              <div class="row">
                <div class=" col-xs-12 col-sm-12 ">
                  <div class="fw-pricing clearfix row">
                    <?php
                    //   echo json_encode($data3);
                    if ($data3['l_gpay'] != "") {
                      echo "<div class='col-xs-12 col-sm-4'>
                                <div class='testimonial'>
                                  <div class='img'>
                                      <a href='upi://pay?pa=" . $data3['l_gpay'] . "' target='_blank'>
                                    <img loading='lazy' src='https://cdn.iconscout.com/icon/free/png-256/google-pay-2038779-1721670.png' alt=''>
                                    </a>
                                  </div>
                                  <div style='margin-top:70px'>
                                     <img class='mt-2'  src='https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=upi://pay?pa=" . $data3['l_gpay'] . "' style='border-radius:12px!important'>
                                    </div>
                                  <div class='text' style='text-align:center'>
                                    <p>" . $data3['l_gpay'] . "</p>
                                  </div>
                                  <div class='author-info'>
                                    <div class='icon'>
                                      <i class='fas fa-dollar-sign'></i>
                                    </div>
                                  </div>
                                </div>
                             </div>";
                    }

                    if ($data3['l_phonepe'] != "") {
                      echo "<div class='col-xs-12 col-sm-4'>
                                <div class='testimonial'>
                                  <div class='img'>
                                      <a href='upi://pay?pa=" . $data3['l_phonepe'] . "' target='_blank'>
                                    <img loading='lazy' src='' alt=''>
                                    </a>
                                  </div>
                                  <div style='margin-top:70px'>
                                     <img class='mt-2' src='https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=upi://pay?pa=" . $data3['l_phonepe'] . "' style='border-radius:12px!important'>
                                    </div>
                                  <div class='text' style='text-align:center'>
                                    <p>" . $data3['l_phonepe'] . "</p>
                                  </div>
                                  <div class='author-info'>
                                    <div class='icon'>
                                      <i class='fas fa-dollar-sign'></i>
                                    </div>
                                  </div>
                                </div>
                             </div>";
                    }

                    if ($data3['l_paytm'] != "") {
                      echo "<div class='col-xs-12 col-sm-4'>
                                <div class='testimonial'>
                                  <div class='img'>
                                      <a href='upi://pay?pa=" . $data3['l_paytm'] . "' target='_blank'>
                                    <img loading='lazy' src='https://pixlok.com/wp-content/uploads/2021/02/Paytm-Cricle-Logo-PNG.jpg' alt=''>
                                    </a>
                                  </div>
                                  <div style='margin-top:70px'>
                                     <img class='mt-2' src='https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=upi://pay?pa=" . $data3['l_paytm'] . "' style='border-radius:12px!important'>
                                    </div>
                                  <div class='text' style='text-align:center'>
                                    <p>" . $data3['l_paytm'] . "</p>
                                  </div>
                                  <div class='author-info'>
                                    <div class='icon'>
                                      <i class='fas fa-dollar-sign'></i>
                                    </div>
                                  </div>
                                </div>
                             </div>";
                    }

                    if ($data3['l_bhim'] != "") {
                      echo "<div class='col-xs-12 col-sm-4'>
                                <div class='testimonial'>
                                  <div class='img'>
                                      <a href='upi://pay?pa=" . $data3['l_bhim'] . "' target='_blank'>
                                    <img loading='lazy' src='https://cdn.iconscout.com/icon/free/png-512/bhim-3-69845.png' alt=''>
                                    </a>
                                  </div>
                                  <div style='margin-top:70px'>
                                     <img class='mt-2' src='https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=upi://pay?pa=" . $data3['l_bhim'] . "' style='border-radius:12px!important'>
                                    </div>
                                  <div class='text' style='text-align:center'>
                                    <p>" . $data3['l_bhim'] . "</p>
                                  </div>
                                  <div class='author-info'>
                                    <div class='icon'>
                                      <i class='fas fa-dollar-sign'></i>
                                    </div>
                                  </div>
                                </div>
                             </div>";
                    }

                    if ($data3['l_accno'] != "") {
                      echo "<div class='col-xs-12 col-sm-4'>
                                <div class='testimonial'>
                                  <div class='img'>
                                      <a href='upi://pay?pa=" . $data3['l_bhim'] . "' target='_blank'>
                                    <img loading='lazy' src='data:image/png;base64,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' alt=''>
                                    </a>
                                  </div>
                                  <div class='text' style='text-align:center'>
                                    <p> Account Number <br><strong>" . $data3['l_accno'] . "</strong></p>
                                    <p> IFSC Code <br> <strong>" . $data3['l_ifsc'] . "</strong></p>
                                    <p> Bank Name <br> <strong>" . $data3['l_bank'] . "</strong></p>
                                  </div>
                                  <div class='author-info'>
                                    <div class='icon'>
                                      <i class='fas fa-dollar-sign'></i>
                                    </div>
                                  </div>
                                </div>
                             </div>";
                    }
                    ?>
                  </div>
                </div>
              </div>
              <!-- End of Payments -->
              <!-- </div>
              </div> -->
            </div>


          </section>
          <!-- End of Blog Payments -->

          <!-- Contact Subpage -->
          <section data-id="contact" class="animated-section">
            <div class="section-content">
              <div class="page-title">
                <h2>Contact</h2>
              </div>

              <div class="row">
                <!-- Contact Info -->
                <div class="col-xs-12 col-sm-4">
                  <div class="lm-info-block gray-default">
                    <i class="lnr lnr-map-marker"></i>
                    <h4><?= $data['a_address'] ?></h4>
                    <span class="lm-info-block-value"></span>
                    <span class="lm-info-block-text"></span>
                  </div>

                  <div class="lm-info-block gray-default">
                    <i class="lnr lnr-phone-handset"></i>
                    <h4><?= $data['a_contact'] ?></h4>
                    <span class="lm-info-block-value"></span>
                    <span class="lm-info-block-text"></span>
                  </div>

                  <div class="lm-info-block gray-default">
                    <i class="lnr lnr-envelope"></i>
                    <h4><?= $data['a_email'] ?></h4>
                    <span class="lm-info-block-value"></span>
                    <span class="lm-info-block-text"></span>
                  </div>

                  <div class="lm-info-block gray-default">
                    <i class="lnr lnr-checkmark-circle"></i>
                    <h4><?= $data['c_hours'] ?></h4>
                    <span class="lm-info-block-value"></span>
                    <span class="lm-info-block-text"></span>
                  </div>
                  
                </div>
                <!-- End of Contact Info -->

                <!-- Contact Form -->
                <div class="col-xs-12 col-sm-8">
                  <div class="map">
                    <?php
                    $maps = $data['c_maps'];
                    $maps = rawurlencode($maps);
                    //  echo $maps;
                    echo "<iframe width='100%' frameborder='0' scrolling='no' marginheight='0' marginwidth='0' id='gmap_canvas' src='https://maps.google.com/maps?q=" . $maps . "&t=&z=19&ie=UTF8&iwloc=&output=embed'></iframe>";
                    ?> <!--<iframe width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=Nashik&amp;ie=UTF8&amp;&amp;output=embed"></iframe><br />-->
                    <!--<iframe width="100%" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=40.7127837,-74.0059413&amp;"></iframe>-->
                  </div>
                  <div class="block-title">
                    <h3>How Can I <span>Help You?</span></h3>
                  </div>

                  <form class="contact-form" method="post">

                    <div class="messages"></div>

                    <div class="controls two-columns">
                      <div class="fields clearfix">
                        <div class="left-column">
                          <div class="form-group form-group-with-icon">
                            <input type="hidden" name="eto" value="<? $data['a_email'] ?>" />
                            <input id="form_name" type="text" name="name" class="form-control" placeholder="" required="required" data-error="Name is required.">
                            <label>Full Name</label>
                            <div class="form-control-border"></div>
                            <div class="help-block with-errors"></div>
                          </div>

                          <div class="form-group form-group-with-icon">
                            <input id="form_email" type="email" name="email" class="form-control" placeholder="" required="required" data-error="Valid email is required.">
                            <label>Email Address</label>
                            <div class="form-control-border"></div>
                            <div class="help-block with-errors"></div>
                          </div>

                          <div class="form-group form-group-with-icon">
                            <input id="" type="text" name="number" class="form-control" placeholder="" required="required" data-error="Number is required.">
                            <label>Contact Number</label>
                            <div class="form-control-border"></div>
                            <div class="help-block with-errors"></div>
                          </div>
                        </div>
                        <div class="right-column">
                          <div class="form-group form-group-with-icon">
                            <textarea id="form_message" name="message" class="form-control" placeholder="" rows="7" required="required" data-error="Please, leave me a message."></textarea>
                            <label>Message</label>
                            <div class="form-control-border"></div>
                            <div class="help-block with-errors"></div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-3 col-sm-6">
                          <img src="captcha.php">
                        </div>
                        <div class="col-md-6 col-sm-6">
                          <div class="form-group form-group-with-icon">
                            <input id="form_captcha" type="text" name="vercode" class="form-control" placeholder="" required="required" data-error="Captcha is required.">
                            <label>Captcha</label>
                            <div class="form-control-border"></div>
                            <div class="help-block with-errors"></div>
                          </div>
                        </div>


                        <input type="submit" class="button btn-send" name="btn_contact" style="margin-top:8px" value="Send message">
                      </div>
                  </form>
                  <!-- <h5 style="color: red" style="margin-top:10px!important"> <?= $captchaerror ?> </h5>
                    <h5 style="color: green" style="margin-top:10px!important"> <?= $emailstatus ?> </h5> -->
                </div>
                <!-- End of Contact Form -->
              </div>

            </div>
          </section>
          <!-- End of Contact Subpage -->
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="js/modernizr.custom.js"></script>
  <script src="js/animating.js"></script>
  <script src="js/imagesloaded.pkgd.min.js"></script>
  <!--<script src='https://www.google.com/recaptcha/api.js'></script>-->
  <script src='js/perfect-scrollbar.min.js'></script>
  <script src='js/jquery.shuffle.min.js'></script>
  <script src='js/masonry.pkgd.min.js'></script>
  <script src='js/owl.carousel.min.js'></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDj03mXZ5AmFR26wSEQ2ZHj4dD0wqS9Rrc"></script>
  <script src="js/jquery.googlemap.js"></script>
  <script src="js/validator.js"></script>
  <script src="js/main.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.2.0-beta.2/lightgallery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.2.0-beta.2/plugins/share/lg-share.umd.min.js"></script>

</body>

<script>
  $("#wpsharebtn").prop("href", "http://www.jakcms.com")
  $("#wpshare").change(function() {
    no = $("#wpshare").val();
    // alert(no)
    currLoc = $(location).attr('href');
    $("#wpsharebtn").prop("href", "whatsapp://send?phone=+" + no + "&text=Hello, this is our Digital Visiting Card.\n " + currLoc)
  });

  $(document).ready(function() {
    $("#wpshare").val("91");
    $("#wpshare").inputFilter(function(value) {
      return /^\d*$/.test(value); // Allow digits only, using a RegExp
    });
  });

  (function($) {
    $.fn.inputFilter = function(inputFilter) {
      return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
        if (inputFilter(this.value)) {
          this.oldValue = this.value;
          this.oldSelectionStart = this.selectionStart;
          this.oldSelectionEnd = this.selectionEnd;
        } else if (this.hasOwnProperty("oldValue")) {
          this.value = this.oldValue;
          this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
        } else {
          this.value = "";
        }
      });
    };
  }(jQuery));

  function clearwp() {
    $("#wpshare").val("91");
  }
</script>

</html>