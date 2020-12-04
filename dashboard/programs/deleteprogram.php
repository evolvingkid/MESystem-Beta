<?php 

include('../../config/SQL/index.php');
$conn  = mySql();
if (!isset($_GET['supeerUserID'])) {
    echo "You dont have acess";
}

if (isset($_GET['programID'])) {

    $programID = $_GET['programID'];
    
    $sql = "DELETE FROM program WHERE id=$programID";

    if ($conn->query($sql) === TRUE) {
        echo "Program sucessfull delete";
     } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }   
    
}
$conn->close();

?>