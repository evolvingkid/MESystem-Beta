<!DOCTYPE html>
<?php
session_start();
?>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LSM Admin</title>
  <link rel="stylesheet" href="./assets/CSS/bootsrap/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/CSS/custom/main.css">
</head>

<body>
  <div class="container-fluid loginUi">
    <div class="row">
      <div class="col-md-6 mt-5 pt-5">
        <div class="container mt-5 pt-5 ml-5">
          <form action="" method="post">
            <p>Admin Login</p>
            <h4 class="text-secondary">Welcome to</h4>
            <h3 class="text-dark-blue">Lab Managment System</h3>
            <!--*login form-->
            <div class="form-group mt-5">
              <label for="">Username</label>
              <input type="text" class="form-control w-75" name="username" id="" aria-describedby="helpId"
                placeholder="Username">
            </div>

            <div class="form-group">
              <label for="">Password</label>
              <input type="password" class="form-control w-75" name="password" id="" aria-describedby="helpId"
                placeholder="Password">
              <small id="helpId" class="form-text text-muted">Enter your input Password secretly</small>
            </div>
            <input name="login" id="" class="btn btn-primary" type="submit" value="Login">


          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="./assets/JS/bootstrap/jquery.js"></script>
  <script src="./assets/JS/bootstrap/bootstrap.bundle.min.js"></script>
</body>

</html>