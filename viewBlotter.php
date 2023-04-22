<?php
require('secure.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>View Blotter</title>
    <link rel="stylesheet" href="assets/css/form.css" />
    <link rel="icon" href="assets/images/bLogo.png" type="image/icon type" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />

    <style>
        table {
            width: 120%;
            height: 540px;
            font-size: 15px;
            color: #000;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            padding: 1rem;
            border-collapse: collapse;
            margin: 25px 0;

        }

        table,
        th {
            padding: 1rem 0rem 1rem 1rem;
            justify-content: center;
        }

        td {
            padding: 1rem 10rem 1rem 7rem;
            justify-content: center;
        }

        tr {
            border-bottom: 1px solid #dddddd;
        }

        th {
            background-color: #009879;
            color: #ffffff;
            text-align: center;
        }

        tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }
    </style>
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
            <div class="list">
                <div class="list1">
                    <div class="row">
                        <a href="blotter.php">Back</a>

                    </div>

                    <table>
                        <?php
                        if (isset($_GET['bID'])) {
                            $id = $_GET['bID'];
                            include("config.php");

                            $stmnt = "SELECT * FROM tblblotter WHERE bID = $id";
                            $resStmnt = $conn->query($stmnt);
                            $fetch = mysqli_fetch_assoc($resStmnt);
                            $bOut = $fetch['bOut'];
                            $bComp = $fetch['bComp'];
                            $bPers = $fetch['bPers'];

                            if ($bOut == "001"){ //comp out
                                $nameComp = $fetch['bCompOut'];

                            $sql2 = "SELECT * FROM tblresidents INNER JOIN tblblotter ON
                                tblresidents.aID=tblblotter.bPers WHERE tblresidents.aID=$bPers";
                                $res2 = mysqli_query($conn, $sql2);
                                $fetchname = mysqli_fetch_assoc($res2);
                                    if ($fetchname['rSuffix'] == "N/A"){
                                        $namePers = $fetchname['rFirst']." ".$fetchname['rLast'];
                                    } else{
                                        $namePers = $fetchname['rFirst']." ".$fetchname['rLast']." ".$fetchname['rSuffix'];
                                    }
                            }

                            else if ($bOut == "002"){
                                $sql = "SELECT * FROM tblresidents INNER JOIN tblaccess ON
                                tblresidents.aID=tblaccess.aID INNER JOIN tblblotter ON
                                tblblotter.bComp=tblaccess.aID WHERE bID = $id";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_array($result);
                                
                                    if ($row['rSuffix'] == "N/A"){
                                        $nameComp = $row['rFirst']." ".$row['rLast'];
                                    } else{
                                        $nameComp = $row['rFirst']." ".$row['rLast']." ".$row['rSuffix'];
                                    }

                                $namePers = $fetch['bPersOut'];
                            }

                            else if ($bOut == "003"){
                                $nameComp = $fetch['bCompOut'];
                                $namePers = $fetch['bPersOut'];
                            }

                            else if ($bOut == "004"){
                                $sql = "SELECT * FROM tblresidents INNER JOIN tblaccess ON
                            tblresidents.aID=tblaccess.aID INNER JOIN tblblotter ON
                            tblblotter.bComp=tblaccess.aID WHERE bID = $id";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_array($result);
                            $bPers = $row['bPers'];
                            if ($row['rSuffix'] == "N/A"){
                                $nameComp = $row['rFirst']." ".$row['rLast'];
                            } else{
                                $nameComp = $row['rFirst']." ".$row['rLast']." ".$row['rSuffix'];
                            }

                            $sql2 = "SELECT * FROM tblresidents INNER JOIN tblblotter ON
                            tblresidents.aID=tblblotter.bPers WHERE tblresidents.aID=$bPers";
                            $res2 = mysqli_query($conn, $sql2);
                            $fetchname = mysqli_fetch_assoc($res2);
                            if ($fetchname['rSuffix'] == "N/A"){
                                $namePers = $fetchname['rFirst']." ".$fetchname['rLast'];
                            } else{
                                $namePers = $fetchname['rFirst']." ".$fetchname['rLast']." ".$fetchname['rSuffix'];
                            }

                            }
     

                            $official = "SELECT * FROM tblblotter WHERE bID=$id";
                            $res3 = $conn->query($official);
                            $fetchOffID = mysqli_fetch_assoc($res3);
                            $offID = $fetchOffID['oID'];

                            $getOfficialID = "SELECT tblresidents.* FROM tblresidents INNER JOIN tblaccess ON
                            tblaccess.aID=tblresidents.aID INNER JOIN tblofficials ON
                            tblaccess.aID=tblofficials.aID INNER JOIN tblblotter ON
                            tblblotter.oID=tblofficials.oID WHERE tblofficials.oID=$offID";
                            $offRes = mysqli_query($conn, $getOfficialID);
                            $data3 = mysqli_fetch_assoc($offRes);
                            if ($data3['rSuffix'] == "N/A"){
                                $nameOff = $data3['rFirst']." ".$data3['rLast'];
                            } else{
                                $nameOff = $data3['rFirst']." ".$data3['rLast']." ".$data3['rSuffix'];
                            }

                        }
                        ?>
                        <thead>
                            <th>
                                <h4>Header</h4>
                            </th>
                            <th>
                                <h4> Details</h4>
                            </th>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Blotter ID</strong></td>
                                <td>
                                    <?php echo $fetch["bID"] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Date Recorded</strong></td>
                                <td>
                                    <?php echo $fetch["bDateR"] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Date and Time of Incident</strong></td>
                                <td>
                                    <?php echo $fetch["bDateI"] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Complainant's Name</strong></td>
                                <td>
                                    <?php echo $nameComp?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Location</strong></td>
                                <td>
                                    <?php echo $fetch["bLoc"] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Person to Complain</strong></td>
                                <td>
                                    <?php echo $namePers ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Reason</strong></td>
                                <td>
                                    <?php echo $fetch["bReason"] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Action Made</strong></td>
                                <td>
                                    <?php echo $fetch["bAction"] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Attended By</strong></td>
                                <td>
                                    <?php echo $nameOff ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Status</strong></td>
                                <td>
                                    <?php echo $fetch["bStatus"] ?>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>