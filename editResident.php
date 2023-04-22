<?php
require('secure.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Edit Resident</title>
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
                    <a href="https://www.facebook.com/profile.php?id=100064518436649">Facebook Page</a>
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
                    <a href="https://www.facebook.com/profile.php?id=100064518436649">Facebook Page</a>
                </div>
            </nav>
        <?php }
        ?>
        <div class="main-body">
            <div class="promo_card">
                <?php
                if (isset($_GET['rID'])) {
                    $rID = $_GET['rID'];
                }
                ?>
                <h1>Edit Resident Data #
                    <?php echo $rID; ?>
                </h1>
            </div>
            <?php
            include("config.php");
            $getVal = "SELECT * FROM tblResidents WHERE rID= '$rID'";
            $res1 = $conn->query($getVal);
            $row = $res1->fetch_assoc();

            $rImage = $row['rImage'];
            $rFirst = $row['rFirst'];
            $rMid = $row['rMid'];
            $rLast = $row['rLast'];
            $rSuffix = $row['rSuffix'];
            $rBday = $row['rBday'];
            $rBplace = $row['rBplace'];
            $rAge = $row['rAge'];
            $rCivil = $row['rCivil'];
            $rGender = $row['rGender'];
            $rHouse = $row['rHouse'];
            $rPurok = $row['rPurok'];
            $rResiding = $row['rResiding'];
            $rCedula = $row['rCedula'];
            $rVoter = $row['rVoter'];
            $rPrecinct = $row['rPrecinct'];
            $rEmail = $row['rEmail'];
            $rContact = $row['rContact'];
            $rOccup = $row['rOccup'];
            ?>
            <div class="list">
                <div class="list1">
                    <div class="row">
                        <a href="residents.php">Back</a>
                    </div>
                    <div class="wrapper">
                        <form action="" method="post" autocomplete="off" enctype="multipart/form-data">

                            <div class="left">
                                <label for="uName">
                                    <font color=black>
                                        <font size=4px>Personal Information<br><br></font size>
                                    </font color>
                                </label>
                                <br>
                                <label for="rImage">Profile Image*</label>
                                <input type="file" id="rImage" name="rImage" accept=".jpg,.jpeg,.png" required
                                    value="<?= $rImage ?>">

                                <label for="rMid">Middle Name</label>
                                <input type="text" id="rMid" name="rMid" value="<?= $rMid ?>">

                                <label for="rSuffix">Suffix*</label>
                                <select name="rSuffix" id="rSuffix" size="1px">
                                    <option value="<?= $rSuffix ?>"selected><?= $rSuffix ?></option>
                                    <option value="N/A">N/A</option>
                                    <option value="Jr.">Jr.</option>
                                    <option value="Sr.">Sr.</option>
                                    <option value="I">I</option>
                                    <option value="II">II</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                    <option value="V">V</option>
                                    <option value="VI">VI</option>
                                    <option value="VII">VII</option>
                                    <option value="VIII">VIII</option>
                                    <option value="IX">IX</option>
                                    <option value="X">X</option>
                                    <option value="XI">XI</option>
                                    <option value="XII">XII</option>
                                    <option value="XIII">XIII</option>
                                    <option value="XIV">XIV</option>
                                    <option value="XV">XV</option>
                                    <option value="XVI">XVI</option>
                                    <option value="XVII">XVII</option>
                                    <option value="XVIII">XVIII</option>
                                    <option value="XIX">XIX</option>
                                    <option value="XX">XX</option>

                                </select>

                                <label for="rBplace">Place of Birth*</label>
                                <input type="text" id="rBplace" name="rBplace" value="<?= $rBplace ?>" >

                                <label for="rCivil">Civil Status*</label>
                                <select name="rCivil" id="rCivil" required size="1px">
                                    <option value="<?= $rCivil ?>"selected><?= $rCivil ?></option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Separated">Separated</option>
                                    <option value="Widowed">Widowed</option>
                                </select>

                                <label for="rHouse">Household Number</label>
                                <input type="number" id="rHouse" name="rHouse" value="<?= $rHouse ?>">

                                <label for="rResiding">Years Residing*</label>
                                <input type="number" id="rResiding" name="rResiding" value="<?= $rResiding ?>" >

                                <label for="rVoter">Voters Status*</label>
                                <select name="rVoter" id="rVoter" required size="1px">
                                    <option value="<?= $rVoter ?>"selected><?= $rVoter ?></option>
                                    <option value="Registered">Registered</option>
                                    <option value="Not Registered">Not Registered</option>
                                </select>

                                <label for="rOccup">Occupation*</label>
                                <input type="text" id="rOccup" name="rOccup" value="<?= $rOccup ?>" >

                                <label for="rContact">Contact Number*</label>
                                <input type="text" id="rContact" name="rContact" pattern="((^(\+)(\d){12}$)|(^\d{11}$))"
                                    value="<?= $rContact ?>" >
                                <br><br>


                            </div>
                            <div class="right">
                                <br><br><br>
                                <label for="rFirst">First Name*</label>
                                <input type="text" id="rFirst" name="rFirst" value="<?= $rFirst ?>" >

                                <label for="rLast">Last Name*</label>
                                <input type="text" id="rLast" name="rLast" value="<?= $rLast ?>" >

                                <label for="rBday">Date of Birth*</label>
                                <input type="date" id="rBday" name="rBday" value="<?= $rBday ?>">

                                <br><label for="rAge">Age</label><br>
                                <input type="text" id="rAge" name="rAge" value="<?= $rAge ?>">

                                <label for="rGender">Gender*</label>
                                <select name="rGender" id="rGender" required size="1px">
                                    <option value="<?= $rGender ?>" selected><?= $rGender ?></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Others">Others</option>
                                    <option value="Rather Not Say">Rather Not Say</option>
                                </select>

                                <label for="rPurok">Purok*</label>
                                <select name="rPurok" id="rPurok" required size="1px">
                                    <option value="<?= $rPurok ?>" selected><?= $rPurok ?></option>
                                    <option value="Purok 1">Purok 1</option>
                                    <option value="Purok 2">Purok 2</option>
                                    <option value="Purok 3">Purok 3</option>
                                    <option value="Purok 4">Purok 4</option>
                                    <option value="Purok 5">Purok 5</option>
                                    <option value="Purok 6">Purok 6</option>
                                    <option value="Purok 7">Purok 7</option>
                                </select>

                                <label for="rCedula">Cedula Number</label>
                                <input type="number" id="rCedula" name="rCedula" value="<?= $rCedula ?>">


                                <label for="rPrecinct">Precint Number</label>
                                <input type="text" id="rPrecinct" name="rPrecinct" pattern="([0-9]{4}[A-Z]{1})"
                                    value="<?= $rPrecinct ?>">

                                <label for="rEmail">Email Address*</label>
                                <input type="email" id="rEmail" name="rEmail" value="<?= $rEmail ?>">

                            </div>
                            <br>
                            <div class="submit">
                                <input type="submit" value="Save" name="save">
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['save'])) {
                            include('config.php');

                            $rImage = $_FILES["rImage"]["name"]; //file name
                            $tempname = $_FILES["rImage"]["tmp_name"];
                            $folder = "rImages/" . $rImage;
                            move_uploaded_file($tempname, $folder);

                            $rFirst = $_POST['rFirst'];
                            $rLast = $_POST['rLast'];
                            $rBplace = $_POST['rBplace'];
                            $rAge = $_POST['rAge'];
                            $rCivil = $_POST['rCivil'];
                            $rGender = $_POST['rGender'];
                            $rPurok = $_POST['rPurok'];
                            $rResiding = $_POST['rResiding'];
                            $rCedula = $_POST['rCedula'];
                            $rVoter = $_POST['rVoter'];
                            $rEmail = $_POST['rEmail'];
                            $rContact = $_POST['rContact'];
                            $rOccup = $_POST['rOccup'];

                            if (empty($_POST['rMid'])) {
                                $rMid = "N/A";
                            } else {
                                $rMid = $_POST['rMid'];
                            }
                            if (empty($_POST['rSuffix'])) {
                                $rSuffix = "N/A";
                            } else {
                                $rSuffix = $_POST['rSuffix'];
                            }
                            if (empty($_POST['rHouse'])) {
                                $rHouse = "N/A";
                            } else {
                                $rHouse = $_POST['rHouse'];
                            }
                            if (empty($_POST['rPrecinct'])) {
                                $rPrecinct = "N/A";
                            } else {
                                $rPrecinct = $_POST['rPrecinct'];
                            }

                            $bday = $_POST['rBday'];
                            $rBday = ($bday);
                            $today = (date('Y-m-d'));
                        $diff = date_diff(date_create($rBday), date_create($today));
                        $rAge = $diff->format('%y');
                            $rResiding = $_POST['rResiding'];

                            if ($rResiding > $rAge) {
                                echo "<br><p><font size=4px><font color=RED>Invalid Years Residing</font size></font color></p>";
                            } else {
                                $query = "UPDATE tblResidents SET
                                rImage= '$rImage',
                                rFirst= '$rFirst',
                                rMid= '$rMid',
                                rLast= '$rLast',
                                rSuffix= '$rSuffix',
                                rBday= '$rBday',
                                rBplace= '$rBplace',
                                rAge= '$rAge',
                                rCivil= '$rCivil',
                                rGender= '$rGender',
                                rHouse= '$rHouse',
                                rPurok= '$rPurok',
                                rResiding= '$rResiding',
                                rCedula= '$rCedula',
                                rVoter= '$rVoter',
                                rPrecinct= '$rPrecinct',
                                rEmail= '$rEmail',
                                rContact= '$rContact',
                                rOccup= '$rOccup'
                                
                                WHERE rID = '$rID'";
    
                                $result = mysqli_query($conn, $query);
    
                                if ($result) {
                                    echo "<br>
                                <p>
                                    <font color=green>Data Updated</font color>
                                </p>";
                                } else {
                                    echo "<br>
                                <p>
                                    <font color=green>Data Not Updated</font color>
                                </p>";
                                }
                                mysqli_close($conn);
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