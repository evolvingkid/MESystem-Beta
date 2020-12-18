<?php
session_start();
?>

<?php 
// * check user permission
if (isset($_SESSION['userType'])) {
    include('../../config/SQL/index.php');
    $conn  = mySql();
    include('../../config/auth/index.php');
    if (!userAUthertication($_SESSION['username'], $_SESSION['password'], $conn)) {
        header("Location: ../");
    }
}else{
    header("Location: ../");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MESystem</title>
    <link rel="stylesheet" href="../../assets/CSS/bootsrap/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/CSS/custom/main.css">
    <link rel="stylesheet" href="../../assets/CSS/custom/dashboard.css">
    <script src="../../assets/JS/ajax/ajax.js"></script>
</head>
<body>
    <?php
        include('../assets/navigation/index.php');
        mainNavigation($_SESSION['name']);
    ?>
  
    <?php
        include('../assets/navigation/sideNavigationBar.php');
        sideNavigationBar();
    ?>
    
    <div class="w-75 float-left ml-5 mt-5">
       <?php 
       
       // * dont need to initial database because we need it above
       $isUserAdmin = $_SESSION["userType"] == "superUser";
      
       $userID = $_SESSION['UserID'];
     
       ?>
       <div class="container p-2" style="background-color: white; border-radius: 5px;">

        <h5> Choose seat Arrangmnet</h5>

        <div class="form-group">
            <label for="my-select">Choose Date</label>
            <select id="my-select" class="form-control" name="">
                <option>Text</option>
            </select>
        </div>
           

       <button class="btn btn-success" type="button">Start Seat Arrangmnet</button>

       </div>


    </div>
    <script src="../../assets/JS/bootstrap/jquery.js"></script>
    <script src="../../assets/JS/bootstrap/bootstrap.bundle.min.js"></script>
</body>
</html>