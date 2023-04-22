<?php
require('secure.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Edit Official</title>
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
                <a href="officials.php" class="active">Brgy. Officials</a>
                <a href="residents.php">Residents Info</a>
                <a href="blotter.php">Blotter Records</a>
                <a href="clearance.php">Clearances</a>
                <a href="permit.php">Permits</a>
                <span></span>

                <div class="links">
                    <span>Quick Link</span>
                    <a href="#">Facebook</a>
                    <a href="#">Twitter</a>
                    <a href="#">Instagram</a>
                </div>
            </div>
        </nav>

        <div class="main-body">
            <div class="promo_card">
                <?php
                if (isset($_GET['aID'])) {
                    $posi = $_GET['aID'];
                }
                ?>
                <h1>Edit Official's Information</h1>
            </div>

            <div class="list">
                <div class="list1">
                    <div class="row">
                        <a href="officials.php">Back</a>
                    </div>
                    <?php
                    include('config.php');
                    $sql = "SELECT * FROM tblofficials INNER JOIN tblaccess ON
                    tblaccess.aID=tblofficials.aID INNER JOIN tblresidents ON
                    tblaccess.aID=tblresidents.aID WHERE tblaccess.aID = '$posi'";
                    $result = mysqli_query($conn, $sql);
                    $fet = mysqli_fetch_assoc($result);

                    if ($fet['rSuffix'] == "N/A") {
                        $offName = $fet['rFirst'] . " " . $fet['rLast'];
                    } else {
                        $offName = $fet['rFirst'] . " " . $fet['rLast'] . " " . $fet['rSuffix'];
                    }
                    
                    $add = $fet['rHouse'] . ", " . $fet['rPurok'];
                    $endOfTerm = $fet['oTermE'];
                    $startOfTerm = $fet['oTermS'];
                    $contact = $fet['rContact'];


                    ?>
                    <div class="wrapper">
                        <form action="" method="post">

                            <div class="left">

                                <label for="oName">Official's Name</label>
                                <input type="text" id="oName" name="oName" value="<?php echo $offName ?>" required>

                                <label for="">Address</label>
                                <input type="text" id="oAdd" name="oAdd" value="<?php echo $add ?>" required>

                                <label for="oTermE">End of Term</label>
                                <input type="date" id="oTermE" name="oTermE" value="<?php echo $endOfTerm?>" required>

                            </div>
                            <div class="right">
                                <label for="oCont">Contact Number</label>
                                <input type="number" id="oCont" name="oCont" value="<?php echo $contact ?>" required>

                                <label for="oTermS">Start of Term</label>
                                <input type="date" id="oTermS" name="oTermS" value="<?php echo $startOfTerm?>" required>

                            </div>
                            <div class="submit">
                                <input type="submit" value="Save" name="save">
                            </div>
                        </form>

                        <?php
                        if (isset($_POST['save'])) {
                            include("config.php");

                            $oName = explode(" ", trim($_POST['oName']));
                            $offFname= $oName[0];
                            $nameLen = count($oName) - 1;

                            $testA = "SELECT * FROM tblresidents WHERE rFirst LIKE '%$offFname%'";
                            $resA = $conn->query($testA);
                            while($dataA = mysqli_fetch_assoc($resA)){
                                if ($dataA['rSuffix'] == $oName[$nameLen]){
                                    $rFirst = $oName[0];
                                    $rSuffix = $oName[$nameLen];
                                    $rLast = $oName[$nameLen-1];
                                } else {             
                                    if ($oName == 3){
                                        $lname = $oName[$nameLen-1]." ".$oName[$nameLen];  
                                        $fname = $offFname." ".$oName[$nameLen-1];

                                        if ($dataA['rLast'] == $lname){
                                            $rFirst = $oName[0];
                                            $rLast = $lname;
                                            $rSuffix = "N/A";
                                        } else if ($dataA['rFirst'] == $fname){
                                            $rFirst = $fname;
                                            $rLast = $oName[$nameLen];
                                            $rSuffix = "N/A";
                                        }
                                    } else {
                                        $rFirst = $oName[0];
                                        $rLast = $oName[$nameLen];
                                        $rSuffix = "N/A";
                                    }   
                                }
                            }

                            $oCont = $_POST['oCont'];
                            $oAdd = $_POST['oAdd'];
                            $oTermS = $_POST['oTermS'];
                            $oTermE = $_POST['oTermE'];

                            $sel = "SELECT * FROM tblofficials INNER JOIN tblaccess ON
                            tblofficials.aID=tblaccess.aID INNER JOIN tblresidents ON
                            tblresidents.aID=tblaccess.aID WHERE tblresidents.aID='$posi'";
                            $res3 = $conn->query($sel);
                            $fetch = mysqli_fetch_assoc($res3);
                            $oid = $fetch['oID'];

                            $query = "UPDATE tblresidents SET rFirst= '$rFirst', rLast = '$rLast', rSuffix='$rSuffix',
                            rContact= '$oCont' ,rHouse= '$oAdd' WHERE aID = '$posi'";
                            $result = mysqli_query($conn, $query);

                            if ($result) {
                                echo "<br><p><font color=green>Data for Approval</font color></p>";
                                $updateoff = "UPDATE tblofficials SET oTermS= '$oTermS' , oTermE= '$oTermE', 
                                oStatus = 'Pending' WHERE oID = '$oid'";
                                $result2 = mysqli_query($conn, $updateoff);

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