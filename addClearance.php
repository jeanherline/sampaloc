<?php
require('secure.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Request Clearance</title>
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
        <?php if ($_SESSION['role'] == 'Restricted') { ?>
            <nav>
                <div class="side_navbar">
                    <span>Apply Online</span>

                    <a href="clearance.php" class="active">Clearances</a>
                    <a href="permit.php">Permits</a>
                    <span></span>

                    <span>Quick Link</span>
                    <a href="index.php">Home Page</a>
                    <a href="https://www.facebook.com/profile.php?id=100064518436649">Facebook Page</a>
                </div>
            </nav>
            <?php
            ?>

            <div class="main-body">
                <div class="promo_card">
                    <h1>Request for Clearance</h1>
                </div>

                <div class="list">
                    <div class="list1">
                        <div class="row">
                            <a href="clearance.php">Back</a>
                        </div>
                        <div class="wrapper">
                            <form action="" method="post">
                                <label for="cPurpose">Purpose</label><br>

                                <textarea rows="10" cols="50" id="cPurpose" name="cPurpose" disabled="disabled"
                                    value="">You Have An Existing Blotter Record</textarea>
                                <div class="submit">
                                    <input type="submit" value="Apply" name="save" disabled="disabled">
                                </div>


                            <?php } elseif (
            $_SESSION['role'] == 'Resident' or
            $_SESSION['role'] == 'SK Chairman' or $_SESSION['role'] == 'Treasurer'
        ) {
            $userid = $_SESSION['userid']?>

                                <nav>
                                    <div class="side_navbar">
                                        <span>Apply Online</span>

                                        <a href="clearance.php" class="active">Clearances</a>
                                        <a href="permit.php">Permits</a>
                                        <span></span>

                                        <span>Quick Link</span>
                                        <a href="index.php">Home Page</a>
                                        <a href="https://www.facebook.com/profile.php?id=100064518436649">Facebook Page</a>
                                    </div>
                                </nav>
                                <?php
                                ?>

                                <div class="main-body">
                                    <div class="promo_card">
                                        <h1>Request for Clearance</h1>
                                    </div>

                                    <div class="list">
                                        <div class="list1">
                                            <div class="row">
                                                <a href="clearance.php">Back</a>
                                            </div>
                                            <div class="wrapper">
                                                <form action="" method="post">
                                                    <label for="cPurpose">Purpose</label><br>
                                                    <textarea rows="10" cols="50" id="cPurpose" name="cPurpose"
                                                        placeholder="State your purpose" required></textarea>
                                                    <div class="submit">
                                                        <input type="submit" value="Apply" name="save">
                                                    </div>

                                                </form>
                                            <?php }
        if (isset($_POST['save'])) {
            include('config.php');

            $cPurpose = trim($_POST['cPurpose']);

            $sql = "SELECT * FROM tblclearance WHERE cPurpose= '$cPurpose' AND cStatus = 'Pending' AND aID=$userid";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            $resultCheck = mysqli_num_rows($result);

            if ($resultCheck > 0) {
                echo "<br><p><font color=red>Duplicate Clearance Request</font color></p>";
            } else {
                $userid = $_SESSION['userid'];
                $username = $_SESSION['username'];
                $pen = "Pending";

                $INSERT = "INSERT INTO tblclearance (cPurpose, cStatus, aID) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($INSERT);
                $stmt->bind_param("ssi", $cPurpose, $pen, $userid);
                $stmt->execute();
                echo "<br><p><font color=green>Successfully Requested</font color></p>";
                $stmt->close();
            }

            $conn->close();
        }
        ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
</body>

</html>