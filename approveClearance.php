<?php
require('secure.php');
require("EMAIL FEATURE/PHPMailer-master/src/PHPMailer.php");
require("EMAIL FEATURE/PHPMailer-master/src/SMTP.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Approve Clearance</title>
    <link rel="stylesheet" href="assets/css/form.css" />
    <link rel="icon" href="assests/images/bLogo.png" type="image/icon type" />
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

        if ($_SESSION['role'] == 'Chairman') {
            ?>
            <nav>
                <div class="side_navbar">
                    <span>Main Menu</span>
                    <a href="officials.php">Brgy. Officials</a>
                    <a href="residents.php">Residents Info</a>
                    <a href="clearance.php" class="active">Clearances</a>
                    <a href="permit.php">Permits</a>
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
                    <a href="clearance.php" class="active">Clearances</a>
                    <a href="permit.php">Permits</a>
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
                <h1>Clearance Approval</h1>
            </div>

            <div class="list">
                <div class="list1">
                    <div class="row">
                        <a href="clearance.php">Back</a>
                    </div>
                    <div class="wrapper" style="width: 540px">
                        <form action="" method="post">

                            <label for="purpose">Purpose</label><br>
                            <select name="purpose" id="purpose" style="width: 400px" required>
                                <option value="" selected hidden>Enter Purpose</option>
                                <option value="Legal">Legal</option>
                                <option value="Loan">Loan</option>
                            </select>
                            <br>
                            <div class="submit">
                                <input type="submit" value="Approve" name="save">
                            </div>
                        </form>

                        <?php
                        if (isset($_POST['save'])) {
                            if (isset($_GET['cID'])) {
                                $cID = $_GET['cID'];
                            }
                            include("config.php");

                            $purpose = $_POST['purpose'];

                            if ($purpose == "Legal") {
                                $fee = "25";
                            } else if ($purpose == "Loan") {
                                $fee = "50";
                            }

                            $query = "UPDATE tblclearance SET cPurpose = '$purpose', cAmount = '$fee', cStatus = 'Approved', cFindings = 'N/A' WHERE cID = '$cID'";
                            $result = mysqli_query($conn, $query);

                            if ($result) {
                                $res = "SELECT * FROM tblresidents INNER JOIN tblclearance ON
                                tblclearance.aID=tblresidents.aID WHERE cID = '$cID'";
                                $resstmnt = $conn->query($res);
                                $resfet = mysqli_fetch_assoc($resstmnt);
                                $email = $resfet['rEmail'];
                                $name = $resfet['rFirst'];
                                $cNum = $resfet['cNum'];
                                $cAmount = $resfet['cAmount'];
                                $cPurpose = $resfet['cPurpose'];

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

                                $body = "<h3> <font color=green> Your Requested Clearance has been Approved. </font color></h3>
                                    You may check your approved clearance request in the Barangay Sampaloc Portal by logging in to your account.
                                    Kindly prepare <strong>P$cAmount</strong> payment ($cPurpose Purposes) for the release of clearance in the barangay.
                                    <h4> Please proceed to Barangay Sampaloc Hall for the clearance and payment. </h4><br>
                                
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

                                $mail->Subject = "Clearance Approval";
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
    </div>
</body>

</html>