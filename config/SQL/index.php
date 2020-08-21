<?php 


// ! need to get connecttions variable to work in the database
function mySql()
{
    $servername = "localhost"; 
    $username = "root";
    $password = "";
    $dbname = "MESystem";

    $conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
    if ($conn->connect_error) {
       // die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

?>