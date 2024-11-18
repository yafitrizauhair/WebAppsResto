<?php
require_once("tcpdf/tcpdf.php");
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Respati 1');
$pdf->setTitle('Data Penjualan');
$pdf->setSubject('Data Penjualan');
$pdf->setKeywords('Data Penjualan');

$pdf->setFont('times', '', 12, '', true);

$pdf->AddPage();

$html = file_get_contents("http://localhost:8080/restoran/table.php");

$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('Data Penjualan.pdf', 'I');