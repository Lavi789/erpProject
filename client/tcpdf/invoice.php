<?php
require_once('tcpdf/tcpdf.php');
// require_once '../api/config/db.php';
// $ID=$_REQUEST['id'];
// $sql = "";
// $data=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
$pdf = new TCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);



 
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(true);
$pdf->SetAutoPageBreak(false, 0);
$pdf->AddPage('P'); // Set landscape orientation


$border = 1;
$padding = 10;
$pageWidth = $pdf->getPageWidth();
$pageHeight = $pdf->getPageHeight();
$usableWidth = $pageWidth - 2 * $padding;
$usableHeight = $pageHeight - 2 * $padding;
$x = $padding;
$y = $padding;
$pdf->SetFillColor(252, 252, 252

); // R, G, B values
$pdf->Rect($x, $y, $usableWidth, $usableHeight, 'F');
$pdf->Rect($x, $y, $usableWidth, $usableHeight, 'D', array('all' => $border));
$logo= <<<EOD
<table>
<thead>
<tr>
<th><img src="img/hindalco.png" width="80" height="60"/></th>
</tr>
</thead>
</table>
EOD;
$pdf->SetXY(15,12);
$pdf->writeHTML($logo,true,false,false,false,'');
$pdf->SetXY(10,10);
$pdf->Cell(190, 30, "",1);

$pdf->SetXY(15,12);
$pdf->SetFont('freesans', 'B',15);
$pdf->Cell(0, 10,"HINDALCO CO-OPERATIVE SOCIETY", 0, 0, 'C');
$pdf->SetXY(30,18);


$pdf->SetXY(15,25);
$pdf->SetFont('freesans', 'B',15);
$pdf->Cell(0, 10,"INVOICE", 0, 0, 'C');
$pdf->SetXY(30,18);








// $pdf->Line(145, 10, 145,139);
// $pdf->SetXY(150,10);
// $pdf->SetFont('freesans', 'B',8);
// $pdf->MultiCell(50, 5,"  For Terms and Conditions  And  \n  Applicable Laws are Given below   ", 0, 0, 'R');


$pdf->SetXY(10,50);
$pdf->Cell(0, 10,"Invoice Number: ", 0, 0, 'L');
$pdf->SetXY(10,58);
$pdf->SetFont('freesans', 'B',10);
$pdf->SetXY(10,60);
$pdf->Cell(0, 10,"Invoice Date: ", 0, 0, 'L');
$pdf->SetXY(20,65);
$pdf->SetFont('freesans', 'B',10);

$pdf->SetXY(10,70);
$pdf->Cell(0, 10,"Item Receive Date: ", 0, 0, 'L');
$pdf->SetXY(20,65);
$pdf->SetFont('freesans', 'B',10);


$pdf->SetXY(80,50);
$pdf->Cell(0, 10,"Supplier Name: ", 0, 0, 'C');
$pdf->SetXY(20,65);
$pdf->SetFont('freesans', 'B',10);

// $pdf->Cell(0, 10,"Payment Mode:", 0, 0, 'L');
// $pdf->SetXY(10,55);

// $pdf->Cell(0,10,"Date:",0,1,'C');



// $pdf->SetXY(10,74);
// $pdf->SetFont('freesans', '',10);
// $pdf->Cell(0,9,"Remarks:",0,1,"L");
// // $pdf->Line(10,73,200,73);
// // $pdf->Line(10,82,200,82);

// $pdf->SetXY(10,110);
// $pdf->SetFont('freesans', '',10);

// // $pdf->Line(10,90,145,90);
// $pdf->SetXY(10,83);
// $pdf->SetFont('freesans', '',10);
// $pdf->Cell(0,9,"Shead No. :",0,1,'L');

$pdf->SetXY(10,150);
$pdf->Cell(20, 7, "Batch NO. ",1);
$pdf->Cell(35, 7," Quantity Devilered",1);
$pdf->Cell(30, 7, "Purchase Rate",1);
$pdf->Cell(20, 7, "Amount",1);
$pdf->Cell(15, 7, "Gst Amt",1);
$pdf->Cell(15, 7, "Net Amt",1);
$pdf->Cell(15, 7, "Free qty",1);
$pdf->Cell(20, 7, "Disc %",1);
$pdf->Cell(20, 7, "HSN Code",1);


$pdf->SetXY(10,157);
$pdf->Cell(20, 25, "",1);
$pdf->Cell(35, 25,"",1);
$pdf->Cell(30, 25, "",1);
$pdf->Cell(20, 25,"",1);
$pdf->Cell(15, 25,"",1);
$pdf->Cell(15, 25,"",1);
$pdf->Cell(15, 25,"",1);
$pdf->Cell(20, 25,"",1);
$pdf->Cell(20, 25,"",1);
$pdf->SetXY(10,145);
$pdf->SetFont('freesans', '',13);

$pdf->SetX(10,);
$pdf->Cell(0, 100,"Total Amount", 0, 0, 'L');
$pdf->SetX(10,);
$pdf->Cell(0, 120,"Total Discount", 0, 0, 'L');
$pdf->SetX(10,);
$pdf->Cell(0, 140,"Net Payable", 0, 0, 'L');
$pdf->SetX(10,);
$pdf->Cell(0, 160,"GST Amount", 0, 0, 'L');
$pdf->SetXY(100,120);
$lineThickness = 0.1;

$lineColor = array(0, 0, 0);
$pageWidth = $pdf->getPageWidth();
$pageHeight = $pdf->getPageHeight();
$centerX = 135;
$centerY = 227;
$lineLength =50;


$pdf->SetXY(10,227); //

$pdf->SetXY(80,275); //
$pdf->SetFont('freesans', '',10);
$pdf->Cell(0,10,"Signature :",0,1,'C');
$pdf->SetXY(35,237); 


$pdf->SetXY(20,275); //
$pdf->SetFont('freesans', '',10);
$pdf->Cell(0,10,"Date :",0,1,'L');
$pdf->SetXY(35,237); 

$pdf->Output('mypdf.pdf','I');
?>