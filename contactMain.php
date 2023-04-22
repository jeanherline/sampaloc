<?php
require("EMAIL FEATURE/PHPMailer-master/src/PHPMailer.php");
require("EMAIL FEATURE/PHPMailer-master/src/SMTP.php");
require("EMAIL FEATURE/PHPMailer-master/src/Exception.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="assets/css/contact.css">

</head>

<body>
    <section class="header">
        <div class="logo">
            <img src="assets/images/bLogo.png" alt="">
            <a>Barangay Sampaloc</a>
        </div>
        <nav class="navbar">
            <a href="index.php">Home</a>
            <?php
            session_start();
            if (isset($_SESSION['loggedin'])) {
                if ($_SESSION['loggedin'] == TRUE) {
                    include('config.php');
                    if (isset($_GET['$userid'])) {
                        $aID = $_GET['$userid'];
                    }
                    $sel = "SELECT * FROM tblresidents INNER JOIN tblaccess ON
                    tblaccess.aID=tblresidents.aID WHERE tblaccess.aID= '$aID'";
                    $exec = $conn->query($sel);
                    $fet = mysqli_fetch_assoc($exec);
                    $rID = $fet['rID'];

                    if ($_SESSION['role'] == 'Secretary' or $_SESSION['role'] == 'Chairman') {
                        ?>
                        <a href="officials.php">Account</a>
                        <?php
                    } elseif ($_SESSION['role'] == 'Kagawad') {
                        ?>
                        <a href="blotter.php">Account</a>
                        <?php
                    } else {
                        ?>
                        <a href="clearance.php">Account</a>
                        <?php
                    }
                }
            }
            ?>
            <?php
            if (isset($_SESSION['loggedin'])) {
                if ($_SESSION['loggedin'] == TRUE) {
                    ?>
                    <a href="logout.php"><button class="btn" id="btn1">Log Out</button></a>
                    <?php
                }
            } else {
                ?>
                <a href="about.php">About</a>
                <a href="register.php">Sign up</a>
                <a href="login.php"><button class="btn" id="btn1">Log In</button></a>
                <?php
            }
            ?>
        </nav>
        <div id="menu-btn" class="fas fa-bars"></div>
    </section>

    <div class="contactUs">
        <div class="title">
            <h1>Get in Touch</h1>
        </div>
        <div class="box">

            <div class="contact form">
                <h3> Send a Message</h3>

                <?php
                if (isset($_SESSION['loggedin'])) {
                    if ($_SESSION['loggedin'] == TRUE) {

                        if ($fet['rSuffix'] == "N/A") {
                            $fullname = $fet['rFirst'] . " " . $fet['rLast'];
                        } else {
                            $fullname = $fet['rFirst'] . " " . $fet['rLast'] . " " . $fet['rSuffix'];
                        } ?>

                        <form method="post" action="#">
                            <div class="formBox">
                                <div class="row50">
                                    <div class="inputBox">
                                        <span>Name (Optional)</span>
                                        <input type="text" name="name" value="<?= $fullname; ?>">
                                    </div>
                                    <div class="inputBox">
                                        <span>Subject (Required)</span>
                                        <input type="text" name="subj" placeholder="State your Concern" required="required">
                                    </div>
                                </div>

                                <div class="row50">
                                    <div class="inputBox">
                                        <span>Email (Optional)</span>
                                        <input type="email" name="email" value="<?= $fet['rEmail']; ?>">
                                    </div>
                                    <div class="inputBox">
                                        <span>Contact Information (Optional)</span>
                                        <input type="tel" name="contact" value="<?= $fet['rContact']; ?>">
                                    </div>
                                </div>

                                <div class="row100">
                                    <div class="inputBox">
                                        <span>Message</span>
                                        <textarea name="message" placeholder="Write your Message Here..."
                                            required="required"></textarea>
                                    </div>
                                </div>

                                <div class="row100">
                                    <div class="inputBox">
                                        <input type="submit" value="Send" name="submit"></input>
                                    </div>
                                </div>

                            </div>
                        </form>

                        <?php
                    }
                } else { ?>
                    <form method="post" action="#">
                        <div class="formBox">
                            <div class="row50">
                                <div class="inputBox">
                                    <span>Name (Optional)</span>
                                    <input type="text" name="name" placeholder="Enter Full Name">
                                </div>
                                <div class="inputBox">
                                    <span>Subject (Required)</span>
                                    <input type="text" name="subj" placeholder="State your Concern" required="required"
                                        value="">
                                </div>
                            </div>

                            <div class="row50">
                                <div class="inputBox">
                                    <span>Email (Required)</span>
                                    <input type="email" name="email" placeholder="sample@gmail.com" required="required">
                                </div>
                                <div class="inputBox">
                                    <span>Contact Information (Optional)</span>
                                    <input type="tel" name="contact" placeholder="+63 000-000-0000"
                                        pattern="+63 [0-9]{3}-[0-9]{3}-[0-9]{4}">
                                </div>
                            </div>

                            <div class="row100">
                                <div class="inputBox">
                                    <span>Message</span>
                                    <textarea name="message" placeholder="Write your Message Here..."
                                        required="required"></textarea>
                                </div>
                            </div>

                            <div class="row100">
                                <div class="inputBox">
                                    <input type="submit" value="Send" name="submit"></input>
                                </div>
                            </div>

                        </div>
                    </form>

                <?php } ?>

            </div>

            <?php
            if (isset($_POST['submit'])) {
                include('config.php');

                if (isset($_SESSION['loggedin'])) {
                    if ($_SESSION['loggedin'] == TRUE) {

                        $info = "SELECT * FROM tblresidents WHERE rID= '$rID'";
                        $exec = $conn->query($info);
                        $fetch = mysqli_fetch_assoc($exec);

                        if (!empty($_POST['name'])) {
                            $name = $_POST['name'];
                        } else {
                            if ($fetch['rSuffix'] == 'N/A') {
                                $name = $fetch['rFirst'] . " " . $fetch['rLast'];
                            } else {
                                $name = $fetch['rFirst'] . " " . $fetch['rLast'] . " " . $fetch['rSuffix'];
                            }
                        }
                        if (!empty($_POST['email'])) {
                            $email = $_POST['email'];
                        } else {
                            $email = $fetch['rEmail'];
                        }
                        if (!empty($_POST['contact'])) {
                            $contact = $_POST['contact'];
                        } else {
                            $contact = $fetch['rContact'];
                        }
                    }
                } else {
                    if (empty($_POST['name'])) {
                        $name = "Barangay Sampaloc Resident";
                    } else {
                        $name = $_POST['name'];
                    }
                    if (empty($_POST['email'])) {
                        $email = "Resident Refused to Give Email";
                    } else {
                        $email = $_POST['email'];
                    }

                    $contact = $_POST['contact'];

                }

                $subj = $_POST['subj'];
                $message = $_POST['message'];

                $mail = new PHPMailer\PHPMailer\PHPMailer();
                $mail->isSMTP();
                $mail->isHTML(true);

                $mail->Host = "mail.smtp2go.com";
                $mail->SMTPAuth = true;
                $mail->Username = "brgysampalocinquiries";
                $mail->Password = "barangaysampaloc2018";
                $mail->SMTPSecure = "tls";
                $mail->Port = "2525";

                $mail->From = "brgysampaloc.inquiries@gmail.com";
                $mail->FromName = $name;

                $mail->addAddress("newbrgysampaloc@gmail.com", "Barangay Sampaloc");

                $mail->Subject = $subj;
                $mail->Body = $message . "<br>Name: <strong>$name <strong></br>
                                <br>Contact Number:<strong> $contact </strong><br>
                                Email Address: <strong> $email </strong>";

                if ($mail->send()) {
                    $res2 = "SELECT * FROM tblresidents INNER JOIN tblAccess ON
                                    tblAccess.aID=tblresidents.aID WHERE aType = 'Secretary'";
                    $resstmnt2 = $conn->query($res2);
                    $data = mysqli_fetch_assoc($resstmnt2);

                    if ($data['rSuffix'] == "N/A") {
                        $secName = $data['rFirst'] . " " . $data['rLast'];
                    } else {
                        $secName = $data['rFirst'] . " " . $data['rLast'] . " " . $data['rSuffix'];
                    }
                    $secContact = $data['rContact'];
                    $secEmail = $data['rEmail'];

                    $mail = new PHPMailer\PHPMailer\PHPMailer();
                    $mail->isSMTP();
                    $mail->isHTML(true);

                    $mail->Host = "mail.smtp2go.com";
                    $mail->SMTPAuth = true;
                    $mail->Username = "barangaysampaloc";
                    $mail->Password = "barangaysampaloc2018";
                    $mail->SMTPSecure = "tls";
                    $mail->Port = "2525";

                    $body = "<h3> <font color=green> Your Concern has Reached Barangay Sampaloc. </font color></h3>
                                    Your concern will be reviewed, which may take a day or more before the barangay can respond.
                                    Kindly wait for a response from the barangay via the email/contact number you have provided.
                                    <h4> If you have other concern/s or urgent matter that needs to be addressed
                                    as soon as possible, you may try reaching the barangay officials through the contact information
                                    provided below. </h4><br>
                                
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

                    $mail->Subject = "Message has been Received";
                    $mail->Body = $body;

                    if ($mail->send()) {
                        echo "<br><h4><strong><font color=green>Message Sent Successfully</font color></strong></h4>";
                    }
                } else {
                    echo "<br><h4><strong><font color=red>Message Sending Failed</font color></strong></h4>";
                    echo "Mailer Error: " . $mail->ErrorInfo;
                }
                mysqli_close($conn);
            }
            ?>

            <div class="contact info">
                <h3>Contact Information</h3>
                <div class="infoBox">
                    <div>
                        <span><ion-icon name="location"></ion-icon></span>
                        <p>Brgy. Sampaloc, San Rafael, Baliwag, Bulacan <br> PHILIPPINES</p>
                    </div>
                    <div>
                        <span><ion-icon name="mail"></ion-icon></span>
                        <a href="mailto:newbrgysampaloc@gmail.com">newbrgysampaloc@gmail.com</a>
                    </div>
                    <div>
                        <span><ion-icon name="call"></ion-icon></span>
                        <a href="tel:+630000000000">+63 000 0000 000</a>
                    </div>

                    <ul class="sci">
                        <li><a href="https://web.facebook.com/profile.php?id=100064518436649"><ion-icon
                                    name="logo-facebook"></ion-icon></a></li>
                        <li><a href="#"><ion-icon name="logo-twitter"></ion-icon></a></li>
                        <li><a href="#"><ion-icon name="logo-instagram"></ion-icon></a></li>

                    </ul>
                </div>
            </div>

            <div class="contact map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3854.4534928686135!2d120.91574441432407!3d14.967510671993406!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33970014a85651fd%3A0xc2d3bf0fb6c0481!2sSan%20Rafael%2C%20Baliuag%2C%20Bulacan!5e0!3m2!1sfil!2sph!4v1675841019891!5m2!1sfil!2sph"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>