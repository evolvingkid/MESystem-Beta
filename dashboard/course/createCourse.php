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
    
    $sql = "INSERT INTO course (`course_name`, supeerUserID, programid, id)
            VALUES ('$courseName', $superUserID, $programID, '$courseID')";

    if ($conn->query($sql) === TRUE) {
        echo "Program sucessfull added";
     } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }   
    
}
$conn->close();

?>