<?php
require_once 'Classes/PHPExcel.php';

//create PHPExcel object
$excel = new PHPExcel();

//define some styles
$styleBigRed=array(
	'font'=>array(
		'size'=>24,
		'color'=>array('rgb'=>'FF0000')
	)
);
$styleBigYellowWithBlueFill=array(
	'font'=>array(
		'size'=>24,
		'color'=>array('rgb'=>'FFFF00')
	),
	'fill'=>array(
		'type'=>PHPExcel_Style_Fill::FILL_SOLID,
		'color'=>array('rgb'=>'0000FF')
	)
);
$styleBordered=array(
	'borders'=>array(
		'allborders' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN
		)
	)
);
$styleBottomBorderOnly=array(
	'borders'=>array(
		'bottom' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color'=> array('rgb'=>'00FF00')
		)
	)
);

//insert some data to PHPExcel object
$excel->setActiveSheetIndex(0)
	->setCellValue('A1','Hello')
	->setCellValue('B1','World');

//apply the styles
$excel->getActiveSheet()->getStyle('A1')->applyFromArray($styleBigRed);
$excel->getActiveSheet()->getStyle('B1')->applyFromArray($styleBigYellowWithBlueFill);
$excel->getActiveSheet()->getStyle('A1:B2')->applyFromArray($styleBordered);
$excel->getActiveSheet()->getStyle('A5:D5')->applyFromArray($styleBottomBorderOnly);

//set column width
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(50);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(100);

//set row height
$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(50);
$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(100);


//redirect to browser (download) instead of saving the result as a file

//this is for MS Office Excel 2007 xlsx format
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="test.xlsx"');

//this is for MS Office Excel 2003 xls format
//header('Content-Type: application/vnd.ms-excel');
//header('Content-Disposition: attachment; filename="test.xlsx"');


header('Cache-Control: max-age=0');

//write the result to a file
//for excel 2007 format
$file = PHPExcel_IOFactory::createWriter($excel,'Excel2007');

//for excel 2003 format
$file = PHPExcel_IOFactory::createWriter($excel,'Excel5');

//output to php output instead of filename
$file->save('php://output');

?>
