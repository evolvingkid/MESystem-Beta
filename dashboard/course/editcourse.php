<?php 

include('../../config/SQL/index.php');
$conn  = mySql();



if (!isset($_GET['supeerUserID'])) {
    echo "You dont have acess";
}

if (isset($_GET['course'])) {

    $courseName = $_GET['course'];
    $courseID = $_GET['courseid'];
    $superUserID = $_GET['supeerUserID'];
    $programID = $_GET['programid'];
    $currentid = $_GET['currentid'];
    
    echo $_GET['course']; 
    echo "<br>";
    $sql = "UPDATE course SET id = '$courseID', course_name = '$courseName', programid = $programID , supeerUserID = $superUserID WHERE id='$currentid'";

    echo $sql;

    if ($conn->query($sql) === TRUE) {
        echo "Program sucessfull added";
     } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }   
    
}


?>