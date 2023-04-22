<?php
require('./fpdf/fpdf.php');
date_default_timezone_set('Asia/Manila');
$name_file = 'Barangay-Blotter-List_' . (date('d-m-Y-H:i:s')) . '.pdf';

class PDF extends FPDF
{
    function Header()
    {
        $this->Image('assets/images/bLogo.png', 110, 5, 20);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(135);
        $this->Cell(30, 10, 'Barangay Blotter List', 0, 0, 'C');
        $this->Ln(20);

        $this->Cell(15, 10, 'ID', 1, 0, 'C', 0);
        $this->Cell(35, 10, 'Date Recorded', 1, 0, 'C', 0);
        $this->Cell(35, 10, 'Date of Incident', 1, 0, 'C', 0);
        $this->Cell(45, 10, 'Complainant', 1, 0, 'C', 0);
        $this->Cell(50, 10, 'Location', 1, 0, 'C', 0);
        $this->Cell(45, 10, 'Person to Complain', 1, 0, 'C', 0);
        $this->Cell(30, 10, 'Reason', 1, 0, 'C', 0);
        $this->Cell(25, 10, 'Status', 1, 1, 'C', 0);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

$pdf = new PDF('L', 'mm', 'A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 10);

include_once 'config.php';
$sql = "SELECT * FROM tblresidents INNER JOIN tblaccess ON 
tblresidents.aID=tblaccess.aID INNER JOIN tblblotter ON
tblblotter.bComp=tblaccess.aID";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);


if ($resultCheck > 0) {
    while ($data = mysqli_fetch_array($result)) {

        $bID = $data['bID'];
        $bDateR = $data['bDateR'];
        $bDateI = $data['bDateI'];

        if ($data['rSuffix'] == "N/A") {
            $bComp = $data['rFirst'] . " " . $data['rLast'];
        } else {
            $bComp = $data['rFirst'] . " " . $data['rLast'] . " " . $data['rSuffix'];
        }

        $bLoc = $data['bLoc'];

        if ($data['rSuffix'] == "N/A") {
            $bPers = $data['rFirst'] . " " . $data['rLast'];
        } else {
            $bPers = $data['rFirst'] . " " . $data['rLast'] . " " . $data['rSuffix'];
        }
        $bReason = $data['bReason'];
        $bStatus = $data['bStatus'];

        $pdf->Cell(15, 10, $bID, 1, 0, 'C', 0);
        $pdf->Cell(35, 10, ($bDateR), 1, 0, 'C', 0);
        $pdf->Cell(35, 10, ($bDateI), 1, 0, 'C', 0);
        $pdf->Cell(45, 10, ($bComp), 1, 0, 'C', 0);
        $pdf->Cell(50, 10, ($bLoc), 1, 0, 'C', 0);
        $pdf->Cell(45, 10, $bPers, 1, 0, 'C', 0);
        $pdf->Cell(30, 10, $bReason, 1, 0, 'C', 0);
        $pdf->Cell(25, 10, $bStatus, 1, 1, 'C', 0);
    }
}

$pdf->Output('I', $name_file);
?>*/