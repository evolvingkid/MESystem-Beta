<?php
session_start();
?>

<?php
// * check user permission
if (isset($_SESSION['userType'])) {
    include('../../../config/SQL/index.php');
    $conn  = mySql();
    include('../../../config/auth/index.php');
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
    <title>Mes System</title>
    <link rel="stylesheet" href="../../../assets/CSS/bootsrap/bootstrap.min.css">
    <link rel="stylesheet" href="../../../assets/CSS/custom/main.css">
    <link rel="stylesheet" href="../../../assets/CSS/custom/dashboard.css">
    <script src="../../assets/JS/ajax/ajax.js"></script>
</head>

<body>
    <?php
    include('../../assets/navigation/index.php');
    mainNavigation($_SESSION['name']);
    ?>

    <?php
    include('../../assets/navigation/sideNavigationBar.php');
    sideNavigationBar();
    ?>

    <div class="w-75 float-left ml-5 mt-5 bg-white p-3">
        <h5> Export Data from Excel</h5>
        <?php

        require('../../../assets/attach_file/phpexcel/Classes/PHPExcel.php');


        //we can combine this with file upload
        if (empty($_FILES)) { ?>

            <form method='post' enctype='multipart/form-data' action=''>
                <input class="form-control p-1" type='file' name='excel'>
                <br>
                <button type='submit' class="btn btn-primary mt-2">Fetch</button>
            </form>

        <?php
        } else {

            //load excel file using PHPExcel's IOFactory
            //change filename to tmp_name of uploaded file
            $excel = PHPExcel_IOFactory::load($_FILES['excel']['tmp_name']);

            //set active sheet to first sheet
            $excel->setActiveSheetIndex(0);

            echo "<table border=1>";

            //first row of data series
            $i = 4;

            //loop until the end of data series(cell contains empty string)
            while ($excel->getActiveSheet()->getCell('A' . $i)->getValue() != "") {
                //get cells value
                $id =        $excel->getActiveSheet()->getCell('A' . $i)->getValue();
                $name =        $excel->getActiveSheet()->getCell('B' . $i)->getValue();
                $program =    $excel->getActiveSheet()->getCell('C' . $i)->getValue();
                $course =    $excel->getActiveSheet()->getCell('D' . $i)->getValue();
                $rollNumber =    $excel->getActiveSheet()->getCell('E' . $i)->getValue();

                //echo
                echo "
			<tr>
				<td>" . $id . "</td>
				<td>" . $name . "</td>
				<td>" . $program . "</td>
                <td>" . $course . "</td>
                <td>" . $rollNumber . "</td>
			</tr>
        ";

                $isCourseAcess = false;
                $courseID = 0;

                $sql = "SELECT * FROM course";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                        if (strtolower($row['course_name']) ==  strtolower($course)) {
                            $isCourseAcess = true;
                            $courseID = $row['id'];
                        }
                    }
                } else {
                }

                $isProgramAcess = false;
                $programID = 0;

                $sql = "SELECT * FROM program";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                        if (strtolower($row['program name']) ==  strtolower($program)) {
                            $isProgramAcess = true;
                            $programID = $row['id'];
                        }
                    }
                } else {
                }

                $sql = "INSERT INTO student (`name`, programid, courseid, studentrollnumber, superuser)
                VALUES ('$name', $programID, '$courseID', '$rollNumber', 0)";

                if ($conn->query($sql) === TRUE) {
                    echo "Program sucessfull added";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }




                //and DON'T FORGET to increment the row pointer ($i)
                $i++;
            }


            echo "</table>";
        } ?>
    </div>

    <script src="../../../assets/JS/bootstrap/jquery.js"></script>
    <script src="../../../assets/JS/bootstrap/bootstrap.bundle.min.js"></script>

</body>

</html>