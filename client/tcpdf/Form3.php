<?php
require_once('tcpdf/tcpdf.php');
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A5', true, 'UTF-8', false);

 
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(true);
$pdf->SetAutoPageBreak(false, 0);
$pdf->AddPage('L'); // Set landscape orientation


$border = 1;
$padding = 10;
$pageWidth = $pdf->getPageWidth();
$pageHeight = $pdf->getPageHeight();
$usableWidth = $pageWidth - 2 * $padding;
$usableHeight = $pageHeight - 2 * $padding;
$x = $padding;
$y = $padding;
$pdf->SetFillColor(207, 159, 255); // R, G, B values
$pdf->Rect($x, $y, $usableWidth, $usableHeight, 'F');
$pdf->Rect($x, $y, $usableWidth, $usableHeight, 'D', array('all' => $border));
$logo= <<<EOD
<table>
<thead>
<tr>
<th></th>
</tr>
</thead>
</table>
EOD;
$pdf->SetXY(15,12);
$pdf->writeHTML($logo,true,false,false,false,'');
$pdf->SetXY(10,10);
$pdf->Cell(135, 20, "",1);

$pdf->SetXY(30,12);
$pdf->SetFont('freesans', 'B',20);
$pdf->Cell(0, 10,"Guskara Himghar PVT.LTD.", 0, 0, 'L');
$pdf->SetXY(30,18);
$pdf->SetFont('freesans', 'B',13);
$pdf->Cell(0, 10,"Cold Storage", 0, 0, 'L');







$pdf->Line(145, 10, 145,139);
$pdf->SetXY(150,10);
$pdf->SetFont('freesans', 'B',8);
$pdf->MultiCell(100, 5,"For terms and conditions \n nihihinihhihddvdvvDFVFVF \n ihihvidhvivpi ", 0, 0, 'R');




$pdf->SetXY(10,30);
$pdf->Cell(0, 10,"SR Number:", 0, 0, 'L');



$pdf->SetXY(10,38);
$pdf->SetFont('freesans', 'B',10);
$pdf->Cell(0, 10,"Bond Number:", 0, 1, 'L');
$pdf->SetXY(10,40);

$pdf->Cell(0,10,"Date:",0,1,'C');
$pdf->SetFont('freesans', '',10);
$pdf->Cell(0,1,"Received:",0,1,'L');
$pdf->Cell(0,9,"Name:",0,1,'L');
$pdf->Cell(0,9,"Address: ",0,1,'L');


$pdf->SetXY(10,74);
$pdf->SetFont('freesans', '',10);
$pdf->Cell(0,9,"Remarks:",0,1,"L");
$pdf->Line(10,73,145,73);
$pdf->Line(10,82,145,82);

$pdf->SetXY(10,110);
$pdf->SetFont('freesans', '',10);

$pdf->Line(10,90,145,90);
$pdf->SetXY(10,83);
$pdf->SetFont('freesans', '',10);
$pdf->Cell(0,9,"Shead No. :",0,1,'L');

$pdf->SetXY(10,90);
$pdf->Cell(40, 7, "Date ",1);
$pdf->Cell(55, 7," Quantity Devilered",1);
$pdf->Cell(40, 7, "Hirer's Signature",1);
$pdf->SetXY(10,97);
$pdf->Cell(40, 25, "",1);
$pdf->Cell(55, 25,"",1);
$pdf->Cell(40, 25, "",1);
$pdf->SetXY(10,145);
$pdf->SetFont('freesans', '',13);

$pdf->SetX(50,);
$pdf->Cell(0, 10,"Depositor", 0, 0, 'C');
$pdf->SetXY(100,120);
$lineThickness = 0.1;

$lineColor = array(0, 0, 0);
$pageWidth = $pdf->getPageWidth();
$pageHeight = $pdf->getPageHeight();
$centerX = 135;
$centerY = 227;
$lineLength =50;


$pdf->SetXY(10,227); //

$pdf->SetXY(50,120); //
$pdf->SetFont('freesans', '',10);
$pdf->Cell(0,10,"Depositor's Signature :",0,1,'C');
$pdf->SetXY(35,237); 

$pdf->Output('mypdf.pdf','I');
?>