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
        <?php
        if ($_SESSION['role'] == 'Restricted') { ?>
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
                            <a href="permit.php">Back</a>
                        </div>
                        <div class="wrapper">
                            <form action="" method="post">
                                <div class="left">
                                    <label for="pBName">Business Name</label>
                                    <input type="text" id="pBName" name="pBName" disabled="disabled" value="">You Have An
                                    Existing Blotter Record</input>

                                    <label for="pBType">Type</label>
                                    <input type="text" id="pBType" name="pBType" placeholder="Enter Business Type" disabled>

                                </div>
                                <div class="right">
                                    <label for="pBAdd">Address</label>
                                    <input type="text" id="pBAdd" name="pBAdd" placeholder="Enter Business Address"
                                        disabled>

                                </div>
                                <div class="submit">
                                    <input type="submit" value="Save" name="save" disabled>
                                </div>
                            </form>

                        <?php } elseif (
            $_SESSION['role'] == 'Resident' or
            $_SESSION['role'] == 'SK Chairman' or $_SESSION['role'] == 'Treasurer'
        ) { $userid = $_SESSION['userid'];
            ?>
                            <nav>
                                <div class="side_navbar">
                                    <span>Apply Online</span>

                                    <a href="clearance.php">Clearances</a>
                                    <a href="permit.php" class="active">Permits</a>
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
                                <h1>Request for Permit</h1>
                            </div>

                            <div class="list">
                                <div class="list1">
                                    <div class="row">
                                        <a href="permit.php">Back</a>
                                    </div>
                                    <div class="wrapper">
                                        <form action="" method="post">
                                            <div class="left">
                                                <label for="pBName">Business Name</label>
                                                <input type="text" id="pBName" name="pBName"
                                                    placeholder="Enter Business Name" required>

                                                <label for="pBType">Type</label>
                                                <input type="text" id="pBType" name="pBType"
                                                    placeholder="Enter Business Type" required>

                                            </div>
                                            <div class="right">
                                                <label for="pBAdd">Address</label>
                                                <select name="pBAdd" id="pBAdd" required>
                                                    <option value="" disabled selected hidden>Select Business Address
                                                    </option>
                                                    <option value="Purok 1">Purok 1</option>
                                                    <option value="Purok 2">Purok 2</option>
                                                    <option value="Purok 3">Purok 3</option>
                                                    <option value="Purok 4">Purok 4</option>
                                                    <option value="Purok 5">Purok 5</option>
                                                    <option value="Purok 6">Purok 6</option>
                                                    <option value="Purok 7">Purok 7</option>
                                                </select>
                                            </div>
                                            <div class="submit">
                                                <input type="submit" value="Save" name="save">
                                            </div>
                                        </form>
                                        <?php

                                        if (isset($_POST['save'])) {
                                            include('config.php');
                                            $userid = $_SESSION['userid'];

                                            //$pBName = mysqli_real_escape_string($conn,$_POST['pBName']);
                                            $pBName = htmlspecialchars(trim($_POST['pBName']));
                                            $pBType = trim($_POST['pBType']);
                                            $pBAdd = $_POST['pBAdd'];

                                            $sql = "SELECT * FROM tblpermit WHERE pBName= '$pBName' AND pStatus = 'Pending' AND aID = $userid";
                                            $result = mysqli_query($conn, $sql);
                                            $row = mysqli_fetch_array($result);
                                            $resultCheck = mysqli_num_rows($result);

                                            if ($resultCheck > 0) {
                                                echo "<br><p><font color=red>Duplicate Permit Request</font color></p>";
                                            } else {
                                                $pending = "Pending";
                                                $amount = "500";
                                                $add = $pBAdd.", Sampaloc, San Rafael Bulacan";
                                                $INSERT = "INSERT INTO tblpermit (pBName, pBType, pBAdd, pStatus, pAmount, aID) 
                                VALUES (?, ?, ?, ?, ?, ?)";
                                                $stmt = $conn->prepare($INSERT);
                                                $stmt->bind_param("sssssi", $pBName, $pBType, $add, $pending, $amount, $userid);
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