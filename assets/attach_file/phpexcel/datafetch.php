<?php
require_once 'Classes/PHPExcel.php';

//we can combine this with file upload
if( empty($_FILES) ){
	echo "
		<form method='post' enctype='multipart/form-data' action='datafetch.php'>
			<input type='file' name='excel'>
			<br>
			<button type='submit'>Fetch</button>
		</form>
	";
}else{

	//load excel file using PHPExcel's IOFactory
	//change filename to tmp_name of uploaded file
	$excel = PHPExcel_IOFactory::load($_FILES['excel']['tmp_name']);

	//set active sheet to first sheet
	$excel->setActiveSheetIndex(0);

	echo "<table border=1>";

	//first row of data series
	$i = 4;

	//loop until the end of data series(cell contains empty string)
	while( $excel->getActiveSheet()->getCell('A'.$i)->getValue() != ""){
		//get cells value
		$id =		$excel->getActiveSheet()->getCell('A'.$i)->getValue();
		$name =		$excel->getActiveSheet()->getCell('B'.$i)->getValue();
		$address =	$excel->getActiveSheet()->getCell('C'.$i)->getValue();
		$phone =	$excel->getActiveSheet()->getCell('D'.$i)->getValue();
		
		//echo
		echo "
			<tr>
				<td>".$id."</td>
				<td>".$name."</td>
				<td>".$address."</td>
				<td>".$phone."</td>
			</tr>
		";
		
		//and DON'T FORGET to increment the row pointer ($i)
		$i++;
	}


	echo "</table>";
	
}

