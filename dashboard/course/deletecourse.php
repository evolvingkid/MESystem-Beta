<?php 

include('../../config/SQL/index.php');
$conn  = mySql();
if (!isset($_GET['supeerUserID'])) {
    echo "You dont have acess";
}

if (isset($_GET['courseID'])) {

    $programID = $_GET['courseID'];
    
    $sql = "DELETE FROM course WHERE id='$programID'";

    if ($conn->query($sql) === TRUE) {
        echo "Program sucessfull delete";
     } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }   
    
}
$conn->close();

?>