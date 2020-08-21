<?php 
function checkIsTeacherUser($userName, $password, $conn)
{
    //! need to import and use mysql function to this to work
    $sql = "SELECT * ,(teachers.id)tecahersID FROM user
            LEFT JOIN teachers
            ON user.id = teachers.userid WHERE user.username = '$userName' AND user.password = '$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $superuserData = array("isTeachersUser" => TRUE, 
                                "UserID" => $row['userid'],
                                "teachersUserID" => $row['superUserID'],
                                "name" => $row['name']);
          }
          return  $superuserData;
    }
    $superuserData = array("isTeachersUser" => FALSE, 
                                "UserID" => NULL,
                                "teachersUserID" => NULL,
                                "name" => NULL);
    return $superuserData;
}

?>