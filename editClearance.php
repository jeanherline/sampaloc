<?php
require('secure.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Edit Clearance</title>
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

        if ($_SESSION['role'] == 'Resident' or $_SESSION['role'] == 'SK Chairman' or $_SESSION['role'] == 'Treasurer') {
            ?>
            <nav>
                <div class="side_navbar">
                    <span>Apply Online</span>

                    <a href="clearance.php" class="active">Clearances</a>
                    <a href="permit.php">Permits</a>
                    <a href="blotter.php">Account</a>
                    <span></span>

                    <span>Quick Link</span>
                    <a href="index.php">Home Page</a>
                    <a href="https://www.facebook.com/profile.php?id=100064518436649">Facebook Page</a>
                </div>
            </nav>
        <?php } elseif ($_SESSION['role'] == 'Secretary') {
            ?>
            <nav>
                <div class="side_navbar">
                    <span>Main Menu</span>
                    <a href="officials.php">Brgy. Officials</a>
                    <a href="residents.php">Residents Info</a>
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
                <h1>Edit Clearance</h1>
            </div>

            <div class="list">
                <div class="list1">
                    <div class="row">
                        <a href="clearance.php">Back</a>
                    </div>
                    <?php

                    if (isset($_GET['cID'])) {
                        $cID = $_GET['cID'];
                    }

                    include('config.php');
                    $sql = "SELECT * FROM tblClearance WHERE cID = '$cID'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);

                    ?>
                    <div class="wrapper">
                        <?php
                        if ($_SESSION['role'] == 'Resident' or $_SESSION['role'] == 'SK Chairman' or $_SESSION['role'] == 'Treasurer') {
                            ?>
                             <?php
                            $fetchStatus = $row['cStatus'];
                            if ($fetchStatus == "Pending") { ?> 
                                <form action="" method="post">
                                    <label for="cPurpose">Purpose</label><br>
                                    <textarea rows="10" cols="50" id="cPurpose" name="cPurpose"
                                        value=""><?= $row['cPurpose']; ?></textarea>
                                    <div class="submit">
                                        <input type="submit" value="Apply" name="save">
                                    </div>
                                </form>
                                <?php
                                if (isset($_POST['save'])) {
                                    include('config.php');

                                    $cPurpose = $_POST['cPurpose'];

                                    $sql = "SELECT * FROM tblclearance WHERE cPurpose= '$cPurpose' AND cID = '$cID'";
                                    $result = mysqli_query($conn, $sql);
                                    $resultCheck = mysqli_num_rows($result);

                                    if ($resultCheck > 0) {
                                        echo "<br><p><font color=red>You entered the same purpose.</font color></p>";
                                    } else {
                                        $query = "UPDATE tblclearance SET cPurpose = '$cPurpose' WHERE cID = '$cID'";
                                        $result = mysqli_query($conn, $query);
                                        echo "<br><p><font color=green>Successfully Finalized</font color></p>";
                                    }
                                    mysqli_close($conn);
                                }
                            }

                        } elseif ($_SESSION['role'] == 'Secretary') {
                            ?>
                            <form action="" method="post">
                                <div class="left">
                                    <label for="cNum">Clearance Control Number</label>
                                    <input type="text" id="cNum" name="cNum" value="<?= $row['cNum']; ?>">

                                    <label for="cOR">OR Number</label>
                                    <input type="text" id="cOR" name="cOR" value="<?= $row['cOR']; ?>">
                                </div>
                                <div class="right">
                                    <label for="cAmount">Amount</label>
                                    <input type="number" id="cAmount" name="cAmount" value="<?= $row['cAmount']; ?>">

                                    <label for="cPurpose">Purpose</label>
                                    <input type="text" id="cPurpose" name="cPurpose" value="<?= $row['cPurpose']; ?>">
                                </div>
                                <div class="submit">
                                    <input type="submit" value="Save" name="save">
                                </div>
                            </form>
                            <?php
                            if (isset($_POST['save'])) {
                                include('config.php');

                                $cNum = $_POST['cNum'];
                                $cOR = $_POST['cOR'];
                                $cAmount = $_POST['cAmount'];
                                $cPurpose = $_POST['cPurpose'];
                                $cFindings = "N/A";


                                $query = "UPDATE tblclearance SET cFindings= '$cFindings', cNum = '$cNum', cOR = '$cOR', cAmount = $cAmount, cPurpose = '$cPurpose' WHERE cID = '$cID'";
                                $result = mysqli_query($conn, $query);
                                echo "<br><p><font color=green>Successfully Finalized</font color></p>";
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