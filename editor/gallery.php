<?php
include("header.php");
// include("dbconfig.php");
$parents = array();
$sql = "SELECT * FROM sezioni where s_schermo = 'true'";
$result = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_assoc($result)) {
  array_push($parents, $data['s_genitore']);
  if($data['s_id'] == $_GET['id'])
    $sectionm = $data['s_nome'];
}

if (isset($_POST['newentry'])) {
  // echo json_encode($_POST);
  $title = $_POST['title'];
  $code =  str_replace("\/", "/", htmlentities($_POST['code']));
  $desc = base64_encode($code);
  $url = $_POST['url'];
  $user = "Kumran";
  $section = $_POST['section'];

  $attachment = $_FILES['attachment']['name'];
  $db = "assets/attachments/";
  $target_dir = "./../assets/attachments/";
  $dbpath = $db . basename($_FILES["attachment"]["name"]);
  $target_file = $target_dir . basename($_FILES["attachment"]["name"]);
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  $sql = "INSERT INTO `immagini` (`i_nome`, `i_sezione`, `i_descrizione`, `i_schermo`, `i_aggiunto`, `i_aggiornato`, `i_persona`, `i_allegato`, `i_url`) VALUES ('{$title}', '{$section}', '{$desc}', 'true', Now(), Now(), 'Kumran', '{$dbpath}', '{$url}');";
  // echo $sql;
  move_uploaded_file($_FILES['attachment']['tmp_name'], $target_dir . $attachment);
  if ($conn->query($sql) === TRUE) {

    // echo "User Successfully Added";
    echo "<script type='text/javascript'>
                        $(document).ready(function() {
                      swal({
                        position: 'top-end',
                        type: 'success',
                        title: 'Entry Successful',
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

if(isset($_POST['delete'])){
  $id = $_POST['delete'];
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


if(isset($_POST['hide'])){
  $id = $_POST['hide'];
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

<body>
  <!-- <div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index">eye4wild</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
      </div>
      <ul class="sidebar-menu">
        <?php
        $sql = "SELECT * FROM sezioni where s_genitore=0 and s_schermo = 'true'";
        $result = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_assoc($result)) {
          $id = $data['s_id'];
          echo "<li class='menu-header'>" . $data['s_nome'] . "</li>";
          $sql1 = "SELECT * FROM sezioni where s_genitore={$id} and s_schermo = 'true'";
          $result1 = mysqli_query($conn, $sql1);
          $f = 0;
          while ($data1 = mysqli_fetch_assoc($result1)) {
            $sid = $data1['s_id'];
            $sql2 = "SELECT * FROM sezioni where s_genitore={$sid} and s_schermo = 'true'";
            $result2 = mysqli_query($conn, $sql2);

            if (in_array($data1['s_id'], $parents)) {
              echo "<li class='nav-item dropdown'>
                    <a href='#' class='nav-link has-dropdown'><i class='fas fa-th'></i> <span>" . $data1['s_nome'] . "</span></a><ul class='dropdown-menu'>";
              while ($data2 = mysqli_fetch_assoc($result2)) {
                echo "<li><a class='nav-link' href='./gallery.php?id=" . $data2['s_id'] . "&name=" . $data2['s_nome'] . "'>" . $data2['s_nome'] . "</a></li>";
              }
              echo "</ul>
                    </li>";
            } else {
              echo "<li><a class='nav-link' href='blank.html'> <i class='fas fa-th'></i> <span>" . $data1['s_nome'] . "</span> </a></li>";
            }
          }
          // echo "</ul>";
        }
        ?>
      </ul>
    </aside>
  </div> -->

  <!-- Main Content -->
  <div class="main-content">
    <section class="section">
      <div class="section-header" >
        <h1><?= $sectionm ?></h1>
        <button class="btn btn-primary" data-toggle='modal' data-target='#modal_newentry' style="float: right;">Add New</button>
      </div>
      <div class="row">

        <?php
        $id = $_GET['id'];
        $sql = "SELECT * FROM immagini where i_sezione={$id} and i_schermo = 'true'";
        $result = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_assoc($result)) {
          // echo json_encode($data);
          echo "<div class='col-lg-3 col-sm-4 col-xs-6 col-6'>
        <div class='mt-5'>
          <div class='image-grid'>
            <div class='image'>
              <img src='./../" . $data['i_allegato'] . "' style='width:100%;height:100%;object-fit:cover' alt=''>
            </div>
            <div class='edit'>
              <button class='btn btn-icon btn-light' style='width: 100%;border-radius:0px 0px 0px 12px;height:50px'><i class='fas fa-edit'></i></button>
            </div>
            <div class='delete'>
            <form method='POST'>
              <button class='btn btn-icon btn-danger' name='delete' value='".$data['i_id']."' style='width: 100%;;height:50px;border-radius:0px;'><i class='fas fa-trash'></i></button>
            </form>
              </div>
            <div class='hide'>
             <form method='POST'>
              <button class='btn btn-icon btn-info' name='hide' value='".$data['i_id']."' style='width: 100%;border-radius:0px 0px 12px 0px;height:50px'><i class='fas fa-eye-slash'></i></button>
              </form>
            </div>
          </div>
        </div>
      </div>";
        }
        ?>

    </section>
  </div>
  <footer class="main-footer">
    <div class="footer-left">
      Copyright &copy; 2021 <div class="bullet"></div> Design By Suyash Jaju
    </div>
    <div class="footer-right">
      2.3.0
    </div>
  </footer>
  </div>
  </div>

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
</script>

</html>