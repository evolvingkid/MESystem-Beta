<?php 

include('../../config/SQL/index.php');
$conn  = mySql();
if (!isset($_GET['supeerUserID'])) {
    echo "You dont have acess";
}

if (isset($_GET['program'])) {

    $programName = $_GET['program'];
    $superUserID = $_GET['supeerUserID'];
    
    $sql = "INSERT INTO program (`program name`, supeerUserID)
            VALUES ('$programName', $superUserID)";

    if ($conn->query($sql) === TRUE) {
        echo "Program sucessfull added";
     } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }   
    
}
$conn->close();

?>