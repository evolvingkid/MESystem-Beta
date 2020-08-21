<?php
session_start();
?>

<?php 
// * check user permission
if (isset($_SESSION['userType'])) {
    include('../config/SQL/index.php');
    $conn  = mySql();
    include('../config/auth/index.php');
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
    <link rel="stylesheet" href="../assets/CSS/bootsrap/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/CSS/custom/main.css">
</head>
<body>
    
    <script src="../assets/JS/bootstrap/jquery.js"></script>
    <script src="../assets/JS/bootstrap/bootstrap.bundle.min.js"></script>
</body>
</html>