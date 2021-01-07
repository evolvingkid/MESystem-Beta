<?php
session_start();
?>

<?php
// * check user permission
if (isset($_SESSION['userType'])) {
    include('../../config/SQL/index.php');
    $conn  = mySql();
    include('../../config/auth/index.php');
    if (!userAUthertication($_SESSION['username'], $_SESSION['password'], $conn)) {
        header("Location: ../");
    }
} else {
    header("Location: ../");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MESystem</title>
    <link rel="stylesheet" href="../../assets/CSS/bootsrap/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/CSS/custom/main.css">
    <link rel="stylesheet" href="../../assets/CSS/custom/dashboard.css">
    <script src="../../assets/JS/ajax/ajax.js"></script>
</head>

<body>
    <?php
    include('../assets/navigation/index.php');
    mainNavigation($_SESSION['name']);
    ?>

    <?php
    include('../assets/navigation/sideNavigationBar.php');
    sideNavigationBar();
    ?>

    <div class="w-75 float-left ml-5 mt-5">
        <?php

        // * dont need to initial database because we need it above
        $isUserAdmin = $_SESSION["userType"] == "superUser";

        $userID = $_SESSION['UserID'];

        ?>


        <?php
        if (isset($_POST['examdate'])) {

            $examDate = $_POST['examdate'];
            $sql = "SELECT * FROM course WHERE examDate = '$examDate'";
            $result = $conn->query($sql);
            // * course initilise
            $course = array();
            $count = 0;
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $course[$count]['course_name'] = $row['course_name'];
                    $course[$count]['programid'] = $row['programid'];
                    $course[$count]['examDate'] = $row['examDate'];
                    $course[$count]['id'] = $row['id'];
                    $count++;
                }
            }
            // print_r($course);

            $sql = "SELECT * FROM examhall";
            $result = $conn->query($sql);
            $examHall = array();
            $count = 0;
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $examHall[$count]['hallname'] = $row['hallname'];
                    $examHall[$count]['seats'] = $row['seats'];
                    $examHall[$count]['id'] = $row['id'];
                    $count++;
                }
            }

            if (count($course) == 0) {
                echo "Their is no course in this date";
            }

            $student = array();
            for ($i = 0; $i < count($course); $i++) {
                $courseID = $course[$i]['id'];
                $sql = "SELECT * FROM student WHERE courseid = '$courseID' ";
                $result = $conn->query($sql);
                $count = 0;
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $student[$courseID][$count]['name'] = $row['name'];
                        $student[$courseID][$count]['studentrollnumber'] = $row['studentrollnumber'];
                        $student[$courseID][$count]['programid'] = $row['programid'];
                        $student[$courseID][$count]['courseid'] = $row['courseid'];
                        $student[$courseID][$count]['id'] = $row['id'];
                        $count++;
                    }
                }
            }

            for ($i = 0; $i < count($course); $i++) {
                $courseID =  $course[$i]['id'];
                for ($j = 0; $j < count($examHall); $j++) {

                    $examHallID = $examHall[$j]['id'];
                    $examHallSeats = $examHall[$j]['seats'];

                    for ($x = 0; $x <  count($student[$courseID]); $x++) {
                        if (($examHallSeats / 2) > $examHall[$j]['seats']) {
                            break;
                       }
                        $studentID = $student[$courseID][$x]['id'];
                        $sql = "INSERT INTO arragment (hallid, studentid, courseid) VALUES ( $examHallID, $studentID, '$courseID')";

                        if ($conn->query($sql) === TRUE) {
                           // echo "New record created successfully";
                          } else {
                          //  echo "Error: " . $sql . "<br>" . $conn->error;
                            break;
                          }

                        $examHall[$j]['seats']--;
                    }
                }
            }
        }

        ?>
        <form class="container p-2" style="background-color: white; border-radius: 5px;" action="" method="POST">

            <h5> Choose seat Arrangmnet</h5>

            <?php
            $sql = "SELECT DISTINCT examDate FROM course";
            $result = $conn->query($sql);

            ?>
            <div class="form-group">
                <label for="my-select">Choose Exam Date</label>
                <select id="my-select" class="form-control" name="examdate">
                    <?php


                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                    ?>

                            <option value="<?php echo $row['examDate'] ?>"><?php echo $row['examDate']; ?></option>

                    <?php
                        }
                    } else {
                        echo "0 results";
                    }
                    ?>
                </select>
        </form>


        <button class="btn btn-success mt-2" type="submit">Start Seat Arrangmnet</button>

    </div>


    </div>
    <script src="../../assets/JS/bootstrap/jquery.js"></script>
    <script src="../../assets/JS/bootstrap/bootstrap.bundle.min.js"></script>
</body>

</html>