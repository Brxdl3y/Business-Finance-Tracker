<?php
require('config/fpdf.php'); // Include FPDF

// Create a new PDF instance
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Title
$pdf->Cell(190, 10, 'Income & Expense Report', 1, 1, 'C');

// Database Connection
include_once 'config/Database.php';
$database = new Database();
$conn = $database->getConnection();

// Fetch Income Data
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(190, 10, 'Income Details', 0, 1, 'L');

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 10, 'Amount', 1);
$pdf->Cell(50, 10, 'Category', 1);
$pdf->Cell(40, 10, 'Date', 1);
$pdf->Ln();

$query = "SELECT amount, category_id, date FROM expense_income";
$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    $pdf->Cell(40, 10, $row['amount'], 1);
    $pdf->Cell(50, 10, $row['category_id'], 1);
    $pdf->Cell(40, 10, $row['date'], 1);
    $pdf->Ln();
}

// Fetch Expense Data
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(190, 10, 'Expense Details', 0, 1, 'L');

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 10, 'Amount', 1);
$pdf->Cell(50, 10, 'Category', 1);
$pdf->Cell(40, 10, 'Date', 1);
$pdf->Ln();

$query = "SELECT amount, category_id, date FROM expense_expense";
$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    $pdf->Cell(40, 10, $row['amount'], 1);
    $pdf->Cell(50, 10, $row['category_id'], 1);
    $pdf->Cell(40, 10, $row['date'], 1);
    $pdf->Ln();
}

// Output PDF
$pdf->Output('D', 'Income_Expense_Report.pdf');
?>
