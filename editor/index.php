<?php
session_start();
include("dbconfig.php");

$error = "";
if (isset($_SESSION["isLoggedIn"])) {
  $type = $_SESSION["usertype"];
  header("location: dashboard.php");
}

if (isset($_POST['btn_login'])) {
//   echo json_encode($_POST);
  $uname = $_POST['phone'];
  $upass = $_POST['password'];
  $sql = "SELECT * FROM cards where link = '{$uname}' and u_pass='{$upass}' and is_active='1'";
  $result = mysqli_query($conn, $sql);
  // echo $sql;
  if (mysqli_num_rows($result) > 0) {
    // session_start();
    while ($row = mysqli_fetch_assoc($result)) {
      // $type = $row["u_type"]; 
      $_SESSION["isLoggedIn"] = true;
      $_SESSION["uid"] = $row["u_name"];
      $_SESSION["card"] = $row["link"];
      $_SESSION["usertype"] = "user";
      $_SESSION['company'] = $row['c_company'];
      header("location: dashboard.php");
      // echo json_encode(["code" => 200, "uname" => $row["u_name"], "msg" => 1]);
    }
  } else {
    $error = "Invalid Credentials";
    // echo json_encode(["code" => 404, "authERR" => "Username or Password is Incorrect"]);
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport" />
  <title>Login &mdash; Dynamic Portfolio Generator</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="./assets/css/style.css" />
  <link rel="stylesheet" href="./assets/css/components.css" />
  <link rel="stylesheet" href="./assets/css/login.css" />
</head>

<body>
  <div id="app">
    <section class="section">

      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">Dynamic Portfolio Generator</div>

            <div class="card card-primary">
              <div class="card-header">
                <h4>Login</h4>
              </div>

              <div class="card-body">
                <form method="POST" action="#" class="needs-validation" novalidate="" name="loginform">
                  <div class="form-group">
                    <label for="email">Username</label>
                    <input id="phone" type="text" class="form-control" name="phone" tabindex="1" required autofocus />
                    <label class="phone-err error"></label>
                    <div class="invalid-feedback">
                      Please fill in your Username
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                      <div class="float-right">
                        <a href="auth-forgot-password.html" class="text-small">
                          Forgot Password?
                        </a>
                      </div>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required />
                    <label class="pass-err error" style="color: red;"> <?= $error ?></label>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4" id="login-submit" name="btn_login">
                      Login
                    </button>
                    <label class="auth-err error"></label>
                  </div>
                  <!-- <div class="mt-2 text-muted text-center">
                    Don't have an account?
                    <a href="customer-register.php">Create One</a>
                  </div> -->
                </form>

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
  <script src="./assets/js/stisla.js"></script>

  <!-- JS Libraies -->


  <!-- Template JS File -->
  <script src="./assets/js/scripts.js"></script>
  <script src="./assets/js/custom.js"></script>

  <!-- Page Specific JS File -->
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>

  <script src="./assets/js/page/auth-login.js"></script>
</body>

</html>