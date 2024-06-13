<?php 
session_start();

if (isset($_POST['newentry'])) {
    // echo json_encode($_POST);
    $title = $_POST['title'];
    $code =  str_replace("\/", "/", htmlentities($_POST['code']));
    $desc = base64_encode($code);
    $url = $_POST['url'];
    $id = $_POST['entry_type'];
    $card = $_SESSION['card'];
    $section = $file;
  
  if (basename($_FILES['attachment']['name']) != '') {
    $attachment = $_FILES['attachment']['name'];
    $db = "assets/attachments/{$card}/";
    $target_dir = "./../assets/attachments/{$card}/";
    $dbpath = $db . basename($_FILES["attachment"]["name"]);
    $target_file = $target_dir . basename($_FILES["attachment"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  }
  
  if($id == "0"){
    $sql = "INSERT INTO `immagini` (`i_nome`, `i_sezione`, `i_descrizione`, `i_schermo`, `i_aggiunto`, `i_aggiornato`, `i_persona`, `i_allegato`, `i_url`) VALUES ('{$title}', '{$section}', '{$desc}', 'true', Now(), Now(), '{$card}', '{$dbpath}', '{$url}');";   
    // echo $sql;
    move_uploaded_file($_FILES['attachment']['tmp_name'], $target_dir . $attachment);
  }
  else{
      if (basename($_FILES['attachment']['name']) != '') {
        $sql = "UPDATE `immagini` SET `i_nome` = '{$title}', `i_descrizione` = '{$desc}',`i_allegato` = '{$dbpath}', `i_url`= '{$url}' where `i_id` = '{$id}'";   
        move_uploaded_file($_FILES['attachment']['tmp_name'], $target_dir . $attachment);
      }
      else{
         $sql = "UPDATE `immagini` SET `i_nome` = '{$title}', `i_descrizione` = '{$desc}', `i_url`= '{$url}' where `i_id` = '{$id}'";
      }
  }
    // echo $sql;
    
    if ($conn->query($sql) === TRUE) {
  
      // echo "User Successfully Added";
      $str = "location : {$section}.php";
      // header($str);
    } else {
      echo mysqli_error($conn);
      echo "<script>console.log('" . mysqli_error($conn) . "');</script>";
    }
  }
  
  if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $sql = "UPDATE immagini SET i_schermo='false' where i_id='{$id}'";
    // echo $sql;
    if ($conn->query($sql) === TRUE) {
      echo "<script type='text/javascript'>
                          $(document).ready(function() {
                        swal({
                          position: 'top-end',
                          type: 'success',
                          title: 'Delete Successful',
                          showConfirmButton: false,
                          timer: 2000
                        })
                        })
                      </script>
                      ";
    } else {
      echo mysqli_error($conn);
  
      echo "<script>console.log('" . mysqli_error($conn) . "');</script>";
    }
  }
  
  
  if(isset($_GET['hide'])){
    $id = $_GET['hide'];
    $sql = "UPDATE immagini SET i_schermo='hidden' where i_id='{$id}'";
    // echo $sql;
    if ($conn->query($sql) === TRUE) {
      echo "<script type='text/javascript'>
                          $(document).ready(function() {
                        swal({
                          position: 'top-end',
                          type: 'success',
                          title: 'Delete Successful',
                          showConfirmButton: false,
                          timer: 2000
                        })
                        })
                      </script>
                      ";
    } else {
      echo mysqli_error($conn);
  
      echo "<script>console.log('" . mysqli_error($conn) . "');</script>";
    }
  }
?>

<!--<div class="modal fade bd-example-modal-lg" id="modal_newentry" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">-->
<!--            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">-->
<!--                <div class="modal-content">-->
<!--                    <div class="modal-header">-->
<!--                        <h5 class="modal-title" style="padding-left: 30px;padding-top: 5px" id="modal_pagename"></h5>-->
<!--                        <button type="button" style="padding-right: 40px" class="close" data-dismiss="modal" aria-label="Close">-->
<!--                            <span aria-hidden="true">&times;</span>-->
<!--                        </button>-->
<!--                    </div>-->
<!--                    <div class="modal-body">-->
<!--                        <form method="POST" enctype="multipart/form-data">-->
<!--                            <input type="hidden" name="entry_type" value="0" id="entry_type">-->
<!--                            <div class="title1">-->
<!--                                <h6 id="titlelabel" style="float: left;">Title</h6>-->
<!--                                <input type="text" class="form-control" id="title" placeholder="Enter Here" name="title" style="width: 100%;" autocomplete="off" />-->
<!--                            </div>-->
<!--                            <div id="" class="mt-3">-->
<!--                                <div name="richtext" id="summernote"></div>-->
<!--                                <input type="hidden" name="code" id="code">-->
<!--                                <div class="row">-->
<!--                                    <div class="col-sm-6 col-12">-->
<!--                                        <label class="text-muted"> Upload File</label>-->
<!--                                        <div class="custom-file">-->
<!--                                            <input type="file" id="choose-file" name="attachment" class="custom-file-input">-->
<!--                                            <label class="custom-file-label" id="filename" for="choose-file" aria-describedby="inputGroupFileAddon02">Choose file</label>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="col-sm-6 col-12">-->
<!--                                        <div class="form-group mb-0">-->
<!--                                            <label class="text-muted"> Enter Cost/URL</label>-->
<!--                                            <input type="text" class="form-control" name="url" id="cost" placeholder="₹" autocomplete="off">-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div>-->
<!--                                    <button type="submit" onclick="getcontents()" id="submit" name="newentry" class="btn btn-success mt-3" style="float: right;"><i class="fa fa-check" style="margin-right: 5px;"></i>Submit Entry</button>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </form>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->


  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

  <!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="assets/js/stisla.js"></script>

  <!-- JS Libraies -->
  <script src="node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
  <script src="node_modules/chart.js/dist/Chart.min.js"></script>
  <script src="node_modules/owl.carousel/dist/owl.carousel.min.js"></script>
  <!-- <script src="node_modules/summernote/dist/summernote-bs4.js"></script> -->
  <script src="assets/js/summernote.js"></script>

  <!-- <script src="node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script> -->

  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>

  <!-- Page Specific JS File -->
  <script src="assets/js/page/index.js"></script>

  <!-- Sweet-Alert js -->
  <script src="assets/sweet-alert2/sweetalert2.min.js"></script>
  <script src="assets/custom-sweet-alert.js"></script>

</body>


<script type="text/javascript">
  $(document).ready(function() {
    $('#summernote').summernote({
      placeholder: 'Write Entry Text Here',
      tabsize: 2,
      height: 200,
      callbacks: {
        onPaste: function(e) {
          var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
          e.preventDefault();
          document.execCommand('insertText', false, bufferText);
        }
      },
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['para', ['ul']],
        // ['insert', ['link']],
      ]
    });
  });

  $('#choose-file').on('change', function() {
    ref = $('#choose-file').val().replace(/C:\\fakepath\\/i, '')
    $('#filename').html(ref)
  });

  function getcontents(argument) {
    $('#code').val($('#summernote').summernote('code'));
  }
  
  function edit(id) {
    // alert(id)
    $.ajax({
    type: 'GET',
    url: 'getdata.php',
    data: '&id=' + id,
    success: function(data){
        jsondata = JSON.parse(data);
                $('#title').val(jsondata.title);
                $('#cost').val(jsondata.cost);
                $('#filename').html(jsondata.files);
                $('#entry_type').val(id);
        }
    });
    
     $.ajax({
        type: 'GET',
        url: 'getdesc.php',
        data: '&id=' + id,
        success: function(data){
            // alert(data);
            $('#summernote').summernote('code', data);
        }
      });
  }
  
   if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>