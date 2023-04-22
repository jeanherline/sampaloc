<?php
require('./fpdf/fpdf.php');
date_default_timezone_set('Asia/Manila');
$name_file = 'Barangay-Permit-List_' . (date('d-m-Y-H:i:s')) . '.pdf';

class PDF extends FPDF
{
    function Header()
    {
        $this->Image('assets/images/bLogo.png', 120, 7, 15);
        $this->SetFont('Arial', 'B', 9.5);
        $this->Cell(135);
        $this->Cell(25, 10, 'Barangay Permit List', 0, 0, 'C');
        $this->Ln(20);

        $this->Cell(20, 10, 'Permit #', 1, 0, 'C', 0);
        $this->Cell(40, 10, 'R. Name', 1, 0, 'C', 0);
        $this->Cell(35, 10, 'B. Name', 1, 0, 'C', 0);
        $this->Cell(60, 10, 'B. Address', 1, 0, 'C', 0);
        $this->Cell(30.5, 10, 'B. Type', 1, 0, 'C', 0);
        $this->Cell(27, 10, 'OR Number', 1, 0, 'C', 0);
        $this->Cell(15, 10, 'Amount', 1, 0, 'C', 0);
        $this->Cell(15, 10, 'Status', 1, 0, 'C', 0);
        $this->Cell(35, 10, 'Date and Time', 1, 1, 'C', 0);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 9.5);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

$pdf = new PDF('L', 'mm', 'A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', );

include_once 'config.php';
$sql = "SELECT * FROM tblResidents INNER JOIN tblAccess ON 
tblResidents.aID=tblAccess.aID INNER JOIN tblPermit ON
tblPermit.aID=tblAccess.aID";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);

if ($resultCheck > 0) {
    while ($data = mysqli_fetch_array($result)) {

        $pStatus = $data['pStatus'];
        $pStamp = $data['pStamp'];
        $pBName = $data['pBName'];
        $pBName = html_entity_decode($data['pBName']);
        $pBAdd = $data['pBAdd'];
        $pBType = $data['pBType'];

        if (empty($data['pNum'])) {
            $pNum = "N/A";
        } else {
            $pNum = $data['pNum'];
        }

        if (empty($data['pFindings'])) {
            $pFindings = "N/A";
        } else {
            $pFindings = $data['pFindings'];
        }

        if (empty($data['pOR'])) {
            $pOR = "N/A";
        } else {
            $pOR = $data['pOR'];
        }

        if (empty($data['pAmount'])) {
            $pAmount = "N/A";
        } else {
            $pAmount = $data['pAmount'];
        }

        if ($data['rSuffix'] == "N/A") {
            $pName = $data['rFirst'] . " " . $data['rLast'];
        } else {
            $pName = $data['rFirst'] . " " . $data['rLast'] . " " . $data['rSuffix'];
        }

        $pdf->Cell(20, 10, ($pNum), 1, 0, 'C', 0);
        $pdf->Cell(40, 10, ($pName), 1, 0, 'C', 0);
        $pdf->Cell(35, 10, $pBName, 1, 0, 'C', 0);
        $pdf->Cell(60, 10, $pBAdd, 1, 0, 'C', 0);
        $pdf->Cell(30.5, 10, $pBType, 1, 0, 'C', 0);
        $pdf->Cell(27, 10, $pOR, 1, 0, 'C', 0);
        $pdf->Cell(15, 10, $pAmount, 1, 0, 'C', 0);
        $pdf->Cell(15, 10, $pStatus, 1, 0, 'C', 0);
        $pdf->Cell(35, 10, $pStamp, 1, 1, 'C', 0);
    }
}

$pdf->Output('I', $name_file);
?>*/