<?php
require_once 'Classes/PHPExcel.php';

//database connection (using mysqli)
$con = mysqli_connect("localhost","root","","PHPExcelTest");
if(!$con){
	echo mysqli_error($con);
	exit;
}

//create PHPExcel object
$excel = new PHPExcel();

//selecting active sheet
$excel->setActiveSheetIndex(0);

//populate the data
$query = mysqli_query($con,"select * from Clients");
$row = 4;
while($data = mysqli_fetch_object($query)){
	$excel->getActiveSheet()
		->setCellValue('A'.$row , $data->ClientID)
		->setCellValue('B'.$row , $data->ClientName)
		->setCellValue('C'.$row , $data->Address)
		->setCellValue('D'.$row , $data->Phone);
	//increment the row
	$row++;
}

//set column width
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);

//make table headers
$excel->getActiveSheet()
	->setCellValue('A1' , 'List Of Clients') //this is a title
	->setCellValue('A3' , 'ID')
	->setCellValue('B3' , 'Name')
	->setCellValue('C3' , 'Address')
	->setCellValue('D3' , 'Phone')
	;

//merging the title
$excel->getActiveSheet()->mergeCells('A1:D1');

//aligning
$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal('center');

//styling
$excel->getActiveSheet()->getStyle('A1')->applyFromArray(
	array(
		'font'=>array(
			'size' => 24,
		)
	)
);
$excel->getActiveSheet()->getStyle('A3:D3')->applyFromArray(
	array(
		'font' => array(
			'bold'=>true
		),
		'borders' => array(
			'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
			)
		)
	)
);
//give borders to data
$excel->getActiveSheet()->getStyle('A4:D'.($row-1))->applyFromArray(
	array(
		'borders' => array(
			'outline' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
			),
			'vertical' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
			)
		)
	)
);


//redirect to browser (download) instead of saving the result as a file
//this is for MS Office Excel xls format
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="test.xlsx"');
header('Cache-Control: max-age=0');

//write the result to a file
$file = PHPExcel_IOFactory::createWriter($excel,'Excel2007');
//output to php output instead of filename
$file->save('php://output');

?>
