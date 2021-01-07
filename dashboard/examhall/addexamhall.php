<?php 

include('../../config/SQL/index.php');
$conn  = mySql();
if (!isset($_GET['supeerUserID'])) {
    echo "You dont have acess";
}

if (isset($_GET['program'])) {

    $programName = $_GET['program'];
    $superUserID = $_GET['supeerUserID'];
    $totseats = $_GET['seat'];
    
    $sql = "INSERT INTO examhall (`hallname`, superuser_ID, seats)
            VALUES ('$programName', $superUserID, $totseats)";

    if ($conn->query($sql) === TRUE) {
        echo "Program sucessfull added";
     } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }   
    
}
$conn->close();

?>