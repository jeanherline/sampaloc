<?php
require('secure.php');
require("EMAIL FEATURE/PHPMailer-master/src/PHPMailer.php");
require("EMAIL FEATURE/PHPMailer-master/src/SMTP.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Add Resident</title>
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

        if ($_SESSION['role'] == 'Secretary') {
            ?>
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
        <?php } elseif ($_SESSION['role'] == 'Chairman') {
            ?>
            <nav>
                <div class="side_navbar">
                    <span>Main Menu</span>
                    <a href="officials.php">Brgy. Officials</a>
                    <a href="residents.php" class="active">Residents Info</a>
                    <a href="clearance.php">Clearances</a>
                    <a href="permit.php">Permits</a>
                    <a href="usertype.php">User Type</a>
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
                <h1>Registration</h1>
            </div>

            <div class="list">
                <div class="list1">
                    <div class="row">
                        <a href="residents.php">Back</a>
                    </div>
                    <div class="wrapper">
                        <form action="" method="post" autocomplete="off" enctype="multipart/form-data">

                            <div class="left">
                                <label for="uName">
                                    <font color=black>
                                        <font size=4px>Personal Information<br><br></font size>
                                    </font color>
                                </label>
                                <br>
                                <label for="rImage">Profile Image<font color= red> * </font color></label>
                                <input type="file" id="rImage" name="rImage" accept=".jpg,.jpeg,.png" required>

                                <label for="rMid">Middle Name (Optional)</label>
                                <input type="text" id="rMid" name="rMid" placeholder="Enter Middle Name">

                                <label for="rSuffix">Suffix<font color= red> * </font color></label>
                                <select name="rSuffix" id="rSuffix" required>
                                    <option value="" disabled selected hidden>Select Suffix</option>
                                    <option value="N/A">N/A</option>
                                    <option value="JR.">JR.</option>
                                    <option value="SR.">SR.</option>
                                    <option value="I">I</option>
                                    <option value="II">II</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                    <option value="V">V</option>
                                    <option value="VI">VI</option>
                                    <option value="VII">VII</option>
                                    <option value="VIII">VIII</option>
                                    <option value="IX">IX</option>
                                    <option value="X">X</option>
                                    <option value="XI">XI</option>
                                    <option value="XII">XII</option>
                                    <option value="XIII">XIII</option>
                                    <option value="XIV">XIV</option>
                                    <option value="XV">XV</option>
                                    <option value="XVI">XVI</option>
                                    <option value="XVII">XVII</option>
                                    <option value="XVIII">XVIII</option>
                                    <option value="XIX">XIX</option>
                                    <option value="XX">XX</option>

                                </select>

                                <label for="rBplace">Place of Birth<font color= red> * </font color></label>
                                <input type="text" id="rBplace" name="rBplace" placeholder="Enter Place of Birth"
                                    required>

                                <label for="rCivil">Civil Status<font color= red> * </font color></label>
                                <select name="rCivil" id="rCivil" required>
                                    <option value="" disabled selected hidden>Select Civil Status</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Separated">Separated</option>
                                    <option value="Widowed">Widowed</option>
                                </select>

                                <label for="rHouse">House Number</label>
                                <input type="number" id="rHouse" name="rHouse" placeholder="Enter House Number">

                                <label for="rResiding">Years Residing<font color= red> * </font color></label>
                                <input type="number" id="rResiding" name="rResiding" placeholder="Enter Years Residing"
                                    required>

                                <label for="rVoter">Voters Status<font color= red> * </font color></label>
                                <select name="rVoter" id="rVoter" required>
                                    <option value="" disabled selected hidden>Select Voters Status</option>
                                    <option value="Registered">Registered</option>
                                    <option value="Not Registered">Not Registered</option>
                                </select>
                                <label for="rEmail">Email Address<font color= red> * </font color></label>
                                <input type="email" id="rEmail" name="rEmail" placeholder="juandelacruz@gmail.com"
                                    required>
                                <br><br>
                                <label for="uName">
                                    <font color=black>
                                        <font size=4px>Login Credentials</font size>
                                    </font color>
                                </label><br><br>

                                <label for="uName">Create Username<font color= red> * </font color></label>
                                <input type="text" id="uName" name="uName" pattern="^[a-z0-9_-]{5,15}$"
                                    placeholder="Example: juan_delacruz09" required>

                                <label>
                                    <font color=black>
                                        <font size=2px> Username must be atleast 5 to 15 characters with any lower case
                                            character,
                                            digit or special symbol “underscore ( _ ) and hyphen ( - )” only.</font
                                            size>
                                    </font color>
                                </label>

                            </div>
                            <div class="right">
                                <br><br><br>
                                <label for="rFirst">First Name<font color= red> * </font color></label>
                                <input type="text" id="rFirst" name="rFirst" placeholder="Enter First Name" required>

                                <label for="rLast">Last Name<font color= red> * </font color></label>
                                <input type="text" id="rLast" name="rLast" placeholder="Enter Last Name" required>

                                <label for="rBday">Date of Birth<font color= red> * </font color></label>
                                <input type="date" id="rBday" name="rBday" required>

                                <label for="rGender">Gender<font color= red> * </font color></label>
                                <select name="rGender" id="rGender" required>
                                    <option value="" disabled selected hidden>Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Others">Others</option>
                                    <option value="Rather Not Say">Rather Not Say</option>
                                </select>

                                <label for="rPurok">Purok<font color= red> * </font color></label>
                                <select name="rPurok" id="rPurok" required>
                                    <option value="" disabled selected hidden>Select Purok</option>
                                    <option value="Purok 1">Purok 1</option>
                                    <option value="Purok 2">Purok 2</option>
                                    <option value="Purok 3">Purok 3</option>
                                    <option value="Purok 4">Purok 4</option>
                                    <option value="Purok 5">Purok 5</option>
                                    <option value="Purok 6">Purok 6</option>
                                    <option value="Purok 7">Purok 7</option>
                                </select>

                                <label for="rCedula">Cedula Number (Optional)</label>
                                <input type="number" id="rCedula" name="rCedula" placeholder="Enter Cedula Number"
                                    >

                                <label for="rPrecint">Precinct Number (Optional)</label>
                                <input type="text" id="rPrecint" name="rPrecint" pattern="([0-9]{4}[A-Z]{1})"
                                    placeholder="Example: 2314A or 6532Y">

                                <label for="rOccup">Occupation<font color= red> * </font color></label>
                                <input type="text" id="rOccup" name="rOccup" placeholder="Enter Occupation" required>

                                <label for="rContact">Contact Number<font color= red> * </font color></label>
                                <input type="text" id="rContact" name="rContact" pattern="((^(\+)(\d){12}$)|(^\d{11}$))"
                                    placeholder="Example: 09123456789" required>

                                <br><br><br><br><br>
                                <label for="uPswd">Create Password<font color= red> * </font color></label>
                                <input type="password" id="uPswd" name="uPswd"
                                    pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,15}$" placeholder="Example: ASPgo123"
                                    required>

                                <label>
                                    <font color=black>
                                        <font size=2px> Password must be at least 5 to 15 characters, and
                                            must include at least one upper case letter, one lower case letter,
                                            and one numeric digit.</font size>
                                    </font color>
                                </label>

                            </div>
                            <br>
                            <div class="submit">
                                <input type="submit" value="Save" name="save">
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['save'])) {
                            include('config.php');

                            $rImage = $_FILES["rImage"]["name"]; //file name
                            $tempname = $_FILES["rImage"]["tmp_name"];
                            $folder = "rImages/" . $rImage;
                            move_uploaded_file($tempname, $folder);

                            $rFirst = trim($_POST['rFirst']);
                            $rLast = trim($_POST['rLast']);
                            $rBplace = trim($_POST['rBplace']);
                            $rCivil = $_POST['rCivil'];
                            $rGender = $_POST['rGender'];
                            $rPurok = $_POST['rPurok'];
                            $rResiding = trim($_POST['rResiding']);
                            
                            $rVoter = $_POST['rVoter'];
                            $rEmail = trim($_POST['rEmail']);
                            $rContact = trim($_POST['rContact']);
                            $rOccup = trim($_POST['rOccup']);

                            $uName = trim($_POST['uName']);
                            $uPswd = trim($_POST['uPswd']);

                            if (empty($_POST['rMid'])) {
                                $rMid = "N/A";
                            } else {
                                $rMid = trim($_POST['rMid']);
                            }
                            if (empty($_POST['rSuffix'])) {
                                $rSuffix = "N/A";
                            } else {
                                $rSuffix = $_POST['rSuffix'];
                            }
                            if (empty($_POST['rHouse'])) {
                                $rHouse = "N/A";
                            } else {
                                $rHouse = trim($_POST['rHouse']);
                            }
                            if (empty($_POST['rPrecint'])) {
                                $rPrecint = "N/A";
                            } else {
                                $rPrecint = trim($_POST['rPrecint']);
                            }if (empty($_POST['rCedula'])) {
                                $rCedula = "N/A";
                            } else {
                                $rCedula = trim($_POST['rCedula']);;
                            }

                            $bday = $_POST['rBday'];
                            $rBday = ($bday);
                            $today = (date('Y-m-d'));
                        $diff = date_diff(date_create($rBday), date_create($today));
                        $rAge = $diff->format('%y');
                            $rResiding = $_POST['rResiding'];

                            if ($rResiding > $rAge) {
                                echo "<br><p><font size=4px><font color=RED>Invalid Years Residing</font size></font color></p>";
                            } else {
                                $searchDup = "SELECT * FROM tblresidents INNER JOIN tblaccess ON
                                tblaccess.aID=tblresidents.aID WHERE (rContact LIKE '%$rContact%' 
                                AND LOWER(rEmail) LIKE LOWER('%$rEmail%')) OR (rCedula LIKE '%$rCedula%') 
                                AND (aType!='Archive' OR aType!='Rejected')";
                                $dupStmnt = $conn->query($searchDup);
                                $fetchDup = mysqli_fetch_assoc($dupStmnt);

                                if ($dupStmnt->num_rows > 0) {
                                    echo "<br><p><font size=4px><font color=RED>Information Already Exist</font size></font color></p>";
                                } else {
                                    $pen = "Resident";
                                    $INSERT = "INSERT INTO tblaccess (aUname, aPswd, aType) VALUES (?, ?, ?)";

                                    $stmt = $conn->prepare($INSERT);
                                    $stmt->bind_param("sss", $uName, $uPswd, $pen);
                                    $stmt->execute();
                                    $stmt->close();

                                    $SELECT = "SELECT * FROM tblaccess WHERE aUname = '$uName' LIMIT 1";
                                    $resultID = mysqli_query($conn, $SELECT);
                                    $row = mysqli_fetch_array($resultID);
                                    $aID = $row['aID'];

                                    $INSERT2 = "INSERT INTO tblresidents (rImage, rFirst, rMid, rLast, rSuffix, rBday, rBplace, rAge, rCivil,
                                        rGender, rHouse, rPurok, rResiding, rCedula, rVoter, rPrecinct, rEmail, rContact, rOccup, aID)
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                                    $stmt2 = $conn->prepare($INSERT2);
                                    $stmt2->bind_param(
                                        "sssssssssssssssssssi",
                                        $rImage,
                                        $rFirst,
                                        $rMid,
                                        $rLast,
                                        $rSuffix,
                                        $rBday,
                                        $rBplace,
                                        $rAge,
                                        $rCivil,
                                        $rGender,
                                        $rHouse,
                                        $rPurok,
                                        $rResiding,
                                        $rCedula,
                                        $rVoter,
                                        $rPrecint,
                                        $rEmail,
                                        $rContact,
                                        $rOccup,
                                        $aID
                                    );
                                    $stmt2->execute();
                                    //$stmt2->close();
                                    //$conn->close();
                                    echo "<br><p><font size=4px><font color=green>Successfully Registered</font size></font color></p>";
                                    
                                    $getID = "SELECT * FROM tblresidents WHERE aID='$aID'";
                                    $resID = $conn->query($getID);
                                    $fetch = mysqli_fetch_assoc($resID);
                                    $rID = $fetch['rID'];

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
                                }
                            }
                        }
                        
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>