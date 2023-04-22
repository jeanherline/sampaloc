<?php
require('./fpdf/fpdf.php');
date_default_timezone_set('Asia/Manila');
$name_file = 'Barangay-Officials-List_' . (date('d-m-Y-H:i:s')) . '.pdf';

class PDF extends FPDF
{
    function Header()
    {
        $this->Image('assets/images/bLogo.png', 110, 5, 20);
        $this->SetFont('Arial', 'B', 13);
        $this->Cell(135);
        $this->Cell(30, 10, 'Barangay Officials List', 0, 0, 'C');
        $this->Ln(20);

        $this->Cell(30, 10, 'Position', 1, 0, 'C', 0);
        $this->Cell(45, 10, 'Name', 1, 0, 'C', 0);
        $this->Cell(45, 10, 'Contact Number', 1, 0, 'C', 0);
        $this->Cell(95, 10, 'Address', 1, 0, 'C', 0);
        $this->Cell(35, 10, 'Start of Term', 1, 0, 'C', 0);
        $this->Cell(30, 10, 'End of Term', 1, 1, 'C', 0);
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
$pdf->SetFont('Times', '', 12);

include_once 'config.php';
$sql = "SELECT * FROM tblofficials INNER JOIN tblaccess ON
tblaccess.aID=tblofficials.aID INNER JOIN tblresidents ON
tblaccess.aID=tblresidents.aID";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);




if ($resultCheck > 0) {
    while ($data = mysqli_fetch_array($result)) {

        $posi = $data['aType'];
        if ($data['rSuffix'] == "N/A") {
            $offName = $data['rFirst'] . " " . $data['rLast'];
        } else {
            $offName = $data['rFirst'] . " " . $data['rLast'] . " " . $data['rSuffix'];
        }
        $add = $data['rHouse'] . ", " . $data['rPurok'] . ", Sampaloc, San Rafael, Bulacan";
        $endOfTerm = $data['oTermE'];
        $startOfTerm = $data['oTermS'];
        $contact = $data['rContact'];

        $pdf->Cell(30, 10, $posi, 1, 0, 'C', 0);
        $pdf->Cell(45, 10, ($offName), 1, 0, 'C', 0);
        $pdf->Cell(45, 10, ($contact), 1, 0, 'C', 0);
        $pdf->Cell(95, 10, ($add), 1, 0, 'C', 0);
        $pdf->Cell(35, 10, $startOfTerm, 1, 0, 'C', 0);
        $pdf->Cell(30, 10, $endOfTerm, 1, 1, 'C', 0);
    }
}

$pdf->Output('I', $name_file);
?>*/