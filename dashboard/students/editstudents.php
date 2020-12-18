<?php 

include('../../config/SQL/index.php');
$conn  = mySql();



if (!isset($_GET['supeerUserID'])) {
    echo "You dont have acess";
}

if (isset($_GET['studentid'])) {

    $studentID = $_GET['studentid'];
    $superUserID = $_GET['supeerUserID'];
    $studentName = $_GET['studentname'];
    $studentnumber = $_GET['studentroll'];
    $programID = $_GET['program'];
    $courseID = $_GET['course'];
    
    echo $_GET['course']; 
    echo "<br>";
    $sql = "UPDATE student SET name = '$studentName', programid = '$programID', courseid = '$courseID' , studentrollnumber = '$studentnumber', superuser = $superUserID WHERE id='$studentID'";

    echo $sql;

    if ($conn->query($sql) === TRUE) {
        echo "Program sucessfull added";
     } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }   
    
}


?>