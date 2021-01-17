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
			<input class="form-control p-1"  type='file' name='excel'>
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
                $address =    $excel->getActiveSheet()->getCell('C' . $i)->getValue();
                $phone =    $excel->getActiveSheet()->getCell('D' . $i)->getValue();

                //echo
                echo "
			<tr>
				<td>" . $id . "</td>
				<td>" . $name . "</td>
				<td>" . $address . "</td>
				<td>" . $phone . "</td>
			</tr>
		";

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