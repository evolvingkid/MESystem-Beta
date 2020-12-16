<?php 

include('../../config/SQL/index.php');
$conn  = mySql();

if (!isset($_GET['supeerUserID'])) {
    echo "You dont have acess";
}

if (isset($_GET['studentname'])) {

    $studentName = $_GET['studentname'];
    $studentRollNo = $_GET['rollno'];
    $courseID = $_GET['courseid'];
    $superUserID = $_GET['supeerUserID'];
    $programID = $_GET['programid'];
    
    $sql = "INSERT INTO student (`name`, programid, courseid, studentrollnumber, superuser)
            VALUES ('$studentName', $programID, '$courseID', '$studentRollNo', '$superUserID')";

    if ($conn->query($sql) === TRUE) {
        echo "Program sucessfull added";
     } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }   
    
}
$conn->close();

?>