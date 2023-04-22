<?php
require('secure.php');
require("EMAIL FEATURE/PHPMailer-master/src/PHPMailer.php");
require("EMAIL FEATURE/PHPMailer-master/src/SMTP.php");

if (isset($_GET['rID'])) {
    include("config.php");

    $rID = $_GET['rID'];

    $query = "UPDATE tblaccess  INNER JOIN tblresidents ON 
    tblresidents.aID=tblaccess.aID SET aType = 'Rejected' WHERE rID = '$rID'";
    $result = mysqli_query($conn, $query);

    $res = "SELECT * FROM tblresidents WHERE rID = '$rID'";
    $resstmnt = $conn->query($res);
    $resfet = mysqli_fetch_assoc($resstmnt);
    $email = $resfet['rEmail'];
    $name = $resfet['rFirst'];
   // $link = mysqli->real_escape_string("http://barangaysampaloc.com/");

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

    $body = "<h3> <font color=red> Your Account has been Declined. </font color></h3><br>
    $fname's account has been declined by the barangay. <br>
    Account registrations may be declined due to: <br>
        1. An individual's residency at Barangay Sampaloc, San Rafael, Bulacan still has not reached 6 months ; <br>
        2. An individual is not yet registered at Barangay Sampaloc ; or <br>
        3. An incorrect information may have been entered at the registration. <br>
    You may reach officials at Barangay Sampaloc through email, or through the contact information
    provided below for further details. You may also proceed to the barangay hall for assistance
    and walk-in registration.   <br>
    <h4> For registering, kindly wait for an
    approval email before accessing Barangay Sampaloc Portal. </h4><br>

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

    $mail->Subject = "Declined Account Registration"; 
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

