<?php
include("header.php");
$card = $_SESSION['card'];
// include("dbconfig.php");

$error = "";
$success = "";
if(isset($_POST['changepassword'])){
    // echo json_encode($_POST);
    $old = $_POST['old'];
    $new = $_POST['newpassword'];
    $confirm = $_POST['confirm'];
    if($new != $confirm){
        $error = "Password Doesn't Match!";
    }
    else{
        $sql = "SELECT u_pass FROM cards where link = '{$card}'";
          $result = mysqli_query($conn, $sql);
          $data = mysqli_fetch_assoc($result);
          if($old != $data['u_pass']){
              $error = "Incorrect Old Password!";
          }
          else{
              $sql = "UPDATE cards SET u_pass='{$new}' where link = '{$card}'";
              if(mysqli_query($conn, $sql)){
                  $success = "Password Changed Successfully!";
              }
          }
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
<body>

  <div class="main-content">
      <section class="section">
            <div class="section-header">
                <h1>Profile</h1>
            </div>
        </section>
        
    <section class="section">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4>General</h4>
            </div>
            <div class="card-body">
              <div class="row">
                  <div class="col-md-6 col-sm-12">
                      <form method="POST" style="padding:20px">
                          <label>Old Password</label>
                          <input type="password" class="form-control" name="old" placeholder="Enter Old Password" required>
                          <label>New Password</label>
                          <input type="password" class="form-control" name="newpassword" placeholder="Enter New Password" required>
                          <label>Confirm New Password</label>
                          <input type="password" class="form-control" name="confirm" placeholder="Confirm New Password" required>
                          <input type="submit" value="Change Password" name="changepassword" class="btn btn-success mt-3">
                          <br>
                          <?php 
                            if($error != ""){
                                echo "<label class='alert alert-danger mt-2'>".$error."</label>";
                            }
                            if($success != ""){
                                echo "<label class='alert alert-success mt-2'>".$success."</label>";
                            }
                          ?>
                      </form>
                  </div>
                  <div class="col-md-1"></div>
                  <div class="col-md-4 col-sm-12">
                <div class="col-md-12" >
                    <div class="row">
                        <button class="btn btn-success mb-2" style="float:right!important" id="btn_convert"><i class="fas fa-download"></i></button>
                    </div>
                  <div class="card card-hero" id="printdiv">
                    <div class="card-header">
                      <div class="card-icon">
                        <i class=""></i>
                      </div>
                      <h4 style="text-align:center;"> <?= $_SESSION['uid'] ?></h4>
                      <div class="card-description" style="text-align:center;"><?= $_SESSION['company'] ?></div>
                    </div>
                    <div class="card-body p-0">
                    <div style="width:80%!important;margin:auto">
                     <img src='https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=https://myecompany.co.in/<?= $card ?>' style='width:100%!important;object-fit:contain;margin:auto'>
                     <h5 style="text-align:center;margin-top:=-20px;"><?= $card ?></h5>
                     <hr>
                     <p style="text-align:center">© myecompany</p>
                   </div>
                    </div>
                  </div>
                </div>
                
                <center>
                    <!--<button onclick="print()" class="btn btn-success">Print</button>-->
                </center>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
          
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
  <script src="node_modules/summernote/dist/summernote-bs4.js"></script>
  <script src="node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
  <script src="https://html2canvas.hertzen.com/dist/html2canvas.js" type="text/javascript"></script> 


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
  <script type="text/javascript">
//      document.getElementById("btn_convert").addEventListener("click", function() {
// 	html2canvas(document.getElementById("printdiv")).then(function (canvas) {			var anchorTag = document.createElement("a");
// 			document.body.appendChild(anchorTag);
// 			document.getElementById("previewImg").appendChild(canvas);
// 			anchorTag.download = "filename.jpg";
// 			anchorTag.href = canvas.toDataURL();
// 			anchorTag.target = '_blank';
// 			anchorTag.click();
// 		});
//  });
 
   $("#btn_convert").on('click', function () {
                // alert("Works")
                html2canvas(document.getElementById("printdiv"), {
                    scale: 2,useCORS: true,}).then(function (canvas) {                   
                    var anchorTag = document.createElement("a");
                    document.body.appendChild(anchorTag);
                    anchorTag.download = "<?= $_SESSION['company'] ?>.png";
                    anchorTag.href = canvas.toDataURL();
                    anchorTag.click();
                    anchorTag.target = '_blank';
                });
                
                // html2canvas(document.getElementById("printdiv"),
                // {
                // letterRendering: 1,
                // allowTaint: true,
                // useCORS: true,
                // onrendered: function (canvas) {
                //     var anchorTag = document.createElement("a");
                //     document.body.appendChild(anchorTag);
                //     anchorTag.download = "<?= $_SESSION['company'] ?>.png";
                //     anchorTag.href = canvas.toDataURL();
                //     anchorTag.target = '_blank';
                //     anchorTag.click();
                // }
                // });

    });


</script>

</body>

</html>