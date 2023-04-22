<?php
require('secure.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <title>Edit User Type</title>
    <link rel="stylesheet" href="assets/css/form.css"/>
    <link rel="icon" href="assets/images/bLogo.png" type="image/icon type"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>

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
                <a href="officials.php">Brgy. Officials</a>
                <a href="residents.php">Residents Info</a>
                <a href="clearance.php">Clearances</a>
                <a href="permit.php">Permits</a>
                <a href="usertype.php" class="active">User Type</a>
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
                <h1>Change User Type</h1>
            </div>

            <div class="list">
                <div class="list1">
                    <div class="row">
                        <a href="usertype.php">Back</a>
                    </div>
                    <div class="wrapper">
                        <form action="" method="post">
                            <label for="aType">Type</label>
                            <select name="aType" id="aType" required>
                                <option value="" disabled selected hidden>Select User Type</option>
                                <option value="Chairman">Chairman</option>
                                <option value="Secretary">Secretary</option>
                                <option value="Treasurer">Treasurer</option>
                                <option value="SK Chairman">SK Chairman</option>
                                <option value="Kagawad">Kagawad</option>
                                <option value="Resident">Resident</option>
                            </select>
                            <div class="submit">
                                <input type="submit" value="Save" name="save">
                            </div>
                        </form>
                    </div>
                    <?php
                    if (isset($_POST['save'])) {
                        include('config.php');

                        $aID = $_GET['aID'];
                        $aType = $_POST['aType'];

                        $sql = "SELECT * FROM tblaccess WHERE aType = '$aType' AND aID = '$aID'";
                        $result = mysqli_query($conn, $sql);
                        $resultCheck = mysqli_num_rows($result);

                        if ($resultCheck > 0) {
                            echo "<br><p><font color=red>Already Set</font color></p>";
                        } else {

                            $query = "UPDATE tblaccess SET aType = '$aType' WHERE aID = '$aID'";
                            $result = mysqli_query($conn, $query);

                            echo "<br><p><font color=green>Successfully Changed</font color></p>";
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

</html>s