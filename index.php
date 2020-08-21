<!DOCTYPE html>
<?php
session_start();
?>

<?php 
if (isset($_POST['login'])) {
  include('./config/SQL/index.php');
  $conn  = mySql();
  include('./config/auth/index.php');
  if (userAUthertication($_POST['username'], $_POST['password'], $conn)) {
    include('./config/auth/checkIsSuperuser.php');
    $superuserData =  checkIsSuperuser($_POST['username'], $_POST['password'], $conn);
    if ($superuserData['isSuperUser']) {
      $_SESSION["userType"] = "superUser";
      $_SESSION["username"] = $_POST['username'];
      $_SESSION["password"] = $_POST['password'];
      $_SESSION["UserID"] = $superuserData['SuperUserID'];
      $_SESSION["name"] = $superuserData['name'];
    }else{
      include('./config/auth/checkisTeacheruser.php');
      $teacheruserData = checkIsTeacherUser($_POST['username'], $_POST['password'], $conn);
      if ($teacheruserData['isTeachersUser']) {
        $_SESSION["userType"] = "teacher";
        $_SESSION["username"] = $_POST['username'];
        $_SESSION["password"] = $_POST['password'];
        $_SESSION["UserID"] = $superuserData['teachersUserID'];
        $_SESSION["name"] = $superuserData['name'];
      }
    }
   
    
  }else{
    echo "Their is no user";
  }
  
}

?>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MESystem</title>
  <link rel="stylesheet" href="./assets/CSS/bootsrap/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/CSS/custom/main.css">
</head>

<body>
  <div class="container-fluid loginUi">
    <div class="row">
      <div class="col-md-6 mt-5 pt-5">
        <div class="container mt-5 pt-5 ml-5">
          <form action="" method="post">

            <h4 class="text-secondary">Welcome to</h4>
            <h3 class="text-dark-blue">MESystem</h3>
            <!--*login form-->
            <div class="form-group mt-5">
              <label for="">Username</label>
              <input type="text" class="form-control w-75" name="username" id="" aria-describedby="helpId"
                placeholder="Username">
              <small id="helpId" class="form-text text-muted">Your Email Id</small>
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