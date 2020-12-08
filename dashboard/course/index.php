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
    include('./table.php');
    courseTable($conn, $isUserAdmin, $userID);

    ?>


    </div>

    <script src="../../assets/JS/bootstrap/jquery.js"></script>
    <script src="../../assets/JS/bootstrap/bootstrap.bundle.min.js"></script>
    
</body>
</html>