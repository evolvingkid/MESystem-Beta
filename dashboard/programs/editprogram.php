<?php 

include('../../config/SQL/index.php');
$conn  = mySql();
if (!isset($_GET['supeerUserID'])) {
    echo "You dont have acess";
}

if (isset($_GET['programID'])) {

    $programName = $_GET['program'];
    $superUserID = $_GET['supeerUserID'];
    $programID = $_GET['programID'];

    $sql = "UPDATE program 
    SET `program name`='$programName', supeerUserID = $superUserID
    WHERE id=$programID";
    

    if ($conn->query($sql) === TRUE) {
        echo "Program sucessfull added";
     } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }   
    
}
$conn->close();

?>