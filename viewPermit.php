<?php
require('secure.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>View Permit</title>
    <link rel="stylesheet" href="assets/css/form.css" />
    <link rel="icon" href="assets/images/bLogo.png" type="image/icon type" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />

    <style>
        table {
            width: 100%;
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
            padding: 1rem 1rem 1rem 1rem;
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
                    <a href="blotter.php">Blotter Records</a>
                    <a href="clearance.php">Clearances</a>
                    <a href="permit.php" class="active">Permits</a>
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
                    <a href="residents.php">Residents Info</a>
                    <a href="clearance.php">Clearances</a>
                    <a href="permit.php" class="active">Permits</a>
                    <a href="usertype.php">User Type</a>
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
                    <a href="blotter.php">Blotter Records</a>
                    <a href="clearance.php">Clearances</a>
                    <a href="permit.php" class="active">Permits</a>
                    <span></span>

                    <span>Quick Link</span>
                        <a href="index.php">Home Page</a>
                        <a href="https://www.facebook.com/profile.php?id=100064518436649">Facebook Page</a>
                </div>
            </nav>
        <?php } elseif ($_SESSION['role'] == 'Resident' or $_SESSION['role'] == 'Restricted'||
        $_SESSION['role'] == 'SK Chairman'||$_SESSION['role'] == 'Treasurer') {
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
            <div class="list">
                <div class="list1">
                    <div class="row">
                        <a href="permit.php">Back</a>

                    </div>
                    <table>
                        <?php
                        if (isset($_GET['pID'])) {
                            $id = $_GET['pID'];
                            $userID = $_SESSION['userid'];
                            include("config.php");
                            $sql = "SELECT * FROM tblpermit WHERE pID = $id";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_array($result);

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
                                    <td><strong>Findings</strong></td>
                                    <td>
                                        <?php echo $row["pFindings"] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Business Name</strong></td>
                                    <td>
                                        <?php echo $row["pBName"] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Address</strong></td>
                                    <td>
                                        <?php echo $row["pBAdd"] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Type</strong></td>
                                    <td>
                                        <?php echo $row["pBType"] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Official Receipt Number</strong></td>
                                    <td>
                                        <?php echo $row["pOR"] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Amount</strong></td>
                                    <td>
                                        <?php echo "₱" . $row["pAmount"] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Status</strong></td>
                                    <td>
                                        <?php echo $row["pStatus"] ?>
                                    </td>
                                </tr>
                            </tbody>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>