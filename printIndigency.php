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
                <a href="residents.php" class="active">Residents Info</a>
                <a href="blotter.php">Blotter Records</a>
                <a href="clearance.php">Clearances</a>
                <a href="permit.php">Permits</a>
                <span></span>

                <span>Quick Link</span>
                <a href="index.php">Home Page</a>
                <a href="https://www.facebook.com/profile.php?id=100064518436649">Facebook Page</a>
            </div>
        </nav>
        <div class="main-body">
            <div class="promo_card">
                <h1>Indigency Details</h1>
            </div>

            <div class="list">
                <div class="list1">
                    <div class="row">
                        <a href="residents.php">Back</a>
                    </div>


                    <div class="wrapper">
                        <form action="" method="post">
                            <?php

                            ?>
                            <label for="for1">Walang kakayahang suportahan ang gastusin sa kanyang:</label>
                            <input type="text" id="for1" name="for1" required>

                            <label for="for2">Pinagkaloob sa may kahilingan upang magamit sa kanyang:</label>
                            <input type="text" id="for2" name="for2" required>

                            <div class="submit">
                                <input type="submit" value="Print" name="save">
                            </div>
                        </form>

                        <?php

                        if (isset($_POST['save'])) {
                            $for1 = strtolower($_POST['for1']);
                            $for2 = $_POST['for2'];
                            if (isset($_GET['rID'])) {
                                $rID = $_GET['rID'];
                            }

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
                            AddImage($pdf, 'assets/images/indigency.jpg', 0, 0);

                            include_once 'config.php';
                            $sql = "SELECT * FROM tblResidents WHERE rID = $rID";
                            $result = mysqli_query($conn, $sql);
                            $data = mysqli_fetch_assoc($result);

                            if ($data['rSuffix'] == "N/A") {
                                $rName = $data['rFirst'] . " " . $data['rLast'];
                            } else {
                                $rName = $data['rFirst'] . " " . $data['rLast'] . " " . $data['rSuffix'];
                            }

                            if ($data['rHouse'] == "N/A") {
                                $rHouse = "";
                            } else {
                                $rHouse = $data['rHouse'] . ", " ;
                            }

                            $rAdd = $rHouse. $data['rPurok'] . ", Sampaloc, San Rafael, Bulacan";
                            $rGender = $data['rGender'];
                            $rAge = $data['rAge'];
                            $rCivil = $data['rCivil'];
                            $rBday = $data['rBday'];
                            $rBplace = $data['rBplace'];
                            $rContact = $data['rContact'];
                            $rEmail = $data['rEmail'];


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

                            AddText($pdf, ucwords($rName), 105, 86.5, 'C', 'times', 'B', 11, 6, 12, 000);
                            AddText($pdf, ucwords($rAdd), 87.5, 91.5, 'C', 'times', 'B', 11, 6, 12, 000);
                            AddText($pdf, ucwords($rAge), 185, 86.5, 'C', 'times', 'B', 11, 6, 12, 000);

                            AddText($pdf, ucwords(date('j')), 33.5, 141.5, 'C', 'times', 'B', 11, 6, 12, 000);
                            AddText($pdf, ucwords($month), 76.5, 141.5, 'C', 'times', 'B', 11, 6, 12, 000);
                            AddText($pdf, ucwords(date('Y')), 138.5, 141.5, 'C', 'times', 'B', 11, 6, 12, 000);

                            AddText($pdf, ucwords($rName), -232, 185.5, 'C', 'times', 'B', 11, 6, 12, 000);
                            AddText($pdf, ucwords($for1), 35, 116.5, 'C', 'times', 'B', 11, 6, 12, 000);
                            AddText($pdf, ucwords($for2 ), -210.5, 156.5, 'C', 'times', 'B', 11, 6, 12, 000);
                            ob_end_clean();
                            $pdf->Output();

                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>