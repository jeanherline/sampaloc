<?php
require('secure.php');
require("EMAIL FEATURE/PHPMailer-master/src/PHPMailer.php");
require("EMAIL FEATURE/PHPMailer-master/src/SMTP.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Reject Permit</title>
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
        <?php

        if ($_SESSION['role'] == 'Secretary') {
            ?>
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
        <?php } elseif ($_SESSION['role'] == 'Chairman') {
            ?>
            <nav>
                <div class="side_navbar">
                    <span>Main Menu</span>
                    <a href="officials.php">Brgy. Officials</a>
                    <a href="residents.php">Residents Info</a>
                    <a href="clearance.php">Clearances</a>
                    <a href="permit.php" class="active">Permits</a>
                    <a href="usertype.php">User Type</a>
                    <span></span>

                    <span>Quick Link</span>
                    <a href="index.php">Home Page</a>
                    <a href="https://www.facebook.com/profile.php?id=100064518436649">Facebook Page</a>
                </div>
            </nav>
        <?php } elseif ($_SESSION['role'] == 'Kagawad') {
            ?>
            <nav>
                <div class="side_navbar">
                    <span>Main Menu</span>
                    <a href="blotter.php">Blotter Records</a>
                    <a href="clearance.php">Clearances</a>
                    <a href="permit.php" class="active">Permits</a>
                    <span></span>

                    <span>Quick Link</span>
                    <a href="index.php">Home Page</a>
                    <a href="https://www.facebook.com/profile.php?id=100064518436649">Facebook Page</a>
                </div>
            </nav>
        <?php } elseif ($_SESSION['role'] == 'Resident' or 'Restricted') {
            ?>
            <nav>
                <div class="side_navbar">
                    <span>Apply Online</span>

                    <a href="clearance.php" class="active">Clearances</a>
                    <a href="permit.php" class="active">Permits</a>
                    <a href="blotter.php">Account</a>
                    <span></span>

                    <span>Quick Link</span>
                    <a href="index.php">Home Page</a>
                    <a href="https://www.facebook.com/profile.php?id=100064518436649">Facebook Page</a>
                </div>
            </nav>
        <?php }
        ?>

        <div class="main-body">
            <div class="promo_card">
                <h1>Permit Rejection</h1>
            </div>

            <div class="list">
                <div class="list1">
                    <div class="row">
                        <a href="permit.php">Back</a>
                    </div>
                    <div class="wrapper">
                        <form action="" method="post">
                            <label for="cFindings">Findings</label><br>
                            <textarea rows="10" cols="50" id="cFindings" name="cFindings"
                                placeholder="State your findings" required></textarea>

                            <div class="submit">
                                <input type="submit" value="Submit" name="save">
                            </div>

                        </form>
                        <?php
                        if (isset($_POST['save'])) {
                            include("config.php");

                            $cFindings = $_POST['cFindings'];

                            if (isset($_GET['pID'])) {
                                $pID = $_GET['pID'];
                            }

                            $query = "UPDATE tblpermit SET pAmount = 'N/A', pStatus = 'Declined', pFindings = '$cFindings' WHERE pID = '$pID'";
                            $result = mysqli_query($conn, $query);

                            if ($result) {
                                $res = "SELECT * FROM tblresidents INNER JOIN tblpermit ON
                                tblpermit.aID=tblresidents.aID WHERE pID = '$pID'";
                                $resstmnt = $conn->query($res);
                                $resfet = mysqli_fetch_assoc($resstmnt);
                                $email = $resfet['rEmail'];
                                $name = $resfet['rFirst'];
                                $pNum = $resfet['pNum'];

                                //Secretary
                                $res2 = "SELECT * FROM tblresidents INNER JOIN tblAccess ON
                                tblAccess.aID=tblresidents.aID WHERE aType = 'Secretary'";
                                $resstmnt2 = $conn->query($res2);
                                $data = mysqli_fetch_assoc($resstmnt2);

                                $secEmail = $data['rEmail'];
                                if ($data['rSuffix'] == "N/A") {
                                    $secName = $data['rFirst'] . " " . $data['rLast'];
                                } else {
                                    $secName = $data['rFirst'] . " " . $data['rLast'] . " " . $data['rSuffix'];
                                }
                                $secContact = $data['rContact'];

                                $mail = new PHPMailer\PHPMailer\PHPMailer();
                                $mail->isSMTP();
                                $mail->isHTML(true);

                                $mail->Host = "mail.smtp2go.com";
                                $mail->SMTPAuth = true;
                                $mail->Username = "barangaysampaloc";
                                $mail->Password = "barangaysampaloc2018";
                                $mail->SMTPSecure = "tls";
                                $mail->Port = "2525";

                                $body = "<h3> <font color=red> Your Requested Permit has been Declined. </font color></h3><br>
                                You may check your permit request in the Barangay Sampaloc Portal by logging in to your account.
                                Kindly view your permit request for further details. <br>
                                <h4> You may request for another permit once you have resolved
                                the issue stated in the Findings Section. An email will be sent for instructions once your
                                request has been approved. </h4><br>

                                With Regards, <br>
                                <strong> <font color=black> $secName </font color> </strong><br>
                                <font color=black> $secContact || $secEmail </font color> <br>
                                <font color=black> Secretary, Barangay Sampaloc </font color> <br>
                                <br>
                                <font color=black> New Barangay Sampaloc 2018 </font color> <br>
                                <strong> <font color=black> newbrgysampaloc@gmail.com </font color> </strong> <br>
                                <strong> <font color=black> barangaysampaloc.com </font color></strong> </a>";

                                $mail->From = "newbrgysampaloc@gmail.com";
                                $mail->FromName = "Barangay Sampaloc";

                                $mail->addAddress($email, $name);

                                $mail->Subject = "Permit Request Declined";
                                $mail->Body = $body;

                                if ($mail->send()) {
                                    echo "<br><p><font color=green>Email Sent Successfully</font color></p>";
                                } else {
                                    echo "<br><p><font color=green>Email Sending Failed</font color></p>";
                                    echo "Mailer Error: " . $mail->ErrorInfo;
                                }

                            } else {
                                echo "<br><p><font color=green>Data Not Updated</font color></p>";
                            }
                            mysqli_close($conn);
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>