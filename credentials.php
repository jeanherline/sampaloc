<?php
require('secure.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Account</title>
    <link rel="stylesheet" href="assets/css/form.css" />
    <link rel="icon" href="assets/images/bLogo.png" type="assets/images/icon type" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />

    <style>
        table {
            width: 100%;
            font-size: 15px;
            color: #000;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            padding: 1rem;
            border-collapse: collapse;
            margin: 25px 0;
            justify-content: center;
        }

        table,
        th {
            padding: 1rem 1rem 1rem 5rem;
            text-align: center;
            justify-content: center;
        }

        td {
            padding: 1rem 1rem 1rem 5rem;
            justify-content: center;
            text-align: center;
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

        input[type=submit] {
            margin-left: 10rem;
        }

        button:hover {
            background: #4AD489;
            color: #000;
            transition: 0.5rem;
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
                    <a href="permit.php">Permits</a>
                    <span></span>

                    <div class="links">
                        <span>Quick Link</span>
                        <a href="index.php">Home Page</a>
                        <a href="https://www.facebook.com/profile.php?id=100064518436649">Facebook Page</a>
                    </div>
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
                    <a href="permit.php">Permits</a>
                    <a href="usertype.php">User Type</a>
                    <span></span>

                    <div class="links">
                        <span>Quick Link</span>
                        <a href="index.php">Home Page</a>
                        <a href="https://www.facebook.com/profile.php?id=100064518436649">Facebook Page</a>
                    </div>
                </div>
            </nav>
        <?php } elseif ($_SESSION['role'] == 'Kagawad') {
            ?>
            <nav>
                <div class="side_navbar">
                    <span>Main Menu</span>
                    <a href="blotter.php">Blotter Records</a>
                    <a href="clearance.php">Clearances</a>
                    <a href="permit.php">Permits</a>
                    <span></span>

                    <div class="links">
                        <span>Quick Link</span>
                        <a href="index.php">Home Page</a>
                        <a href="https://www.facebook.com/profile.php?id=100064518436649">Facebook Page</a>
                    </div>
                </div>
            </nav>
        <?php } elseif (
            $_SESSION['role'] == 'Resident' or $_SESSION['role'] == 'Restricted' or
            $_SESSION['role'] == 'SK Chairman' or $_SESSION['role'] == 'Treasurer'
        ) {
            ?>
            <nav>
                <div class="side_navbar">
                    <span>Apply Online</span>

                    <a href="clearance.php">Clearances</a>
                    <a href="permit.php">Permits</a>
                    <span></span>

                    <div class="links">
                        <span>Quick Link</span>
                        <a href="index.php">Home Page</a>
                        <a href="https://www.facebook.com/profile.php?id=100064518436649">Facebook Page</a>
                    </div>
                </div>
            </nav>
        <?php }
        ?>

        <div class="main-body">
            <div class="promo_card">
                <h1>Account Credentials</h1>
            </div>

            <div class="list">
                <div class="list1">
                    <div class="row">
                        <a href="account.php">Back</a>
                    </div>
                    <div class="row">

                        <table>
                            <thead>
                                <th>
                                    <h4>Logged Username</h4>
                                </th>
                                <th>
                                    <h4>Logged Password</h4>
                                </th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Username</strong></td>
                                    <td>
                                        <?php echo $_SESSION['username'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Password</strong></td>
                                    <td>
                                        <?php echo $_SESSION['password'] ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="wrapper">
                        <form action="" method="post">
                            <div class="left">
                                <label for="uname">Username</label>
                                <input type="text" id="uname" name="uname" placeholder="Enter New Username"
                                    value="<?php echo $_SESSION['username'] ?>">
                            </div>
                            <div class="right">
                                <label for="pswd">Password</label>
                                <input type="text" id="pswd" name="pswd" placeholder="Enter New Password"
                                    value="<?php echo $_SESSION['password'] ?>">
                            </div>
                            <div class="submit">
                                <input type="submit" value="Save" name="save">
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['save'])) {
                            include('config.php');
                            $newUser = $_POST['uname'];
                            $newPswd = $_POST['pswd'];
                            $userid = $_SESSION['userid'];

                            $sql = "SELECT * FROM tblaccess WHERE aID=$userid";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_array($result);

                            if ($row['aUname'] == $newUser && $row['aPswd'] == $newPswd) {
                                echo "<br><p><font color=red>Username and password already exists</font color></p>";
                            } else {

                                if ($row['aUname'] == $newUser && $row['aPswd'] != $newPswd) {
                                    $query = "UPDATE tblaccess SET aPswd = '$newPswd' WHERE aID = '$userid'";
                                    $result = mysqli_query($conn, $query);
                                    if ($result) {
                                        echo "<br><p><font color=green>Password has been updated</font color></p>";
                                        require('logout.php');
                                        echo "<script>window.location.href = 'sessionExpired.php';</script>";
                                    } else {
                                        echo "<br><p><font color=red>Password not Updated</font color></p>";
                                    }
                                } elseif ($row['aUname'] != $newUser && $row['aPswd'] == $newPswd) {
                                    $query = "UPDATE tblaccess SET aUname = '$newUser' WHERE aID = '$userid'";
                                    $result = mysqli_query($conn, $query);
                                    if ($result) {
                                        echo "<br><p><font color=green>Username has been updated</font color></p>";
                                        require('logout.php');
                                        echo "<script>window.location.href = 'sessionExpired.php';</script>";
                                    } else {
                                        echo "<br><p><font color=red>Username not updated</font color></p>";
                                    }
                                } else {
                                    $query = "UPDATE tblaccess SET aUname = '$newUser', aPswd = '$newPswd' WHERE aID = '$userid'";
                                    $result = mysqli_query($conn, $query);
                                    if ($result) {
                                        echo "<br><p><font color=green>Account updated</font color></p>";
                                        require('logout.php');
                                        echo "<script>window.location.href = 'sessionExpired.php';</script>";
                                    } else {
                                        echo "<br><p><font color=red>Account not updated</font color></p>";
                                    }
                                }
                            }
                            mysqli_close($conn);
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>