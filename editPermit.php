<?php
require('secure.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Edit Permit</title>
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

        if ($_SESSION['role'] == 'Resident' or $_SESSION['role'] == 'SK Chairman' || $_SESSION['role'] == 'Treasurer') {
            ?>
            <nav>
                <div class="side_navbar">
                    <span>Apply Online</span>

                    <a href="clearance.php">Clearances</a>
                    <a href="permit.php" class="active">Permits</a>
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
                <h1>Edit Permit</h1>
            </div>

            <div class="list">
                <div class="list1">
                    <div class="row">
                        <a href="permit.php">Back</a>
                    </div>
                    <?php

                    if (isset($_GET['pID'])) {
                        $pID = $_GET['pID'];
                    }

                    include('config.php');
                    $sql = "SELECT * FROM tblPermit WHERE pID = '$pID'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);

                    ?>
                    <div class="wrapper">

                        <?php
                        if ($_SESSION['role'] == 'Resident' or $_SESSION['role'] == 'SK Chairman' || $_SESSION['role'] == 'Treasurer') {
                            ?>
                            <?php
                            $fetchStatus = $row['pStatus'];
                            if ($fetchStatus == "Pending") { ?>
                                <form action="" method="post">
                                    <div class="left">
                                        <label for="pBName">Business Name</label>
                                        <input type="text" id="pBName" name="pBName" value="<?= $row['pBName']; ?>">

                                        <label for="pBType">Type</label>
                                        <input type="text" id="pBType" name="pBType" value="<?= $row['pBType']; ?>">

                                    </div>
                                    <div class="right">
                                        <label for="pBAdd">Address</label>
                                        <input type="text" id="pBAdd" name="pBAdd" value="<?= $row['pBAdd']; ?>">

                                    </div>
                                    <div class="submit">
                                        <input type="submit" value="Save" name="save">
                                    </div>
                                </form>
                                <?php

                                if (isset($_POST['save'])) {
                                    include('config.php');
                                    if (isset($_GET['pID'])) {
                                        $pID = $_GET['pID'];
                                    }

                                    $pBName = htmlspecialchars($_POST['pBName']);
                                    $pBType = $_POST['pBType'];
                                    $pBAdd = $_POST['pBAdd'];


                                    $query = "UPDATE tblpermit SET pBName = '$pBName',
                                    pBType = '$pBType',pBAdd = '$pBAdd' WHERE pID = '$pID'";
                                    $result = mysqli_query($conn, $query);
                                    echo "<br><p><font color=green>Successfully Finalized</font color></p>";
                                    $conn->close();
                                }
                                ?>
                                <?php
                            }
                        } elseif ($_SESSION['role'] == 'Secretary') {
                            ?>
                            <?php
                            if (isset($_GET['pID'])) {
                                $pID = $_GET['pID'];
                            }
                            $fetchStatus = $row['pStatus'];
                            if ($fetchStatus == "Approved") { ?>

                                <?php
                                if (empty($row['pAmount'])) {
                                    $pAmount = "";
                                } else {
                                    $pAmount = $row['pAmount'];
                                }
                                if (empty($row['pOR'])) {
                                    $pOR = "";
                                } else {
                                    $pOR = $row['pOR'];
                                }
                                if (empty($row['pNum'])) {
                                    $pNum = "";
                                } else {
                                    $pNum = $row['pNum'];
                                }

                                ?>
                                <form action="" method="post">
                                    <div class="left">
                                        <label for="pBName">Business Name</label>
                                        <input type="text" id="pBName" name="pBName" value="<?= $row['pBName']; ?>">

                                        <label for="pBAdd">Business Address</label>
                                        <select name="pBAdd" id="pBAdd" required size="1px">
                                            <option value="<?= $row['pBAdd']; ?>" selected><?= $row['pBAdd']; ?></option>
                                            <option value="Purok 1">Purok 1</option>
                                            <option value="Purok 2">Purok 2</option>
                                            <option value="Purok 3">Purok 3</option>
                                            <option value="Purok 4">Purok 4</option>
                                            <option value="Purok 5">Purok 5</option>
                                            <option value="Purok 6">Purok 6</option>
                                            <option value="Purok 7">Purok 7</option>
                                        </select>

                                        <label for="pAmount">Amount</label>
                                        <input type="text" id="pAmount" name="pAmount" value="<?= $pAmount; ?>">

                                    </div>
                                    <div class="right">
                                        <label for="pBType">Business Type</label>
                                        <input type="text" id="pBType" name="pBType" value="<?= $row['pBType']; ?>">

                                        <label for="pNum">Permit Control Number</label>
                                        <input type="text" id="pNum" name="pNum" value="<?= $row['pNum']; ?>">

                                        <label for="pOR">OR Number</label>
                                        <input type="text" id="pOR" name="pOR" value="<?= $row['pOR']; ?>">
                                    </div>
                                    <div class="submit">
                                        <input type="submit" value="Save" name="save">
                                    </div>
                                </form>
                                <?php

                                if (isset($_POST['save'])) {
                                    include('config.php');

                                    $pBName = htmlspecialchars($_POST['pBName']);
                                    $pBType = $_POST['pBType'];
                                    $pBAdd = $_POST['pBAdd'];
                                    $pOR = $_POST['pOR'];

                                    $pAmount = $_POST['pAmount'];
                                    $pNum = $_POST['pNum'];
                                    $pBAdd = $_POST['pBAdd'];
                                    $pFindings ="N/A";

                                    $query = "UPDATE tblPermit SET pFindings='$pFindings', pBName = '$pBName',
                                    pBType = '$pBType', pBAdd = '$pBAdd', pOR = '$pOR', pAmount = '$pAmount', 
                                    pNum = '$pNum', pBAdd = '$pBAdd' WHERE pID = '$pID'";
                                    $result = mysqli_query($conn, $query);
                                    echo "<br><p><font color=green>Successfully Finalized</font color></p>";
                                    $conn->close();
                                }
                                ?>
                                <?php
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