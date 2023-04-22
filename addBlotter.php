<?php
require('secure.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Add Blotter</title>
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
                    <a href="blotter.php" class="active">Blotter Records</a>
                    <a href="clearance.php">Clearances</a>
                    <a href="permit.php">Permits</a>
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
                    <a href="blotter.php" class="active">Blotter Records</a>
                    <a href="clearance.php">Clearances</a>
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
                <h1>Add Blotter</h1>
            </div>

            <div class="list">
                <div class="list1">
                    <div class="row">
                        <a href="blotter.php">Back</a>
                    </div>
                    <div class="wrapper">
                        <form action="" method="post">
                            <div class="left">
                                <label for="bDateI">Date and Time of Incident</label>
                                <input type="datetime-local" id="bDateI" name="bDateI" required>

                                <label for="bLoc">Location</label>
                                <input type="text" id="bLoc" name="bLoc" placeholder="Enter Location" required>

                                <label for="bReason">Reason</label>
                                <input type="text" id="bReason" name="bReason" placeholder="Enter Reason" required>

                                <label for="bAssistID">Attended By</label>
                                <select name="bAssistID" id="bAssistID" required>
                                    <option value="" disabled selected hidden>Select Official</option>
                                    <option value=3100>Ernesto C. Roque Jr.</option>
                                    <option value=3101>Rosario R. Dela Rosa</option>
                                    <option value=3102>Rene R. Abraham</option>
                                    <option value=3103>Proceso C. Roque</option>
                                    <option value=3104>Esvetlana H. Tobias</option>
                                    <option value=3105>Dexter A. Palopalo</option>
                                    <option value=3106>Julieta C. Chico</option>
                                    <option value=3107>Hernando L. Santiago</option>
                                </select>

                            </div>
                            <div class="right">
                                <label for="bComp">Complainant</label>
                                <input type="text" id="bComp" name="bComp" placeholder="Enter Complainant's Name"
                                    required>

                                <label for="bPers">Person to Complain</label>
                                <input type="text" id="bPers" name="bPers" placeholder="Enter Accused Person's Name"
                                    required>

                                <label for="bAction">Action Made</label>
                                <input type="text" id="bAction" name="bAction" placeholder="Enter Action Made" required>

                                <label for="bStatus">Status</label>
                                <select name="bStatus" id="bStatus" required>
                                    <option value="" disabled selected hidden>Select Status</option>
                                    <option value="Solved">Solved</option>
                                    <option value="Unsolved">Unsolved</option>
                                </select>

                            </div>
                            <div class="submit">
                                <input type="submit" value="Save" name="save">
                            </div>
                        </form>

                        <?php
                        if (isset($_POST['save'])) {
                            include('config.php');

                            $bDateI = $_POST['bDateI'];
                            $bLoc = trim($_POST['bLoc']);
                            $bReason = trim($_POST['bReason']);
                            $bAction = trim($_POST['bAction']);
                            $bStatus = $_POST['bStatus'];

                            $bAssistID = $_POST['bAssistID'];
                            // $offLen = count($bAssistID) - 1;
                            $bComp = explode(" ", trim($_POST['bComp']));
                            $fnamecomp = $bComp[0];
                            $compLen = count($bComp) - 1;

                            if (count($bComp)<1){
                                $bCompOut = trim($_POST['bComp']);
                            }
                            else {
                                $bCompOut = trim($_POST['bComp']);
                                $testA = "SELECT * FROM tblresidents WHERE rFirst LIKE '%$fnamecomp%'";
                                $resA = $conn->query($testA);
                                while($dataA = mysqli_fetch_assoc($resA)){
                                    if ($dataA['rSuffix'] == $bComp[$compLen]){
                                        $rFirst = $bComp[0];
                                        $rSuffix = $bComp[$compLen];
                                        $rLast = $bComp[$compLen-1];
                                        $bCompOut = "N/A";
    
                                    } else if ($dataA['rLast'] == $bComp[$compLen] && $bComp>=2) {             
                                        if ($bComp == 2){
                                            $lname = $bComp[$compLen-1]." ".$bComp[$compLen];  
                                            $fname = $fnamecomp." ".$bComp[$compLen-1];
    
                                            if ($dataA['rLast'] == $lname){
                                                $rFirst = $bComp[0];
                                                $rLast = $lname;
                                                $rSuffix = "N/A";
                                            } else if ($dataA['rFirst'] == $fname){
                                                $rFirst = $fname;
                                                $rLast = $bComp[$compLen];
                                                $rSuffix = "N/A";
                                            }
                                        } else {
                                            $rFirst = $bComp[0];
                                            $rLast = $bComp[$compLen];
                                            $rSuffix = "N/A";
                                        }   
                                        $bCompOut = "N/A";
                                    } else {
                                        $bCompOut = trim($_POST['bComp']);
                                    }
                                }
                            }
                            
                            
                            $bPers = explode(" ", trim($_POST['bPers']));
                            $fnamepers = $bPers[0];
                            $persLen = count($bPers) - 1;

                            if (count($bPers)<1){
                                $bPersOut = trim($_POST['bPers']);
                            } else {
                                $bPersOut = trim($_POST['bPers']);
                                $testB = "SELECT * FROM tblresidents WHERE rFirst LIKE '%$fnamepers%'";
                            $resB = $conn->query($testB);
                            while($dataB = mysqli_fetch_assoc($resB)){
                                if ($dataB['rSuffix'] == $bPers[$persLen]){
                                    $rFirstPERS = $bPers[0];
                                    $rSuffixPERS = $bPers[$persLen];
                                    $rLastPERS = $bPers[$persLen-1];
                                    $bPersOut = "N/A";  

                                } else if ($dataA['rLast'] == $bPers[$persLen] && $bPers>=2) {             
                                    if ($bPers == 2){
                                        $lname = $bPers[$persLen-1]." ".$bPers[$persLen];  
                                        $fname = $fnamepers." ".$bPers[$persLen-1];

                                        if ($dataB['rLast'] == $lname){
                                            $rFirstPERS = $bPers[0];
                                            $rLastPERS = $lname;
                                            $rSuffixPERS = "N/A";
                                        } else if ($dataB['rFirst'] == $fname){
                                            $rFirstPERS = $fname;
                                            $rLastPERS = $bPers[$persLen];
                                            $rSuffixPERS = "N/A";
                                        }
                                    } else {
                                        $rFirstPERS = $bPers[0];
                                        $rLastPERS = $bPers[$persLen];
                                        $rSuffixPERS = "N/A";
                                    } 
                                    $bPersOut = "N/A";  
                                } else {
                                    $bPersOut = trim($_POST['bPers']);
                                }
                            }
                        }
                            
                            
                            $seloff = "SELECT * FROM tblofficials INNER JOIN tblblotter ON
                            tblofficials.oID=tblblotter.oID WHERE tblofficials.oID='$bAssistID'";
                            $resOff = mysqli_query($conn, $seloff);
                            $fetOff = mysqli_fetch_assoc($resOff);
                            
                            if ($bCompOut == "N/A"){
                                $getCompID = "SELECT tblresidents.* FROM tblresidents 
                                WHERE tblresidents.rFirst LIKE '%$rFirst%' AND
                                tblresidents.rLast LIKE '%$rLast%' AND tblresidents.rSuffix LIKE '%$rSuffix%'";
                                $compRes = mysqli_query($conn, $getCompID);
                                $data = mysqli_fetch_array($compRes);
                                $compID = $data['aID'];
                            } else {
                                $bCompOut = trim($_POST['bComp']);
                            }

                            if ($bPersOut == "N/A"){
                                $getPersID = "SELECT tblresidents.* FROM tblresidents 
                                WHERE tblresidents.rFirst LIKE '%$rFirstPERS%' AND
                                tblresidents.rLast LIKE '%$rLastPERS%' AND tblresidents.rSuffix LIKE '%$rSuffixPERS%'";
                                $persRes = mysqli_query($conn, $getPersID);
                                $data2 = mysqli_fetch_assoc($persRes);
                                $persID = $data2['aID'];
                            } else {
                                $bPersOut = trim($_POST['bPers']);

                            }
                            
                            //comp out
                            if ($bCompOut != "N/A" && $bPersOut == "N/A"){
                                $compStmnt = "SELECT * FROM tblblotter INNER JOIN tblaccess ON
                                tblblotter.bPers=tblaccess.aID INNER JOIN tblresidents ON
                                tblresidents.aID=tblaccess.aID INNER JOIN tblofficials ON
                                tblofficials.oID=tblblotter.oID WHERE bDateI= '$bDateI' AND 
                                bCompOut = '$bCompOut' AND bLoc = '$bLoc' AND bPers = '$persID' AND 
                                bReason = '$bReason' AND bStatus = 'Unsolved'";
                                $res = $conn->query($compStmnt);
                                $rowComp = mysqli_num_rows($res);
                                $bOut = "001";

                                if ($rowComp > 0){
                                    echo "<br><p><font color=red>Blotter already exists</font color></p>";
                                } else {
                                    $INSERT = "INSERT INTO tblblotter (bDateI, bCompOut, bLoc, bPers, 
                                bReason, bAction, oID, bStatus, bOut) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                                $stmt = $conn->prepare($INSERT);
                                $stmt->bind_param(
                                    "sssississ",
                                    $bDateI,
                                    $bCompOut,
                                    $bLoc,
                                    $persID,
                                    $bReason,
                                    $bAction,
                                    $bAssistID,
                                    $bStatus,
                                    $bOut
                                );
                                $stmt->execute();
                                echo "<br><p><font color=green>Successfully Recorded</font color></p>";
                                $stmt->close();

                                $selPers = "SELECT * FROM tblresidents INNER JOIN tblblotter ON
                                tblresidents.aID=tblblotter.bPers WHERE bPers=$persID AND bStatus='Unsolved'";
                                $result2 = mysqli_query($conn, $selPers);
                                $row2 = mysqli_fetch_array($result2);
                                $resultCheck2 = mysqli_num_rows($result2);
                                $persRID = $row2['aID'];

                                if ($resultCheck2 > 0) {
                                    $updateType = "UPDATE tblaccess SET aType='Restricted' WHERE tblaccess.aID=$persRID";
                                    $result3 = mysqli_query($conn, $updateType);
                                }
                                $conn->close();

                                }

                            }

                            // pers out
                            else if ($bCompOut == "N/A" && $bPersOut != "N/A"){
                                $persStmnt = "SELECT * FROM tblblotter INNER JOIN tblaccess ON
                                tblblotter.bComp=tblaccess.aID INNER JOIN tblresidents ON
                                tblresidents.aID=tblaccess.aID INNER JOIN tblofficials ON
                                tblofficials.oID=tblblotter.oID WHERE bDateI= '$bDateI' AND 
                                bComp = '$compID' AND bLoc = '$bLoc' AND bPersOut = '$bPersOut' AND 
                                bReason = '$bReason' AND bStatus = 'Unsolved'";
                                $res = $conn->query($persStmnt);
                                $rowPers = mysqli_num_rows($res);
                                $bOut = "002";

                                if ($rowPers > 0){
                                    echo "<br><p><font color=red>Blotter already exists</font color></p>";
                                }  else {
                                    $INSERT = "INSERT INTO tblblotter (bDateI, bComp, bLoc, bPersOut, 
                                    bReason, bAction, oID, bStatus, bOut) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                                    $stmt = $conn->prepare($INSERT);
                                    $stmt->bind_param(
                                        "sissssiss",
                                        $bDateI,
                                        $compID,
                                        $bLoc,
                                        $bPersOut,
                                        $bReason,
                                        $bAction,
                                        $bAssistID,
                                        $bStatus,
                                        $bOut
                                    );
                                        $stmt->execute();
                                        echo "<br><p><font color=green>Successfully Recorded</font color></p>";
                                        $stmt->close();
                                }
                            }

                            //comp, pers out, suppose incident happened w/in brgy sampaloc
                            else if ($bCompOut != "N/A" && $bPersOut != "N/A"){
                                $bothStmnt = "SELECT * FROM tblblotter INNER JOIN tblofficials ON
                                tblofficials.oID=tblblotter.oID WHERE bDateI= '$bDateI' AND 
                                bCompOut = '$bCompOut' AND bLoc = '$bLoc' AND bPersOut = '$bPersOut' 
                                AND bReason = '$bReason' AND bStatus = 'Unsolved'";
                                $res = $conn->query($bothStmnt);
                                $rowBoth = mysqli_num_rows($res);
                                $bOut = "003";

                                if ($rowBoth > 0){
                                    echo "<br><p><font color=red>Blotter already exists</font color></p>";
                                }  else {
                                    $INSERT = "INSERT INTO tblblotter (bDateI, bCompOut, bLoc, bPersOut, 
                                    bReason, bAction, oID, bStatus, bOut) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                                    $stmt = $conn->prepare($INSERT);
                                    $stmt->bind_param(
                                        "ssssssiss",
                                        $bDateI,
                                        $bCompOut,
                                        $bLoc,
                                        $bPersOut,
                                        $bReason,
                                        $bAction,
                                        $bAssistID,
                                        $bStatus,
                                        $bOut
                                    );
                                        $stmt->execute();
                                        echo "<br><p><font color=green>Successfully Recorded</font color></p>";
                                        $stmt->close();
                                }

                            }

                            //both w/in sampaloc 
                            else {
                                $sql = "SELECT * FROM tblblotter INNER JOIN tblresidents ON
                                tblblotter.bPers=tblresidents.aID INNER JOIN tblaccess ON
                                tblblotter.bComp=tblaccess.aID INNER JOIN tblofficials ON
                                tblofficials.oID=tblblotter.oID WHERE bDateI= '$bDateI' AND 
                                bComp = '$compID' AND bLoc = '$bLoc' AND bPers = '$persID' AND bReason = '$bReason'
                                AND bStatus = 'Unsolved'";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_array($result);
                                $resultCheck = mysqli_num_rows($result);
                                $bOut = "004";
    
                                if ($resultCheck > 0) {
                                    echo "<br><p><font color=red>Blotter already exists</font color></p>";
                                } else {
                                    $INSERT = "INSERT INTO tblblotter (bDateI, bComp, bLoc, bPers, 
                                    bReason, bAction, oID, bStatus, bOut) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                                    $stmt = $conn->prepare($INSERT);
                                    $stmt->bind_param(
                                        "sisississ",
                                        $bDateI,
                                        $compID,
                                        $bLoc,
                                        $persID,
                                        $bReason,
                                        $bAction,
                                        $bAssistID,
                                        $bStatus,
                                        $bOut
                                    );
                                    $stmt->execute();
                                    echo "<br><p><font color=green>Successfully Recorded</font color></p>";
                                    $stmt->close();
    
                                    $selPers = "SELECT * FROM tblaccess INNER JOIN tblblotter ON
                                    tblblotter.bPers=tblaccess.aID WHERE bPers=$persID AND bStatus = 'Unsolved' ";
                                    $result2 = mysqli_query($conn, $selPers);
                                    $row2 = mysqli_fetch_array($result2);
                                    $resultCheck2 = mysqli_num_rows($result2);
                                    $persRID = $row2['aID'];
    
                                    if ($resultCheck2 > 0) {
                                        $updateType = "UPDATE tblaccess SET aType='Restricted' WHERE tblaccess.aID=$persRID";
                                        $result3 = mysqli_query($conn, $updateType);
                                    }
                                    $conn->close();
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