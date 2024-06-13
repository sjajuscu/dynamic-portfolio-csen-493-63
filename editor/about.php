<?php
include("header.php");
session_start();
if(isset($_POST['about_save'])){
    $about = $_POST['about'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $card = $_SESSION['card'];
    $sql = "UPDATE about SET `a_about`='{$about}', `a_contact`='{$contact}', `a_address`='{$address}', `a_email`='{$email}' where `a_nome`='{$card}'";
    if(mysqli_query($conn, $sql)){
        
    }
}

if(isset($_SESSION)){
    $card = $_SESSION['card'];
    $sql = "SELECT * from about where `a_nome`='{$card}'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);
    $about = $data['a_about'];
    $address = $data['a_address'];
    $email = $data['a_email'];
    $contact = $data['a_contact'];
}

?>
<style type="text/css">
    @page {
        size: auto !important;
        margin: 2cm;
    }
</style>


<body>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>About Us</h1>
            </div>
        </section>

        <form method="POST">
            <div class="row" style="align-items:center">
                <div class="col-md-12 col-12">
                    <textarea class="form-control" name="about" style="height:200px"><?= $about ?></textarea>
                </div>
                <div class="col-md-4 col-12 mt-3">
                    <label>Enter Address</label>
                    <input type="text" class="form-control" name="address" value="<?= $address ?>" placeholder="Enter Address">
                </div>
                <div class="col-md-4 col-12 mt-3">
                    <label>Enter Email</label>
                    <input type="email" class="form-control" name="email" value="<?= $email ?>" placeholder="Enter Email">
                </div>
                <div class="col-md-4 col-12 mt-3">
                    <label>Enter Contact Number</label>
                    <input type="number" class="form-control" name="contact" value="<?= $contact ?>" placeholder="Enter Contact">
                </div>
                <div class="col-md-12 col-12 mt-3">
                    <input type="submit" class="btn btn-success" style="width: 100%!important;" value="Save Changes" name="about_save">
                </div>
            </div>
        </form>


        <div class="modal fade bd-example-modal-lg" id="modal_newentry" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" style="padding-left: 30px;padding-top: 5px" id="modal_pagename"></h5>
                        <button type="button" style="padding-right: 40px" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="section" id="page_id" value="<?= $_GET['id'] ?>">
                            <input type="hidden" name="page_name" id="page_name">

                            <div class="title1">
                                <h6 id="titlelabel" style="float: left;">Title</h6>
                                <input type="text" class="form-control" placeholder="Enter Here" name="title" style="width: 100%;" autocomplete="off" />
                            </div>

                            <div id="" class="mt-3">
                                <div name="richtext" id="summernote"></div>
                                <input type="hidden" name="code" id="code">

                                <div class="row">
                                    <div class="col-sm-6 col-12">
                                        <label class="text-muted"> Upload File</label>
                                        <div class="custom-file">
                                            <input type="file" id="choose-file" name="attachment" class="custom-file-input">
                                            <label class="custom-file-label" id="filename" for="choose-file" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group mb-0">
                                            <label class="text-muted"> Enter URL</label>
                                            <input type="text" class="form-control" name="url" id="inputUrl" placeholder="https://yourlink.com" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" onclick="getcontents()" id="submit" name="newentry" class="btn btn-success mt-3" style="float: right;"><i class="fa fa-check" style="margin-right: 5px;"></i>Submit Entry</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
  
        </html>