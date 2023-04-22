<?php
require('./fpdf/fpdf.php');
date_default_timezone_set('Asia/Manila');
$name_file = 'Barangay-Clearance-List_' . (date('d-m-Y-H:i:s')) . '.pdf';

class PDF extends FPDF
{
    function Header()
    {
        $this->Image('assets/images/bLogo.png', 110, 5, 20);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(135);
        $this->Cell(30, 10, 'Barangay Clearance List', 0, 0, 'C');
        $this->Ln(20);
        $this->Cell(25, 10, 'Clearance #', 1, 0, 'C', 0);
        $this->Cell(50, 10, 'Resident Name', 1, 0, 'C', 0);
        $this->Cell(65, 10, 'Findings', 1, 0, 'C', 0);
        $this->Cell(30, 10, 'Purpose', 1, 0, 'C', 0);
        $this->Cell(27, 10, 'OR #', 1, 0, 'C', 0);
        $this->Cell(20, 10, 'Amount', 1, 0, 'C', 0);
        $this->Cell(20, 10, 'Status', 1, 0, 'C', 0);
        $this->Cell(40, 10, 'Date and Time', 1, 1, 'C', 0);
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
$pdf->SetFont('Times', '', 9);

include_once 'config.php';
$sql = "SELECT * FROM tblResidents INNER JOIN tblAccess ON 
tblResidents.aID=tblAccess.aID INNER JOIN tblClearance ON
tblClearance.aID=tblAccess.aID";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);


if ($resultCheck > 0) {
    while ($data = mysqli_fetch_array($result)) {

        $cPurpose = $data['cPurpose'];
        $cStatus = $data['cStatus'];
        $cStamp = $data['cStamp'];

        if (empty($data['cNum'])) {
            $cNum = "N/A";
        } else {
            $cNum = $data['cNum'];
        }

        if (empty($data['cFindings'])) {
            $cNum = "N/A";
        } else {
            $cFindings = $data['cFindings'];
        }

        if (empty($data['cOR'])) {
            $cOR = "N/A";
        } else {
            $cOR = $data['cOR'];
        }

        if (empty($data['cAmount'])) {
            $cAmount = "N/A";
        } else {
            $cAmount = $data['cAmount'];
        }

        if ($data['rSuffix'] == "N/A") {
            $cName = $data['rFirst'] . " " . $data['rLast'];
        } else {
            $cName = $data['rFirst'] . " " . $data['rLast'] . " " . $data['rSuffix'];
        }

        $pdf->Cell(25, 10, ($cNum), 1, 0, 'C', 0);
        $pdf->Cell(50, 10, ($cName), 1, 0, 'C', 0);
        $pdf->Cell(65, 10, ($cFindings), 1, 0, 'C', 0);
        $pdf->Cell(30, 10, ($cPurpose), 1, 0, 'C', 0);
        $pdf->Cell(27, 10, $cOR, 1, 0, 'C', 0);
        $pdf->Cell(20, 10, $cAmount, 1, 0, 'C', 0);
        $pdf->Cell(20, 10, $cStatus, 1, 0, 'C', 0);
        $pdf->Cell(40, 10, $cStamp, 1, 1, 'C', 0);
    }
}

$pdf->Output('I', $name_file);
?>*/