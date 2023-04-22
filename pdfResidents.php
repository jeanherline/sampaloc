<?php
require('./fpdf/fpdf.php');
date_default_timezone_set('Asia/Manila');
$name_file = 'Barangay-Residents-List_' . (date('d-m-Y-H:i:s')) . '.pdf';

class PDF extends FPDF
{
    function Header()
    {
        $this->Image('assets/images/bLogo.png', 125, 7, 15);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(135);
        $this->Cell(30, 10, 'Barangay Residents List', 0, 0, 'C');
        $this->Ln(20);

        $this->Cell(15, 10, 'ID', 1, 0, 'C', 0);
        $this->Cell(40, 10, 'Name', 1, 0, 'C', 0);
        $this->Cell(20, 10, 'Gender', 1, 0, 'C', 0);
        $this->Cell(15, 10, 'Age', 1, 0, 'C', 0);
        $this->Cell(15, 10, 'Status', 1, 0, 'C', 0);
        $this->Cell(20, 10, 'Birthday', 1, 0, 'C', 0);
        $this->Cell(25, 10, 'Birthplace', 1, 0, 'C', 0);
        $this->Cell(55, 10, 'Address', 1, 0, 'C', 0);
        $this->Cell(25, 10, 'Contact Number', 1, 0, 'C', 0);
        $this->Cell(45, 10, 'Email Address', 1, 1, 'C', 0);
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
$pdf->SetFont('Times', '', 8);

include_once 'config.php';
$sql = "SELECT * FROM tblResidents";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);

if ($resultCheck > 0) {
    while ($data = mysqli_fetch_array($result)) {

        $rID = $data['rID'];
        if ($data['rSuffix'] == "N/A") {
            $rName = $data['rFirst'] . " " . $data['rLast'];
        } else {
            $rName = $data['rFirst'] . " " . $data['rLast'] . " " . $data['rSuffix'];
        }
        $rAdd = $data['rHouse'] . ", " . $data['rPurok'] . ", Sampaloc, San Rafael, Bulacan";
        $rGender = $data['rGender'];
        $rAge = $data['rAge'];
        $rCivil = $data['rCivil'];
        $rBday = $data['rBday'];
        $rBplace = $data['rBplace'];
        $rContact = $data['rContact'];
        $rEmail = $data['rEmail'];

        $pdf->Cell(15, 10, $rID, 1, 0, 'C', 0);
        $pdf->Cell(40, 10, ($rName), 1, 0, 'C', 0);
        $pdf->Cell(20, 10, ($rGender), 1, 0, 'C', 0);
        $pdf->Cell(15, 10, ($rAge), 1, 0, 'C', 0);
        $pdf->Cell(15, 10, ($rCivil), 1, 0, 'C', 0);
        $pdf->Cell(20, 10, ($rBday), 1, 0, 'C', 0);
        $pdf->Cell(25, 10, ($rBplace), 1, 0, 'C', 0);
        $pdf->Cell(55, 10, $rAdd, 1, 0, 'C', 0);
        $pdf->Cell(25, 10, $rContact, 1, 0, 'C', 0);
        $pdf->Cell(45, 10, $rEmail, 1, 1, 'C', 0);
    }
}

$pdf->Output('I', $name_file);
?>*/