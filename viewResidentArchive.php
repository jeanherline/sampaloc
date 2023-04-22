<?php
require('secure.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>View Resident</title>
    <link rel="stylesheet" href="assets/css/form.css" />
    <link rel="icon" href="assets/images/bLogo.png" type="image/icon type" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />

    <style>
        img {
            width: 50px;
            height: 100%;
            margin-right: 15px;
            border-top-right-radius: 15px;
            border-bottom-right-radius: 15px;

        }

        table {
            display: block;
            overflow-y: scroll;
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
            padding: 1rem 10rem 1rem 5rem;
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
                    <a href="residents.php" class="active">Residents Info</a>
                    <a href="blotter.php">Blotter Records</a>
                    <a href="clearance.php">Clearances</a>
                    <a href="permit.php">Permits</a>
                    <span></span>

                    <span>Quick Link</span>
                    <a href="index.php">Home Page</a>
                    <a href="https://www.facebook.com/profile.php?id=100064518436649">Facebook</a>
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
                    <a href="https://www.facebook.com/profile.php?id=100064518436649">Facebook</a>
                </div>
            </nav>
        <?php }
        ?>

        <div class="main-body">
            <div class="list">
                <div class="list1">
                    <div class="row">
                        <a href="residents.php">Back</a>

                    </div>

                    <table>
                        <?php
                        if (isset($_GET['rID'])) {
                            $id = $_GET['rID'];
                            include("config.php");
                            $sql = "SELECT * FROM tblresidents WHERE rID = $id";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_array($result);
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
                                <td><strong>Photo</strong></td>
                                <td>
                                    <img src="rImages/<?php echo $row["rImage"] ?>" alt="">
                                </td>
                            </tr>
                            <tr>
                                <td><strong>ID</strong></td>
                                <td>
                                    <?php echo $row["rID"] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>First Name</strong></td>
                                <td>
                                    <?php echo $row["rFirst"] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Middle Name</strong></td>
                                <td>
                                    <?php echo $row["rMid"] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Last Name</strong></td>
                                <td>
                                    <?php echo $row["rLast"] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Suffix</strong></td>
                                <td>
                                    <?php echo $row["rSuffix"] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Date of Birth</strong></td>
                                <td>
                                    <?php echo $row["rBday"] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Place of Birth</strong></td>
                                <td>
                                    <?php echo $row["rBplace"] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Age</strong></td>
                                <td>
                                    <?php echo $row["rAge"] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Civil Status</strong></td>
                                <td>
                                    <?php echo $row["rCivil"] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Gender</strong></td>
                                <td>
                                    <?php echo $row["rGender"] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>House Number</strong></td>
                                <td>
                                    <?php echo $row["rHouse"] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Purok</strong></td>
                                <td>
                                    <?php echo $row["rPurok"] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Voters Status</strong></td>
                                <td>
                                    <?php echo $row["rVoter"] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Precint Number</strong></td>
                                <td>
                                    <?php echo $row["rPrecinct"] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Email Address</strong></td>
                                <td>
                                    <?php echo $row["rEmail"] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Contact Number</strong></td>
                                <td>
                                    <?php echo $row["rContact"] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Occupation</strong></td>
                                <td>
                                    <?php echo $row["rOccup"] ?>
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