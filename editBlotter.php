<?php
require('secure.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Edit Blotter</title>
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
                <?php
                if (isset($_GET['bID'])) {
                    $bID = $_GET['bID'];
                    include("config.php");

                    $sql = "SELECT * FROM tblblotter WHERE bID = $bID";
                    $result = $conn->query($sql);
                    $fetch = mysqli_fetch_assoc($result);

                    $bDateI = $fetch['bDateI'];
                    $bDateR = $fetch['bDateR'];
                    $bLoc = $fetch['bLoc'];
                    $bReason = $fetch['bReason'];
                    $bAction = $fetch['bAction'];
                    $bStatus = $fetch['bStatus'];

                    $bCompOut = $fetch['bCompOut'];
                    $bPersOut = $fetch['bPersOut'];

                    $bCompID = $fetch['bComp'];
                    $bPersID = $fetch['bPers'];
                    $officialID = $fetch['oID'];

                    $bOut = $fetch['bOut'];

                    if ($bOut == "002"){ //in, out
                    $comp = "SELECT * FROM tblresidents WHERE aID = $bCompID";
                    $compRes = mysqli_query($conn, $comp);
                    $dataComp = mysqli_fetch_array($compRes);
                    if ($dataComp['rSuffix'] == "N/A"){
                        $bComp = $dataComp['rFirst']." ".$dataComp['rLast'];
                    } else{
                        $bComp = $dataComp['rFirst']." ".$dataComp['rLast']." ".$dataComp['rSuffix'];
                    }

                } else if ($bOut == "001"){ //out, in
                    $pers = "SELECT * FROM tblresidents WHERE aID = $bPersID";
                    $persRes = mysqli_query($conn, $pers);
                    $dataPers = mysqli_fetch_array($persRes);
                    if ($dataPers['rSuffix'] == "N/A"){
                        $bPers = $dataPers['rFirst']." ".$dataPers['rLast'];
                    } else{
                        $bPers = $dataPers['rFirst']." ".$dataPers['rLast']." ".$dataPers['rSuffix'];
                    }
                } else if ($bOut == "003"){
                    $nameComp = $bCompOut;
                    $namePers = $bPersOut;
                } else if ($bOut == "004"){
                    $comp = "SELECT * FROM tblresidents WHERE aID = $bCompID";
                    $compRes = mysqli_query($conn, $comp);
                    $dataComp = mysqli_fetch_array($compRes);
                    if ($dataComp['rSuffix'] == "N/A"){
                        $bComp = $dataComp['rFirst']." ".$dataComp['rLast'];
                    } else{
                        $bComp = $dataComp['rFirst']." ".$dataComp['rLast']." ".$dataComp['rSuffix'];
                    }

                    $pers = "SELECT * FROM tblresidents WHERE aID = $bPersID";
                    $persRes = mysqli_query($conn, $pers);
                    $dataPers = mysqli_fetch_array($persRes);
                    if ($dataPers['rSuffix'] == "N/A"){
                        $bPers = $dataPers['rFirst']." ".$dataPers['rLast'];
                    } else{
                        $bPers = $dataPers['rFirst']." ".$dataPers['rLast']." ".$dataPers['rSuffix'];
                    }

                }

                    $offi = "SELECT * FROM tblresidents INNER JOIN tblaccess ON
                    tblresidents.aID=tblaccess.aID INNER JOIN tblofficials ON
                    tblofficials.aID=tblaccess.aID WHERE oID = $officialID";
                    $offiRes = $conn->query($offi);
                    $dataOffi = mysqli_fetch_assoc($offiRes);
                    if ($dataOffi['rSuffix'] == "N/A"){
                        $official = $dataOffi['rFirst']." ".$dataOffi['rLast'];
                    } else{
                        $official = $dataOffi['rFirst']." ".$dataOffi['rLast']." ".$dataOffi['rSuffix'];
                    }

                    if($bOut == "001"){
                        $Comp = $bCompOut;
                        $Pers = $bPers;
                        $bOut = "001";
                    } elseif($bOut == "002"){
                        $Comp = $bComp;
                        $Pers = $bPersOut;
                        $bOut = "002";
                    } elseif($bOut == "003"){
                        $Comp = $bCompOut;
                        $Pers = $bPersOut;
                        $bOut = "003";
                    } elseif($bOut == "004"){
                        $Comp = $bComp;
                        $Pers = $bPers;
                        $bOut = "004";
                    }
                    
                } ?>

                <h1>Edit Blotter #
                    <?= $bID; ?>
                </h1>
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
                                <input type="datetime-local" id="bDateI" name="bDateI" value="<?= $bDateI ?>">

                                <label for="bLoc">Location</label>
                                <input type="text" id="bLoc" name="bLoc" value="<?= $bLoc ?>">

                                <label for="bReason">Reason</label>
                                <input type="text" id="bReason" name="bReason" value="<?= $bReason ?>">

                                <label for="bAssistID">Attended By</label>
                                <select name="bAssistID" id="bAssistID" size="1px">
                                    <option value="" selected hidden>
                                        <?= $official ?>
                                    </option>
                                    <option id="3100" value=3100>Ernesto C. Roque Jr.</option>
                                    <option id="3101" value=3101>Rosario R. Dela Rosa</option>
                                    <option id="3102" value=3102>Rene R. Abraham</option>
                                    <option id="3103" value=3103>Proceso C. Roque</option>
                                    <option id="3104" value=3104>Esvetlana H. Tobias</option>
                                    <option id="3105" value=3105>Dexter A. Palopalo</option>
                                    <option id="3106" value=3106>Julieta C. Chico</option>
                                    <option id="3107" value=3107>Hernando L. Santiago</option>
                                </select>

                            </div>
                            <div class="right">
                                <label for="bComp">Complainant</label>
                                <input type="text" id="bComp" name="bComp"
                                    value="<?= $Comp ?>">

                                <label for="bPers">Person to Complain</label>
                                <input type="text" id="bPers" name="bPers"
                                    value="<?= $Pers ?>">

                                <label for="bAction">Action Made</label>
                                <input type="text" id="bAction" name="bAction" value="<?= $bAction ?>">

                                <label for="bStatus">Status</label>
                                <select name="bStatus" id="bStatus" required size="1px">
                                    <option value="<?= $bStatus ?>" selected hidden><?= $bStatus ?>
                                    </option>
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
                            $bID = $_GET['bID'];
                            include("config.php");

                            $bDateI = $_POST['bDateI'];
                            $bLoc = trim($_POST['bLoc']);
                            $bReason = trim($_POST['bReason']);
                            $bAction = trim($_POST['bAction']);
                            $bStatus = $_POST['bStatus'];
                            if (empty($_POST['bAssistID'])) {
                                $bAssistID = $officialID;
                            } else {
                                $bAssistID = $_POST['bAssistID'];
                            }

                            $compTest = trim($_POST['bComp']);
                            $persTest = trim($_POST['bPers']);
                            
                            $test = "SELECT * FROM tblblotter WHERE bID = $bID";
                            $testRes = $conn->query($test);
                            $fetchTest = mysqli_fetch_assoc($testRes);

                            if ($compTest == $fetchTest['bCompOut'] && $persTest != $fetchTest['bPersOut']
                                && $bOut == "001"){ //001
                                $bOut = "001";

                                $bPers = explode(" ", trim($_POST['bPers']));
                                $fnamepers = $bPers[0];
                                $persLen = count($bPers) - 1;

                                $testB = "SELECT * FROM tblresidents WHERE rFirst LIKE '%$fnamepers%'";
                                $resB = $conn->query($testB);
                                while($dataB = mysqli_fetch_assoc($resB)){
                                if ($dataB['rSuffix'] == $bPers[$persLen]){
                                    $rFirstPERS = $bPers[0];
                                    $rSuffixPERS = $bPers[$persLen];
                                    $rLastPERS = $bPers[$persLen-1];
                                } else {             
                                    if ($bPers == 3){
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
                                }
                            }

                            $getPersID = "SELECT tblresidents.* FROM tblresidents 
                            WHERE tblresidents.rFirst LIKE '%$rFirstPERS%' AND
                            tblresidents.rLast LIKE '%$rLastPERS%' AND tblresidents.rSuffix LIKE '%$rSuffixPERS%'";
                            $persRes = mysqli_query($conn, $getPersID);
                            $data2 = mysqli_fetch_assoc($persRes);
                            $persID = $data2['aID'];

                            $nameComp = $compTest;

                            if ($data2['rSuffix'] == "N/A"){
                                $namePers = $data2['rFirst']." ".$data2['rLast'];
                            } else{
                                $namePers = $data2['rFirst']." ".$data2['rLast']." ".$data2['rSuffix'];
                            }

                        }

                        else if ($compTest != $fetchTest['bCompOut'] && $persTest == $fetchTest['bPersOut']
                            && $bOut == "002"){ //002
                            $bOut = "002";
                            
                            $bComp = explode(" ", trim($_POST['bComp']));
                            $fnamecomp = $bComp[0];
                            $compLen = count($bComp) - 1;

                            $testA = "SELECT * FROM tblresidents WHERE rFirst LIKE '%$fnamecomp%'";
                            $resA = $conn->query($testA);
                            while($dataA = mysqli_fetch_assoc($resA)){
                                if ($dataA['rSuffix'] == $bComp[$compLen]){
                                    $rFirst = $bComp[0];
                                    $rSuffix = $bComp[$compLen];
                                    $rLast = $bComp[$compLen-1];
                                } else {             
                                    if ($bComp == 3){
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
                                }
                            }

                            $getCompID = "SELECT tblresidents.* FROM tblresidents 
                            WHERE tblresidents.rFirst LIKE '%$rFirst%' AND
                            tblresidents.rLast LIKE '%$rLast%' AND tblresidents.rSuffix LIKE '%$rSuffix%'";
                            $compRes = mysqli_query($conn, $getCompID);
                            $data = mysqli_fetch_array($compRes);
                            $compID = $data['aID'];

                            if ($data['rSuffix'] == "N/A"){
                                $nameComp = $data['rFirst']." ".$data['rLast'];
                            } else{
                                $nameComp = $data['rFirst']." ".$data['rLast']." ".$data['rSuffix'];
                            }
                            $namePers = $persTest;

                        }
                            
                        else if ($compTest == $fetchTest['bCompOut'] && $persTest == $fetchTest['bPersOut']
                            && $bOut == "003"){ //003
                            $bOut = "003";
                            
                            $nameComp = $compTest;
                            $namePers = $persTest;
                        }

                        else if ($compTest != $fetchTest['bCompOut'] && $persTest != $fetchTest['bPersOut']
                            && $bOut == "004"){ //004
                            $bOut = "004";
                            
                            $bComp = explode(" ", trim($_POST['bComp']));
                            $fnamecomp = $bComp[0];
                            $compLen = count($bComp) - 1;

                            $testA = "SELECT * FROM tblresidents WHERE rFirst LIKE '%$fnamecomp%'";
                            $resA = $conn->query($testA);
                            while($dataA = mysqli_fetch_assoc($resA)){
                                if ($dataA['rSuffix'] == $bComp[$compLen]){
                                    $rFirst = $bComp[0];
                                    $rSuffix = $bComp[$compLen];
                                    $rLast = $bComp[$compLen-1];
                                } else {             
                                    if ($bComp == 3){
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
                                }
                            }

                            $getCompID = "SELECT tblresidents.* FROM tblresidents 
                            WHERE tblresidents.rFirst LIKE '%$rFirst%' AND
                            tblresidents.rLast LIKE '%$rLast%' AND tblresidents.rSuffix LIKE '%$rSuffix%'";
                            $compRes = mysqli_query($conn, $getCompID);
                            $data = mysqli_fetch_array($compRes);
                            $compID = $data['aID'];

                            if ($data['rSuffix'] == "N/A"){
                                $nameComp = $data['rFirst']." ".$data['rLast'];
                            } else{
                                $nameComp = $data['rFirst']." ".$data['rLast']." ".$data['rSuffix'];
                            }

                            $bPers = explode(" ", trim($_POST['bPers']));
                                $fnamepers = $bPers[0];
                                $persLen = count($bPers) - 1;

                                $testB = "SELECT * FROM tblresidents WHERE rFirst LIKE '%$fnamepers%'";
                                $resB = $conn->query($testB);
                                while($dataB = mysqli_fetch_assoc($resB)){
                                if ($dataB['rSuffix'] == $bPers[$persLen]){
                                    $rFirstPERS = $bPers[0];
                                    $rSuffixPERS = $bPers[$persLen];
                                    $rLastPERS = $bPers[$persLen-1];
                                } else {             
                                    if ($bPers == 3){
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
                                }
                            }

                            $getPersID = "SELECT tblresidents.* FROM tblresidents 
                            WHERE tblresidents.rFirst LIKE '%$rFirstPERS%' AND
                            tblresidents.rLast LIKE '%$rLastPERS%' AND tblresidents.rSuffix LIKE '%$rSuffixPERS%'";
                            $persRes = mysqli_query($conn, $getPersID);
                            $data2 = mysqli_fetch_assoc($persRes);
                            $persID = $data2['aID'];

                            if ($data2['rSuffix'] == "N/A"){
                                $namePers = $data2['rFirst']." ".$data2['rLast'];
                            } else{
                                $namePers = $data2['rFirst']." ".$data2['rLast']." ".$data['rSuffix'];
                            }
                        }
                             
                            if ($bOut == "001"){
                                $sql = "SELECT * FROM tblblotter WHERE bDateI= '$bDateI' AND 
                            bCompOut = '$nameComp' AND bLoc = '$bLoc' AND bPers = '$persID' 
                            AND bReason = '$bReason' AND oID = '$bAssistID' AND bAction = '$bAction'
                            AND bStatus = 'Unsolved'";
                            $result = mysqli_query($conn, $sql);
                            $resultCheck = mysqli_num_rows($result);

                            if ($resultCheck > 0){
                                echo "<br><p><font color=red>Blotter Record already Exist and still Pending</font color></p>";
                            } else {
                                $conn->query('SET foreign_key_checks = 0');

                            $query = "UPDATE tblblotter SET bDateI = '$bDateI', bCompOut = '$nameComp',
                            bLoc= '$bLoc', bPers = '$persID', bReason= '$bReason', bAction= '$bAction',
                            oID = '$bAssistID', bStatus= '$bStatus' WHERE bID = '$bID'";
                            $result = mysqli_query($conn, $query);

                            if ($result) {
                                echo "<br><p><font color=green>Data Updated</font color></p>";

                                $conn->query('SET foreign_key_checks = 1');

                            $updateStat = "SELECT * FROM tblblotter WHERE bStatus='Solved' || bStatus='Unsolved'";
                            $res1 = $conn->query($updateStat);
                            $fetchPersID = mysqli_fetch_assoc($res1);
                            $numRows = mysqli_num_rows($res1);
                            $bStatus = $fetchPersID['bStatus'];
                            $persID = $fetchPersID['bPers'];

                            if ($numRows > 0) {

                                if ($bStatus == "Solved") {
                                    $resident = "Resident";
                                    $changeStat = "UPDATE tblaccess SET aType='$resident' WHERE aID = $persID";
                                    $result = mysqli_query($conn, $changeStat);

                                } else if ($bStatus == "Unsolved") {
                                    $resident = "Restricted";
                                    $changeStat = "UPDATE tblaccess SET aType='$resident' WHERE aID = $persID";
                                    $result = mysqli_query($conn, $changeStat);
                                }
                            }
                        } else {
                                echo "<br><p><font color=green>Data Not Updated</font color></p>";
                            }
                            mysqli_close($conn);

                        }

                    } else if ($bOut == "002"){
                        $sql = "SELECT * FROM tblblotter WHERE bDateI= '$bDateI' AND 
                            bComp = '$compID' AND bLoc = '$bLoc' AND bPersOut = '$namePers' 
                            AND bReason = '$bReason' AND bAction = '$bAction' AND 
                            oID = '$bAssistID' AND bStatus = 'Unsolved'";
                            $result = mysqli_query($conn, $sql);
                            $resultCheck = mysqli_num_rows($result);

                            if ($resultCheck > 0){
                                echo "<br><p><font color=red>Blotter Record already Exist and still Pending</font color></p>";
                            } else {
                                $conn->query('SET foreign_key_checks = 0');

                            $query = "UPDATE tblblotter SET bDateI = '$bDateI', bComp = '$compID',
                            bLoc= '$bLoc', bPersOut = '$namePers', bReason= '$bReason', bAction= '$bAction',
                            oID = '$bAssistID', bStatus= '$bStatus' WHERE bID = '$bID'";
                            $result = mysqli_query($conn, $query);

                            if ($result) {
                                echo "<br><p><font color=green>Data Updated</font color></p>";
                            } else {
                                echo "<br><p><font color=green>Data Not Updated</font color></p>";
                            }                            
                            mysqli_close($conn);

                        }
                    
                    } else if ($bOut == "003"){
                        $sql = "SELECT * FROM tblblotter WHERE bDateI= '$bDateI' AND 
                            bCompOut = '$nameComp' AND bLoc = '$bLoc' AND bPersOut = '$namePers' 
                            AND bReason = '$bReason' AND bAction = '$bAction'
                            AND oID = '$bAssistID' AND bStatus = 'Unsolved'";
                            $result = mysqli_query($conn, $sql);
                            $resultCheck = mysqli_num_rows($result);

                            if ($resultCheck > 0){
                                echo "<br><p><font color=red>Blotter Record already Exist and still Pending</font color></p>";
                            } else {
                                $conn->query('SET foreign_key_checks = 0');

                            $query = "UPDATE tblblotter SET bDateI = '$bDateI', bCompOut = '$nameComp',
                            bLoc= '$bLoc', bPersOut = '$namePers', bReason= '$bReason', bAction= '$bAction',
                            oID = '$bAssistID', bStatus= '$bStatus' WHERE bID = '$bID'";
                            $result = mysqli_query($conn, $query);

                            if ($result) {
                                echo "<br><p><font color=green>Data Updated</font color></p>";

                                $conn->query('SET foreign_key_checks = 1');

                            $updateStat = "SELECT * FROM tblblotter WHERE bStatus='Solved' || bStatus='Unsolved'";
                            $res1 = $conn->query($updateStat);
                            $fetchPersID = mysqli_fetch_assoc($res1);
                    
                            mysqli_close($conn);

                            }
                                
                        }         
                    
                    } else if ($bOut == "004"){
                        $sql = "SELECT * FROM tblblotter INNER JOIN tblresidents ON
                            tblblotter.bPers=tblresidents.aID INNER JOIN tblaccess ON
                            tblblotter.bComp=tblaccess.aID INNER JOIN tblofficials ON
                            tblofficials.oID=tblblotter.oID WHERE bDateI= '$bDateI' AND 
                            bComp = '$compID' AND bLoc = '$bLoc' AND bAction = '$bAction'
                            AND bPers = '$persID' AND bReason = '$bReason'
                            AND bStatus = 'Unsolved'";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_array($result);
                            $resultCheck = mysqli_num_rows($result);

                            $conn->query('SET foreign_key_checks = 0');

                            $query = "UPDATE tblblotter SET bDateI = '$bDateI', bComp = '$compID', bLoc= '$bLoc', 
                            bPers = '$persID', bReason= '$bReason', bAction= '$bAction', oID = '$bAssistID',
                            bStatus= '$bStatus' WHERE bID = '$bID'";
                            $result = mysqli_query($conn, $query);

                            if ($result) {
                                echo "<br><p><font color=green>Data Updated</font color></p>";
                            } else {
                                echo "<br><p><font color=green>Data Not Updated</font color></p>";
                            }

                            $conn->query('SET foreign_key_checks = 1');

                            $updateStat = "SELECT * FROM tblblotter WHERE bStatus='Solved' || bStatus='Unsolved'";
                            $res1 = $conn->query($updateStat);
                            $fetchPersID = mysqli_fetch_assoc($res1);
                            $numRows = mysqli_num_rows($res1);
                            $bStatus = $fetchPersID['bStatus'];
                            $persID = $fetchPersID['bPers'];

                            if ($numRows > 0) {

                                if ($bStatus == "Solved") {
                                    $resident = "Resident";
                                    $changeStat = "UPDATE tblaccess SET aType='$resident' WHERE aID = $persID";
                                    $result = mysqli_query($conn, $changeStat);

                                } else if ($bStatus == "Unsolved") {
                                    $resident = "Restricted";
                                    $changeStat = "UPDATE tblaccess SET aType='$resident' WHERE aID = $persID";
                                    $result = mysqli_query($conn, $changeStat);
                                }
                            }
                            mysqli_close($conn);
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