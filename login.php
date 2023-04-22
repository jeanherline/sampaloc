<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="assets/images/bLogo.png" type="image/icon type" />
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="assets/css/login.css">

</head>

<body>

    <section class="header">

        <div class="logo">
            <img src="assets/images/bLogo.png" alt="">
            <a>Barangay Sampaloc</a>
        </div>

        <nav class="navbar">
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="register.php">Sign up</a>
            <a href="contactMain.php">Contact Us</a>
            <a href="login.php"><button class="btn" id="btn1">Log In</button></a>
        </nav>

        <div id="menu-btn" class="fas fa-bars"></div>

    </section>

    <div class="wrapper">
        <div class="pic">
            <img src="assets/images/bLogo.png">
        </div>
        <br>
        <h1>User Login</h1><br>
        <div class="welcome">
            <p>Welcome back you've <br> been missed!</p>
        </div>
        <br>
        <br>
        <br>
        <form action="" method="POST">
            <div class="log">
                <input type="text" id="uname" name="uname" placeholder="Enter username">
                <input type="password" id="pswd" name="pswd" placeholder="Password">
            </div>
            <p class="recover">
                <a href="register.php">Register Here</a>
            </p>
            <?php
            if (isset($_POST['sub'])) {

                include('config.php');
                session_start();

                $uname = $_POST['uname'];
                $pswd = $_POST['pswd'];

                $sql = "SELECT * FROM tblaccess WHERE aUname='$uname' AND aPswd='$pswd'";
                $result1 = mysqli_query($conn, $sql);
                $numRows1 = mysqli_num_rows($result1);

                /* $sql = "SELECT * FROM tblUsers WHERE uName='$uname' AND uPswd='$pswd'";
                $result2 = mysqli_query($conn, $sql);
                $numRows2 = mysqli_num_rows($result2);      */

                if ($numRows1 > 0) {
                    $user1 = mysqli_fetch_assoc($result1);
                    $_SESSION['loggedin'] = TRUE;

                    if ($user1['aType'] == 'Chairman') {
                        $_SESSION['role'] = "Chairman";
                        $_SESSION['userid'] = $user1['aID'];
                        $_SESSION['username'] = $user1['aUname'];
                        $_SESSION['password'] = $user1['aPswd'];

                        header('location: officials.php');
                    } elseif ($user1['aType'] == 'Secretary') {
                        $_SESSION['role'] = "Secretary";
                        $_SESSION['userid'] = $user1['aID'];
                        $_SESSION['username'] = $user1['aUname'];
                        $_SESSION['password'] = $user1['aPswd'];

                        header('location: officials.php');
                        exit;
                    } elseif ($user1['aType'] == 'Kagawad') {

                        $_SESSION['role'] = "Kagawad";
                        $_SESSION['userid'] = $user1['aID'];
                        $_SESSION['username'] = $user1['aUname'];
                        $_SESSION['password'] = $user1['aPswd'];

                        header('location: blotter.php');
                    } elseif ($user1['aType'] == 'Resident') {

                        $_SESSION['role'] = "Resident";
                        $_SESSION['userid'] = $user1['aID'];
                        $_SESSION['username'] = $user1['aUname'];
                        $_SESSION['password'] = $user1['aPswd'];

                        header('location: clearance.php');
                    } elseif ($user1['aType'] == 'SK Chairman') {

                        $_SESSION['role'] = "SK Chairman";
                        $_SESSION['userid'] = $user1['aID'];
                        $_SESSION['username'] = $user1['aUname'];
                        $_SESSION['password'] = $user1['aPswd'];

                        header('location: clearance.php');
                    }  elseif ($user1['aType'] == 'Treasurer') {

                        $_SESSION['role'] = "Treasurer";
                        $_SESSION['userid'] = $user1['aID'];
                        $_SESSION['username'] = $user1['aUname'];
                        $_SESSION['password'] = $user1['aPswd'];

                        header('location: clearance.php');
                    } elseif ($user1['aType'] == 'Restricted') {

                        $_SESSION['role'] = "Restricted";
                        $_SESSION['userid'] = $user1['aID'];
                        $_SESSION['username'] = $user1['aUname'];
                        $_SESSION['password'] = $user1['aPswd'];

                        header('location: clearance.php');
                    } elseif ($user1['aType'] == 'Pending') {

                        $_SESSION['loggedin'] = FALSE;
                        echo "<br><br><p><font color=red><font size = 3rem>Account Pending</font size></font color></p>";
                    } elseif ($user1['aType'] == 'Rejected') {

                        $_SESSION['loggedin'] = FALSE;
                        echo "<br><br><p><font color=red><font size = 3rem>Account Rejected</font size></font color></p>";
                    }
                    elseif ($user1['aType'] == 'Archive') {

                        $_SESSION['loggedin'] = FALSE;
                        echo "<br><br><p><font color=red><font size = 3rem>Account Does Not Exist</font size></font color></p>";
                    }
                } else {
                    $_SESSION['loggedin'] = FALSE;
                    echo "<br><br><p><font color=red><font size = 3rem>Incorrect username/password</font size></font color></p>";
                }
            }
            ?>
            <br>
            <br>
            <div class="submit">
                <input type="submit" value="Sign In" name="sub">
            </div>
        </form>
        <div class="lower">
            <h4>Ito ay atin, Mahalin natin</h4>
        </div>
    </div>
    <section class="footer">
        <div class="credit"> ©2023 Copyright Barangay Sampaloc</div>
    </section>
</body>

<!-- swiper js link  -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>



</html>