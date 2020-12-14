<?php 

include('../../config/SQL/index.php');
$conn  = mySql();
if (!isset($_GET['supeerUserID'])) {
    echo "You dont have acess";
}

if (isset($_GET['examhallID'])) {

    $programID = $_GET['examhallID'];
    
    $sql = "DELETE FROM examhall WHERE id='$programID'";

    if ($conn->query($sql) === TRUE) {
        echo "Program sucessfull delete";
     } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }   
    
}
$conn->close();

?>