<?php
require('secure.php');
require("EMAIL FEATURE/PHPMailer-master/src/PHPMailer.php");
require("EMAIL FEATURE/PHPMailer-master/src/SMTP.php");

if (isset($_GET['pID'])) {
    include("config.php");

    $pID = $_GET['pID'];

    $query = "UPDATE tblpermit SET pStatus = 'Approved', pFindings = 'N/A' WHERE pID = '$pID'";
    $result = mysqli_query($conn, $query);

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

    $body = "<h3> <font color=green> Your Requested Permit has been Approved. </font color></h3><br>
    You may check your approved permit request in the Barangay Sampaloc Portal by logging in to your account.
    Kindly prepare <strong>P500</strong> payment for the release of permit in the barangay. <br>
    <h4> Please proceed to Barangay Sampaloc Hall for the permit and payment. </h4><br>

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

    $mail->Subject = "Permit Approval";
    $mail->Body = $body;

    if ($mail->send()) {
        echo "<br><p><font color=green>Email Sent Successfully</font color></p>";
    } else {
        echo "<br><p><font color=green>Email Sending Failed</font color></p>";
        echo "Mailer Error: " . $mail->ErrorInfo;
    }

    mysqli_close($conn);
    header('location: permit.php');
}
?>