<?php
require('secure.php');
require("EMAIL FEATURE/PHPMailer-master/src/PHPMailer.php");
require("EMAIL FEATURE/PHPMailer-master/src/SMTP.php");
require("EMAIL FEATURE/PHPMailer-master/src/Exception.php");

if (isset($_GET['rID'])) {
    include("config.php");

    $rID = $_GET['rID'];

    $query = "UPDATE tblaccess INNER JOIN tblresidents ON 
    tblresidents.aID=tblaccess.aID SET aType = 'Resident' WHERE rID = '$rID'";
    $result = mysqli_query($conn, $query);

    $res = "SELECT * FROM tblresidents WHERE rID = '$rID'";
    $resstmnt = $conn->query($res);
    $resfet = mysqli_fetch_assoc($resstmnt);
    $email = $resfet['rEmail'];
    $name = $resfet['rFirst'];

    if ($resfet['rSuffix'] == "N/A"){
        $fname = $resfet['rFirst']." ".$resfet['rLast'];
    } else {
        $fname = $resfet['rFirst']." ".$resfet['rLast']." ".$resfet['rSuffix'];
    }

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->isSMTP();
    $mail->isHTML(true);
    
    $mail->Host = "mail.smtp2go.com"; 
    $mail->SMTPAuth = true;
    $mail->Username = "barangaysampaloc"; 
    $mail->Password = "barangaysampaloc2018"; 
    $mail->SMTPSecure = "tls"; 
    $mail->Port = "2525"; 

    $body = "<h3> <font color=green> Your Account has been Approved. </font color></h3><br>
    $fname's account has been approved by the barangay. <br>
    You may now access the Barangay Sampaloc Portal by logging in to your account. Kindly log-in using
    the username and password you have entered in the registration. <br>
    <h4> For permits and clearances, request them through your account, and wait for the approval
    before proceeding to Barangay Sampaloc Hall. </h4><br>

    With Regards, <br>
    <strong> <font color=blue> Hernando Santiago </font color> </strong><br>
    <font color=blue> 0976 899 054 || hernandosantiago@gmail.com </font color> <br>
    <font color=blue> Secretary, Barangay Sampaloc </font color> <br>
    <br>
    <font color=blue> New Barangay Sampaloc 2018 </font color> <br>
    <strong> <font color=blue> newbrgysampaloc@gmail.com </font color> </strong> <br>
    <strong> <font color=blue> barangaysampaloc.com </font color></strong> </a>";
   

    $mail->From = "newbrgysampaloc@gmail.com"; 
    $mail->FromName = "Barangay Sampaloc";

    $mail->addAddress($email, $name); 

    $mail->Subject = "Account Approval"; 
    $mail->Body = $body; 

    if ($mail->send()){ 
        echo "<br><p><font color=green>Email Sent Successfully</font color></p>";
    } else {
        echo "<br><p><font color=green>Email Sending Failed</font color></p>";
        echo "Mailer Error: ".$mail->ErrorInfo;
    }   

    mysqli_close($conn);
    header('location: residents.php');
}
?>
