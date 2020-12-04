<?php 
function checkIsSuperuser($userName, $password, $conn)
{
    //! need to import and use mysql function to this to work
    $sql = "SELECT * ,(superUser.id)superUserID FROM  superUser
            LEFT JOIN user
            ON superUser.userid =  user.id  WHERE user.username = '$userName' AND user.password = '$password'";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $superuserData = array("isSuperUser" => TRUE, 
                                "UserID" => $row['userid'],
                                "SuperUserID" => $row['superUserID'],
                                "name" => $row['name']);
          }
          return  $superuserData;
    }
    $superuserData = array("isSuperUser" => FALSE, 
                                "UserID" => NULL,
                                "SuperUserID" => NULL,
                                "name" => NULL);
    return $superuserData;
}

?>