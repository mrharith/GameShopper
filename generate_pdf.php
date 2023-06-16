<?php
//include connection file 
include_once('./libs/fpdf/fpdf.php');

class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // Logo
        $this->Image('./image/logo.png', 15, 8, 70);
        $this->SetFont('Arial', 'B', 13);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(80, 10, 'Sales Report', 1, 0, 'C');
        // Line break
        $this->Ln(20);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

// $db = new dbObj();
// $connString =  $db->getConnstring();
$conn = mysqli_connect("localhost", "root", "", "gameshopper");
$display_heading = array('order_id' => 'Order ID', 'order_status' => 'Order Status', 'payment_method' => 'Payment Method', 'order_total_price' => 'Total Price(MYR)', 'tracking_number' => 'Tracking Number','customer_id' => 'Customer ID',);

$result = mysqli_query($conn, "SELECT order_id, order_total_price, order_status, payment_method,  tracking_number, customer_id FROM `order`") or die("database error:" . mysqli_error($conn));
$header = mysqli_query($conn, "SHOW columns FROM `order`");

$subtotal = "SELECT sum(order_total_price) as totalprice FROM `order`";
$subtotalres = mysqli_query($conn,$subtotal);
$subtotalrow = mysqli_fetch_assoc($subtotalres);

$pdf = new PDF('L','mm','A4');
//header
$pdf->AddPage();
//foter page
$pdf->AliasNbPages();
$pdf->SetFont('Arial', '', 12);
foreach ($header as $heading) {
    $pdf->Cell(45, 12, $display_heading[$heading['Field']], 1);
}
foreach ($result as $row) {
    $pdf->Ln();
    foreach ($row as $column)
        $pdf->Cell(45, 12, $column, 1);
}

$pdf->Ln();
$pdf->Cell(45,12,'Subtotal',1);
$pdf->Cell(45, 12, $subtotalrow['totalprice'], 1);

$pdf->Output();