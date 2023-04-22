<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="icon" href="assets/images/bLogo.png" type="images/icon type" />
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="assets/css/register.css">

</head>

<body>
    <section class="header">

        <div class="logo">
            <img src="assets/images/bLogo.png" alt="">
            <a>Barangay Sampaloc</a>
        </div>

        <nav class="navbar">
            <ul>
                <a href="index.php">Home</a>
                <a href="about.php">About</a>
                <a href="contactMain.php">Contact Us</a>
                <a href="register.php">Sign up</a>
                <a href="login.php"><button class="btn" id="btn1">Log In</button></a>
            </ul>
        </nav>
        <!-- <div id="toggle-btn" class="fas fa-moon"></div>
        <div id="menu-btn" class="fas fa-bars"></div> -->

    </section>

    <div class="container">

        <div class="wrapper">
            <br>
            <header>
                <img src="assets/images/bLogo.png"><br>
                Registration
            </header>

            <form action="" method="POST" autocomplete="on" enctype="multipart/form-data">
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
                        <label for="regImage">Profile Image <font color= red> * </font color></label>
                        <input type="file" id="regImage" name="regImage" accept=".jpg,.jpeg,.png" required>
                    </div>

                    <div class="input-field">
                        <label for="rFirst">First Name<font color= red> * </font color></label>
                        <input type="text" id="rFirst" name="rFirst" placeholder="Enter First Name" required>
                    </div>

                    <div class="input-field">
                        <label for="rMid">Middle Name (Optional)</label>
                        <input type="text" id="rMid" name="rMid" placeholder="Enter Middle Name">

                    </div>

                    <div class="input-field">
                        <label for="rLast">Last Name<font color= red> * </font color></label>
                        <input type="text" id="rLast" name="rLast" placeholder="Enter Last Name" required>
                    </div>

                    <div class="input-field">
                        <label for="rSuffix">Suffix<font color= red> * </font color></label>
                        <select name="rSuffix" id="rSuffix" required>
                            <option value="" disabled selected hidden>Select Suffix</option>
                            <option value="N/A">N/A</option>
                            <option value="JR.">JR.</option>
                            <option value="SR.">SR.</option>
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
                    </div>

                    <div class="input-field">
                        <label for="rBday">Date of Birth<font color= red> * </font color></label>
                        <input type="date" id="rBday" name="rBday" required>
                    </div>

                    <div class="input-field">
                        <label for="rBplace">Place of Birth<font color= red> * </font color></label>
                        <input type="text" id="rBplace" name="rBplace" placeholder="Enter Place of Birth" required>
                    </div>

                    <div class="input-field">
                        <label for="rCivil">Civil Status<font color= red> * </font color></label>
                        <select name="rCivil" id="rCivil" required>
                            <option value="" disabled selected hidden>Select Civil Status</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Separated">Separated</option>
                            <option value="Widowed">Widowed</option>
                        </select>
                    </div>

                    <div class="input-field">
                        <label for="rGender">Gender<font color= red> * </font color></label>
                        <select name="rGender" id="rGender" required>
                            <option value="" disabled selected hidden>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Others">Others</option>
                            <option value="Rather Not Say">Rather Not Say</option>
                        </select>
                    </div>

                    <div class="input-field">
                        <label for="rHouse">House Number</label>
                        <input type="text" id="rHouse" name="rHouse" placeholder="Enter House Number">
                    </div>

                    <div class="input-field">
                        <label for="rPurok">Purok<font color= red> * </font color></label>
                        <select name="rPurok" id="rPurok" required>
                            <option value="" disabled selected hidden>Select Purok</option>
                            <option value="Purok 1">Purok 1</option>
                            <option value="Purok 2">Purok 2</option>
                            <option value="Purok 3">Purok 3</option>
                            <option value="Purok 4">Purok 4</option>
                            <option value="Purok 5">Purok 5</option>
                            <option value="Purok 6">Purok 6</option>
                            <option value="Purok 7">Purok 7</option>
                        </select>
                    </div>

                    <div class="input-field">
                        <label for="rResiding">Years Residing<font color= red> * </font color></label>
                        <input type="number" id="rResiding" name="rResiding" placeholder="Enter Years of Residency"
                            required>
                    </div>

                    <div class="input-field">
                        <label for="rCedula">Cedula Number (Optional)</label>
                        <input type="text" id="rCedula" name="rCedula" placeholder="Example: 13429814">
                    </div>

                    <div class="input-field">
                        <label for="rVoter">Voters Status<font color= red> * </font color></label>
                        <select name="rVoter" id="rVoter" required>
                            <option value="" disabled selected hidden>Select Voters Status</option>
                            <option value="Registered">Registered</option>
                            <option value="Not Registered">Not Registered</option>
                        </select>
                    </div>

                    <div class="input-field">
                        <label for="rPrecint">Precinct Number (Optional)</label>
                        <input type="text" id="rPrecint" name="rPrecint" pattern="([0-9]{4}[A-Z]{1})"
                            placeholder="Example: 2314A or 6532Y">
                    </div>

                    <div class="input-field">
                        <label for="rOccup">Occupation<font color= red> * </font color></label>
                        <input type="text" id="rOccup" name="rOccup" placeholder="Enter Occupation" required>
                    </div>

                    <div class="input-field">
                        <label for="rContact">Contact Number<font color= red> * </font color></label>
                        <input type="text" id="rContact" name="rContact" pattern="((^(\+)(\d){12}$)|(^\d{11}$))"
                            placeholder="Example: 09123456789" required>
                    </div>

                    <div class="input-field">
                        <label for="rEmail">Email Address<font color= red> * </font color></label>
                        <input type="email" id="rEmail" name="rEmail" placeholder="juandelacruz@gmail.com" required>
                    </div>

                    <div class="input-field">
                        <label for="uName">
                            <font color=black>
                                <font size=3px><br>Login Credentials<br><br></font size>
                            </font color>
                        </label>
                    </div>

                    <div class="input-field"></div>
                    <div class="input-field"></div>

                    <div class="input-field">
                        <label for="uName">Create Username<font color= red> * </font color></label>
                        <input type="text" id="uName" name="uName" pattern="^[a-z0-9_-]{5,15}$"
                            placeholder="Example: juan_delacruz09" required>
                    </div>

                    <div class="input-field">
                        <label for="uPswd">Create Password<font color= red> * </font color></label>
                        <input type="password" id="uPswd" name="uPswd" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,15}$"
                            placeholder="Example: ASPgo123" required>
                    </div>

                    <div class="input-field"></div>

                    <div class="input-field">
                        <br><br>
                        <label>
                            <font color=black>Username must be atleast 5 to 15 characters with only lower case characters,
                                digit, and special symbol “underscore ( _ ) and hyphen ( - )” only.</font color>
                        </label>
                        <br>
                    </div>

                    <div class="input-field">
                        <label>
                            <br>
                            <font color=black>Password must be at least 5 to 15 characters, and
                                must include at least one upper case letter, one lower case letter, and one numeric
                                digit.</font color>
                        </label>
                        <br>
                    </div>

                    <div class="input-field"></div>
                    <br>
                    
                        <label style="font-size: 13px;">
                        <input type = "checkbox" name="agree" value="Agree" required ><font color= red> * </font color><font color=green> I hereby affirm my right 
                        to be informed, object to processing, access and rectify, 
                        suspend or withdraw my personal data, and be indemnified 
                        in case of damages pursuant to the provisions of the 
                        Republic Act No. 10173 of the Philippines, Data Privacy Act of 2012 
                        and its corresponding Implementing Rules and Regulations.</font color></label></input>
                    </div>
                    <div class="input-field"></div>
                    <div class="input-field"></div>


                    <div class="input-field">
                        <div class="submit">
                            <input type="submit" value="Submit" name="save">
                    </div>
                </div>
            </form>

            <?php
            
                    if (isset($_POST['save'])) {
                        include('config.php');

                        $regImage = $_FILES["regImage"]["name"]; //file name
                        $tempname = $_FILES["regImage"]["tmp_name"];
                        $folder = "rImages/" . $regImage;
                        move_uploaded_file($tempname, $folder);

                        $rFirst = trim($_POST['rFirst']);
                        $rLast = trim($_POST['rLast']);
                        $rBplace = trim($_POST['rBplace']);
                        $rCivil = $_POST['rCivil'];
                        $rGender = $_POST['rGender'];
                        $rPurok = $_POST['rPurok'];
                        $rVoter = $_POST['rVoter'];
                        $rEmail = trim($_POST['rEmail']);
                        $rContact = trim($_POST['rContact']);
                        $rOccup = trim($_POST['rOccup']);

                        $uName = trim($_POST['uName']);
                        $uPswd = trim($_POST['uPswd']);

                        if (empty($_POST['rMid'])) {
                            $rMid = "N/A";
                        } else {
                            $rMid = trim($_POST['rMid']);
                        }
                        if (empty($_POST['rSuffix'])) {
                            $rSuffix = "N/A";
                        } else {
                            $rSuffix = $_POST['rSuffix'];
                        }
                        if (empty($_POST['rHouse'])) {
                            $rHouse = "N/A";
                        } else {
                            $rHouse = trim($_POST['rHouse']);
                        }
                        if (empty($_POST['rPrecint'])) {
                            $rPrecint = "N/A";
                        } else {
                            $rPrecint = trim($_POST['rPrecint']);
                        }
                        if (empty($rCedula = trim($_POST['rCedula']))) {
                            $rCedula = "N/A";
                        } else{
                            $rCedula = trim($_POST['rCedula']);
                        }

                        $bday = $_POST['rBday'];
                        $rBday = ($bday);
                        $today = (date('Y-m-d'));
                        $diff = date_diff(date_create($rBday), date_create($today));
                        $rAge = $diff->format('%y');
                        $rResiding = $_POST['rResiding'];

                        if ($rResiding > $rAge) {
                            echo "<br><p><font size=4px><font color=RED>Invalid Years of Residency</font size></font color></p>";

                        } else {
                            $searchDup = "SELECT * FROM tblresidents INNER JOIN tblaccess ON
                            tblaccess.aID=tblresidents.aID WHERE (rContact LIKE '%$rContact%' 
                            AND LOWER(rEmail) LIKE LOWER('%$rEmail%')) OR (rCedula LIKE '%$rCedula%') 
                            AND (aType!='Archive' OR aType!='Rejected') ";
                            $dupStmnt = $conn->query($searchDup);
                            $fetchDup = mysqli_fetch_assoc($dupStmnt);

                            if ($dupStmnt->num_rows > 0) {
                                echo "<br><p><font size=4px><font color=RED>Information Already Exist</font size></font color></p>";
                                if ($fetchDup['aType'] == 'Pending'){
                                echo "<br><p><font size=4px><font color=RED>Account is Pending for Approval. <br>
                                Kindly wait for an account approval mail that will be sent to you via the gmail you provided.</font size></font color></p>";
                                }
                            } else {
                                $pen = "Pending";
                                $INSERT = "INSERT INTO tblaccess (aUname, aPswd, aType) VALUES (?, ?, ?)";

                                $stmt = $conn->prepare($INSERT);
                                $stmt->bind_param("sss", $uName, $uPswd, $pen);
                                $stmt->execute();
                                $stmt->close();

                                $SELECT = "SELECT * FROM tblaccess WHERE aUname = '$uName' LIMIT 1";
                                $resultID = mysqli_query($conn, $SELECT);
                                $row = mysqli_fetch_array($resultID);
                                $aID = $row['aID'];

                                $INSERT2 = "INSERT INTO tblresidents (rImage, rFirst, rMid, rLast, rSuffix, rBday, rBplace, rAge, rCivil,
                                rGender, rHouse, rPurok, rResiding, rCedula, rVoter, rPrecinct, rEmail, rContact, rOccup, aID)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                                $stmt2 = $conn->prepare($INSERT2);
                                $stmt2->bind_param(
                                    "sssssssssssssssssssi",
                                    $regImage,
                                    $rFirst,
                                    $rMid,
                                    $rLast,
                                    $rSuffix,
                                    $rBday,
                                    $rBplace,
                                    $rAge,
                                    $rCivil,
                                    $rGender,
                                    $rHouse,
                                    $rPurok,
                                    $rResiding,
                                    $rCedula,
                                    $rVoter,
                                    $rPrecint,
                                    $rEmail,
                                    $rContact,
                                    $rOccup,
                                    $aID
                                );
                                $stmt2->execute();
                                $stmt2->close();
                                $conn->close();
                                echo "<br><p><font size=4px><font color=green>Successfully Registered</font size></font color></p>";
                            }
                        }
                    }
                
                    ?>

        </div>
    </div>
    <br><br><br>
    <section class="footer">
        <div class="credit"> ©2023 Copyright Barangay Sampaloc</div>
    </section>
</body>

<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>

</html>