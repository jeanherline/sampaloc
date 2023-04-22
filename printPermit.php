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
                <a href="clearance.php">Clearances</a>
                <a href="permit.php" class="active">Permits</a>
                <span></span>

                <span>Quick Link</span>
                <a href="index.php">Home Page</a>
                <a href="https://www.facebook.com/profile.php?id=100064518436649">Facebook Page</a>
            </div>
        </nav>
        <div class="main-body">
            <div class="promo_card">
                <h1>Permit Details</h1>
            </div>

            <div class="list">
                <div class="list1">
                    <div class="row">
                        <a href="permit.php">Back</a>
                    </div>

                    <div class="wrapper">
                        <form action="" method="post">

                            <?php
                            if (isset($_GET['pID'])) {
                                $pID = $_GET['pID'];
                            }

                            include_once 'config.php';
                            $sql = "SELECT * FROM tblPermit WHERE pID = '$pID'";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);

                            if (empty($row['pAmount'])) {
                                $pAmount = "N/A";
                            } else {
                                $pAmount = $row['pAmount'];
                            }
                            if (empty($row['pOR'])) {
                                $pOR = "N/A";
                            } else {
                                $pOR = $row['pOR'];
                            }
                            if (empty($row['pNum'])) {
                                $pNum = "N/A";
                            } else {
                                $pNum = $row['pNum'];
                            }

                            $pBName = $row['pBName'];
                            $pBAdd = $row['pBAdd'];
                            $pBType = $row['pBType'];

                            $number = 1;
                            $number = sprintf('%03d', $number);
                            $pNum = date('Y') . "-" . $number;
                            ?>

                            <label for="pNum">Permit Control Number</label>
                            <input type="text" id="pNum" name="pNum" value="<?= $pNum ?>"> <br>

                            <label for="pBName">Business Name</label>
                            <input type="text" id="pBName" name="pBName" value="<?= $pBName; ?>"><br>

                            <label for="pBType">Type</label>
                            <input type="text" id="pBType" name="pBType" value="<?= $pBType; ?>">

                            <label for="pAmount">Amount</label><br>
                            <input type="number" id="pAmount" name="pAmount" value="<?= $pAmount; ?>" required>

                            <label for="pOR">OR Number</label>
                            <input type="text" id="pOR" name="pOR" value="<?= $pOR; ?>">

                            <div class="submit">
                                <input type="submit" value="Print" name="save">
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['save'])) {
                            $control = $_POST['pNum'];
                            $pBName = addslashes($_POST['pBName']);
                            //$pBAdd = $_POST['pBAdd'];
                            $pBType = $_POST['pBType'];
                            $pOR = $_POST['pOR'];
                            $pAmount = $_POST['pAmount'];

                            $sql = "UPDATE tblpermit SET pNum = '$control', pBName = '$pBName',
                            pBType = '$pBType', pOR = '$pOR', pAmount = '$pAmount' WHERE pID = '$pID'";
                            $result = mysqli_query($conn, $sql);
                            function AddText($pdf, $text, $x, $y, $a, $f, $t, $s, $r, $g, $b)
                            {
                                $pdf->SetFont($f, $t, $s);
                                $pdf->SetXY($x, $y);
                                $pdf->SetTextColor(000);
                                $pdf->Cell(0, 10, $text, 0, 0, $a);
                            }

                            function AddImage($pdf, $imgname, $x, $y)
                            {
                                $pdf->Image($imgname, $x, $y, 221);
                            }

                            function ordinal($number)
                            {
                                $ends = array('th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th');
                                if ((($number % 100) >= 11) && (($number % 100) <= 13))
                                    return $number . 'th';
                                else
                                    return $number . $ends[$number % 10];
                            }

                            require('./fpdf/fpdf.php');

                            $pdf = new FPDF('P', 'mm', array(215.9, 279.4));
                            $pdf->AddPage();
                            $pdf->SetFont('times', 'B', 16);
                            $pdf->SetCreator('Haneef Puttur');
                            AddImage($pdf, 'assets/images/permit.jpg', 0, 0);

                            $sql = "SELECT * FROM tblResidents INNER JOIN tblAccess ON 
                            tblResidents.aID=tblAccess.aID INNER JOIN tblPermit ON
                            tblPermit.aID=tblAccess.aID WHERE tblPermit.pID = '$pID'";
                            $result = mysqli_query($conn, $sql);
                            $data = mysqli_fetch_assoc($result);

                            $rCedula = $data['rCedula'];
                            $pBName = $data['pBName'];
                            $pBType = $data['pBType'];
                            $rAdd = $data['rPurok'] . ", Sampaloc, San Rafael, Bulacan";

                            if (empty($data['pAmount'])) {
                                $pAmount = "N/A";
                            } else {
                                $pAmount = $data['pAmount'];
                            }
                            if (empty($data['pOR'])) {
                                $pOR = "N/A";
                            } else {
                                $pOR = $data['pOR'];
                            }
                            if (empty($data['pNum'])) {
                                $pNum = "N/A";
                            } else {
                                $pNum = $data['pNum'];
                            }
                            if ($data['rSuffix'] == "N/A") {
                                $pName = $data['rFirst'] . " " . $data['rLast'];
                            } else {
                                $pName = $data['rFirst'] . " " . $data['rLast'] . " " . $data['rSuffix'];
                            }

                            $today = date('F j') . ", " . date('Y');
                            $year = date('Y');
                            $yearEnd = "December 31, " . $year;
                            $day = ordinal(date('j'));

                            AddText($pdf, ucwords($pName), 165, 87.5, 'C', 'times', 'B', 11, 6, 12, 000);
                            AddText($pdf, ucwords($rAdd), -190.5, 92.5, 'C', 'times', 'B', 11, 6, 12, 000);
                            AddText($pdf, ucwords($pBType), -240, 97.5, 'C', 'times', 'B', 11, 6, 12, 000);
                            AddText($pdf, ucwords($pBName), 182.5, 97.5, 'C', 'times', 'B', 11, 6, 12, 000);
                            AddText($pdf, ucwords($today), -133.5, 102.5, 'C', 'times', 'B', 11, 6, 12, 000);
                            AddText($pdf, ucwords($yearEnd), -40.5, 102.5, 'C', 'times', 'B', 11, 6, 12, 000);

                            AddText($pdf, ucwords($day), -222.5, 139.5, 'C', 'times', 'B', 11, 6, 12, 000);
                            AddText($pdf, ucwords(date('F')), -157.5, 139.5, 'C', 'times', 'B', 11, 6, 12, 000);
                            AddText($pdf, ucwords($year), -96.5, 139.5, 'C', 'times', 'B', 11, 6, 12, 000);

                            AddText($pdf, ucwords($pName), -219, 163.5, 'C', 'times', 'B', 11, 6, 12, 000);
                            AddText($pdf, ucwords($rCedula), -250, 178, 'C', 'times', 'B', 11, 6, 12, 000);
                            AddText($pdf, ucwords($today), -226.8, 182.8, 'C', 'times', 'B', 11, 6, 12, 000);
                            AddText($pdf, ucwords("San Rafael, Bulacan"), -223.5, 187.5, 'C', 'times', 'B', 11, 6, 12, 000);
                            AddText($pdf, ucwords($pNum), -148.8, 196.5, 'C', 'times', 'B', 11, 6, 12, 000);
                            AddText($pdf, ucwords("P" . $pAmount . ".00"), -245.5, 205.5, 'C', 'times', 'B', 11, 6, 12, 000);
                            AddText($pdf, ucwords($pOR), -206.5, 210.5, 'C', 'times', 'B', 11, 6, 12, 000);
                            AddText($pdf, ucwords($today), -222.8, 219.5, 'C', 'times', 'B', 11, 6, 12, 000);
                            ob_end_clean();

                            $name_file = 'Barangay-Business-Permit_' . $pName . "_" . ($pNum) . '.pdf';
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