<?php
require('secure.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>View Resident</title>
    <link rel="stylesheet" href="assets/css/view.css" />
    <link rel="icon" href="assets/images/bLogo.png" type="image/icon type" />
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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

        <div class="wrapper">
            <div class="row">
                <br>
                <a href="residents.php">Back</a>
            </div>
            <?php
            if (isset($_GET['rID'])) {
                $id = $_GET['rID'];
                include("config.php");
                $sql = "SELECT * FROM tblresidents WHERE rID = $id";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result);
            }
            ?>

            <br>
            <header>
                <img src="rImages/<?= $row['rImage']; ?>"><br>
            </header>

            <form action="" method="POST" autocomplete="off" enctype="multipart/form-data">
                <div class="fields">
                    <div class="input-field">
                        <label for="uName">
                            <font color=black>
                                <font size=3px>Personal Information<br><br></font size>
                            </font color>
                        </label>
                    </div>

                    <div class="input-field"></div>
                    <div class="input-field"></div>


                    <div class="input-field">
                        <label for="rFirst">First Name</label>
                        <input placeholder="<?= $row['rFirst']; ?>" disabled>
                    </div>

                    <div class="input-field">
                        <label for="rMid">Middle Name</label>
                        <input type="text" id="rMid" name="rMid" placeholder="<?= $row['rMid']; ?>" disabled>

                    </div>

                    <div class="input-field">
                        <label for="rLast">Last Name</label>
                        <input type="text" id="rLast" name="rLast" placeholder="<?= $row['rLast']; ?>" disabled>
                    </div>

                    <div class="input-field">
                        <label for="rSuffix">Suffix</label>
                        <input type="text" id="rSuffix" name="rSuffix" placeholder="<?= $row['rSuffix']; ?>" disabled>
                    </div>

                    <div class="input-field">
                        <label for="rBday">Date of Birth</label>
                        <input type="text" id="rBday" name="rBday" placeholder="<?= $row['rBday']; ?>" disabled>
                    </div>

                    <div class="input-field">
                        <label for="rBplace">Place of Birth</label>
                        <input type="text" id="rBplace" name="rBplace" placeholder="<?= $row['rBplace']; ?>" disabled>
                    </div>

                    <div class="input-field">
                        <label for="rAge">Age</label>
                        <input type="text" id="rAge" name="rAge" placeholder="<?= $row['rAge']; ?>" disabled>
                    </div>

                    <div class="input-field">
                        <label for="rCivil">Civil Status</label>
                        <input type="text" id="rCivil" name="rCivil" placeholder="<?= $row['rCivil']; ?>" disabled>
                        </select>
                    </div>

                    <div class="input-field">
                        <label for="rGender">Gender</label>
                        <input type="text" id="rGender" name="rGender" placeholder="<?= $row['rGender']; ?>" disabled>
                    </div>

                    <div class="input-field">
                        <label for="rHouse">House Number</label>
                        <input type="number" id="rHouse" name="rHouse" placeholder="<?= $row['rHouse']; ?>" disabled>
                    </div>

                    <div class="input-field">
                        <label for="rPurok">Purok</label>
                        <input type="number" id="rPurok" name="rPurok" placeholder="<?= $row['rPurok']; ?>" disabled>
                    </div>

                    <div class="input-field">
                        <label for="rResiding">Years Residing</label>
                        <input type="number" id="rResiding" name="rResiding" placeholder="<?= $row['rResiding']; ?>"
                            disabled>
                    </div>

                    <div class="input-field">
                        <label for="rCedula">Cedula Number</label>
                        <input type="number" id="rCedula" name="rCedula" placeholder="<?= $row['rCedula']; ?>" disabled>
                    </div>

                    <div class="input-field">
                        <label for="rVoter">Voters Status</label>
                        <input type="number" id="rVoter" name="rVoter" placeholder="<?= $row['rVoter']; ?>" disabled>
                    </div>

                    <div class="input-field">
                        <label for="rPrecint">Precinct Number</label>
                        <input type="number" id="rVoter" name="rVoter" placeholder="<?= $row['rPrecinct']; ?>" disabled>
                    </div>

                    <div class="input-field">
                        <label for="rOccup">Occupation</label>
                        <input type="text" id="rOccup" name="rOccup" placeholder="<?= $row['rOccup']; ?>" disabled>
                    </div>

                    <div class="input-field">
                        <label for="rContact">Contact Number</label>
                        <input type="text" id="rContact" name="rContact" placeholder="<?= $row['rContact']; ?>"
                            disabled>
                    </div>

                    <div class="input-field">
                        <label for="rEmail">Email Address</label>
                        <input type="email" id="rEmail" name="rEmail" placeholder="<?= $row['rEmail']; ?>" disabled>
                    </div>

                </div>


            </form>
        </div>
</body>

</html>