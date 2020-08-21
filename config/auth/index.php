<?php 

function userAUthertication($username, $password, $conn)
{
    //! need to import and use mysql function to this to work
    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        return true;
    }
    return false;
}

?>