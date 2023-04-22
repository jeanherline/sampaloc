<?php
require('secure.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Edit Clearance</title>
    <link rel="stylesheet" href="assets/css/form.css" />
    <link rel="icon" href="assets/images/bLogo.png" type="image/icon type" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />

</head>

<body>
    <header class="header">
        <div class="logo">
            <img src="assets/images/bLogo.png" alt="">
            <a>Barangay Sampaloc</a>
        </div>

        <div class="header-icons">
            <div class="account">
                <img src="assets/images/user.png" alt="">
            </div>
            <br>
            <div class="dropdown">
                <h4>&nbsp
                    <?php
                    echo $_SESSION['role'];
                    ?>
                </h4>
                <div class="dropdown-content">
                    <a href="account.php">Account</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>

    </header>
    <div class="container">
        <nav>
            <div class="side_navbar">
                <span>Main Menu</span>
                <a href="officials.php">Brgy. Officials</a>
                <a href="residents.php">Residents Info</a>
                <a href="blotter.php">Blotter Records</a>
                <a href="clearance.php" class="active">Clearances</a>
                <a href="permit.php">Permits</a>
                <span></span>

                <span>Quick Link</span>
                <a href="index.php">Home Page</a>
                <a href="https://www.facebook.com/profile.php?id=100064518436649">Facebook Page</a>
            </div>
        </nav>
        <div class="main-body">
            <div class="promo_card">
                <h1>Clearance Details</h1>
            </div>

            <div class="list">
                <div class="list1">
                    <div class="row">
                        <a href="clearance.php">Back</a>
                    </div>


                    <div class="wrapper">
                        <form action="" method="post">

                            <?php
                            if (isset($_GET['cID'])) {
                                $cID = $_GET['cID'];
                            }
                            include_once 'config.php';
                            $sql = "SELECT * FROM tblResidents INNER JOIN tblAccess ON 
                            tblResidents.aID=tblAccess.aID INNER JOIN tblClearance ON
                            tblClearance.aID=tblAccess.aID WHERE tblClearance.cID = '$cID'";
                            $result = mysqli_query($conn, $sql);
                            $data = mysqli_fetch_assoc($result);

                            if (empty($data['cNum'])) {
                                $cNum = "N/A";
                            } else {
                                $cNum = $data['cNum'];
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
                            if (empty($data['cPurpose'])) {
                                $cPurpose = "N/A";
                            } else {
                                $cPurpose = $data['cPurpose'];
                            }

                            $number = 1;
                            $number = sprintf('%03d', $number);
                            $cNum = date('Y') . "-" . $number;
                            ?>

                            <!--<label for="for1">Edit Start Number</label>
                            <input type="text" id="for1" name="for1" value=""> -->

                            <label for="cNum">Clearance Control Number</label>
                            <input type="text" id="cNum" name="cNum" value="<?= $cNum ?>"> <br>

                            <label for="cOR">OR Number</label>
                            <input type="text" id="cOR" name="cOR" value="<?= $cOR; ?>">

                            <br>
                            <label for="cPurpose">Purpose</label><br>
                            <select name="cPurpose" id="cPurpose" required>
                                <option value="<?= $cPurpose ?>" selected hidden><?= $cPurpose ?></option>
                                <option value="Legal">Legal</option>
                                <option value="Loan">Loan</option>
                            </select>

                            <div class="submit">
                                <input type="submit" value="Print" name="save">
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['save'])) {
                            $control = $_POST['cNum'];
                            $or = $_POST['cOR'];
                            $cPurpose = $_POST['cPurpose'];
                            if ($cPurpose == "Legal") {
                                $fee = "25";
                            } else if ($cPurpose == "Loan") {
                                $fee = "50";

                            }
                            $sql = "UPDATE tblClearance SET cPurpose = '$cPurpose', cNum = '$control', cOR = '$or', cAmount = '$fee' WHERE cID = '$cID'";
                            $result = mysqli_query($conn, $sql);

                            //$name = text to be added, $x= x cordinate, $y = y coordinate, 
                            //$a = alignment , $f= Font Name, $t = Bold / Italic, $s = Font Size, 
                            //$r = Red, $g = Green Font color, $b = Blue Font Color
                            function AddText($pdf, $text, $x, $y, $a, $f, $t, $s, $r, $g, $b)
                            {
                                $pdf->SetFont($f, $t, $s);
                                $pdf->SetXY($x, $y);
                                $pdf->SetTextColor(000);
                                $pdf->Cell(0, 10, $text, 0, 0, $a);
                            }

                            //$imgname = image file name , $x= x cordinate, $y = y coordinate
                            function AddImage($pdf, $imgname, $x, $y)
                            {
                                $pdf->Image($imgname, $x, $y, 221);
                            }

                            require('./fpdf/fpdf.php');
                            //Create A 4 Landscape page
                            $pdf = new FPDF('P', 'mm', array(215.9, 279.4));
                            $pdf->AddPage();
                            $pdf->SetFont('times', 'B', 16);
                            $pdf->SetCreator('Haneef Puttur');
                            // Add background image for PDF
                            AddImage($pdf, 'assets/images/clearance.jpg', 0, 0);

                            $sql = "SELECT * FROM tblResidents INNER JOIN tblAccess ON 
                            tblResidents.aID=tblAccess.aID INNER JOIN tblClearance ON
                            tblClearance.aID=tblAccess.aID WHERE tblClearance.cID = '$cID'";
                            $result = mysqli_query($conn, $sql);
                            $data = mysqli_fetch_assoc($result);

                            $cPurpose = $data['cPurpose'];
                            $cStatus = $data['cStatus'];
                            $cStamp = $data['cStamp'];
                            $rAge = $data['rAge'];
                            $rResiding = $data['rResiding'];
                            $rCedula = $data['rCedula'];

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

                            $cAdd = $data['rPurok'] . ", Sampaloc, San Rafael, Bulacan";
                            $image1 = "rImages/" . $data['rImage'];

                            if (date('F') == "January") {
                                $month = "Enero";
                            } elseif (date('F') == "February") {
                                $month = "Pebrero";
                            } elseif (date('F') == "March") {
                                $month = "Marso";
                            } elseif (date('F') == "April") {
                                $month = "Abril";
                            } elseif (date('F') == "May") {
                                $month = "Mayo";
                            } elseif (date('F') == "June") {
                                $month = "Hunyo";
                            } elseif (date('F') == "July") {
                                $month = "Hulyo";
                            } elseif (date('F') == "August") {
                                $month = "Agosto";
                            } elseif (date('F') == "September") {
                                $month = "Setyembre";
                            } elseif (date('F') == "October") {
                                $month = "Oktubre";
                            } elseif (date('F') == "November") {
                                $month = "Nobyembre";
                            } elseif (date('F') == "December") {
                                $month = "Disyembre";
                            }

                            AddText($pdf, ucwords($cName), 105, 78.5, 'C', 'times', 'B', 11, 6, 12, 000);
                            AddText($pdf, ucwords($rAge), 186.5, 78.5, 'C', 'times', 'B', 11, 6, 12, 000);
                            AddText($pdf, ucwords($cAdd), 76.5, 83.5, 'C', 'times', 'B', 11, 6, 12, 000);
                            AddText($pdf, ucwords($rResiding), 190, 83.5, 'C', 'times', 'B', 11, 6, 12, 000);
                            AddText($pdf, ucwords($rCedula), -222, 123.5, 'C', 'times', 'B', 11, 6, 12, 000);
                            AddText($pdf, ucwords("San Rafael, Bulacan"), 31.5, 128.5, 'C', 'times', 'B', 11, 6, 12, 000);
                            AddText($pdf, ucwords(date('F j')) . ", " . date('Y'), -239.5, 133.5, 'C', 'times', 'B', 11, 6, 12, 000);
                            AddText($pdf, ucwords($cNum), -215.5, 143.5, 'C', 'times', 'B', 11, 6, 12, 000);
                            AddText($pdf, ucwords("P" . $cAmount . ".00"), -249.5, 153.5, 'C', 'times', 'B', 11, 6, 12, 000);
                            AddText($pdf, ucwords($cOR), -226.5, 158.5, 'C', 'times', 'B', 11, 6, 12, 000);
                            AddText($pdf, ucwords(date('F j')) . ", " . date('Y'), -235.5, 163.5, 'C', 'times', 'B', 11, 6, 12, 000);

                            AddText($pdf, ucwords(date('d')), -242.5, 183.8, 'C', 'times', 'B', 11, 6, 12, 000);
                            AddText($pdf, ucwords($month) . ", " . date('Y'), -202.5, 183.7, 'C', 'times', 'B', 11, 6, 12, 000);

                            AddText($pdf, ucwords($cName), -224.5, 210.5, 'C', 'times', 'B', 11, 6, 12, 000);
                            $pdf->Image($image1, 176.5, 133, 30, 30);
                            ob_end_clean();

                            $name_file = 'Barangay-Clearance_' . $cName . "_" . ($cNum) . '.pdf';
                            $pdf->Output('I', $name_file);
                        }
                        //$number++;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>