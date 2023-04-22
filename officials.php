<?php
require('secure.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Barangay Officials</title>
    <link rel="stylesheet" href="assets/css/sections.css">
    <link rel="icon" href="assets/images/bLogo.png" type="image/icon type" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <style>
        /* Main Body Section */
        .main-body {
            width: 80%;
            padding: 1rem;
        }

        .promo_card {
            width: 90%;
            color: #fff;
            margin-top: 10px;
            border-radius: 8px;
            padding: 0.5rem 1rem 1rem 3rem;
            background: #0052a2;
        }

        .add button {
            display: inline;
            background: #0052a2;
            color: white;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
        }

        .generate button {
            display: inline;
            background: white;
            color: #0052a2;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
        }

        .promo_card h1,
        .promo_card span,
        button {
            margin: 10px;
        }

        .list {
            width: 70%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 1rem 0;
        }

        /*Table*/

        table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 15px;
            min-width: 128%;
            overflow: hidden;
            border-radius: 5px 5px 0 0;
            color: #000;
            background: #fff;
            padding: 1rem;
        }

        table thead tr {
            color: #fff;
            background: #34AF6D;
            text-align: left;
            font-weight: bold;
        }

        th,
        td {
            padding: 12px 15px;
        }

        tbody tr {
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        tbody tr.active {
            font-weight: bold;
            color: #4AD489;
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
            <!-- &nbsp&nbsp&nbsp
            <img src="assets/images/moon.png" id="icon"> -->
        </div>

    </header>
    <div class="container">
        <?php

        if ($_SESSION['role'] == 'Secretary') {
            ?>
            <nav>
                <div class="side_navbar">
                    <span>Main Menu</span>
                    <a href="officials.php" class="active">Brgy. Officials</a>
                    <a href="residents.php">Residents Info</a>
                    <a href="blotter.php">Blotter Records</a>
                    <a href="clearance.php">Clearances</a>
                    <a href="permit.php">Permits</a>
                    <span></span>

                    <span>Quick Link</span>
                    <a href="index.php">Home Page</a>
                    <a href="https://www.facebook.com/profile.php?id=100064518436649">Facebook Page</a>
                    <span></span>
                </div>
            </nav>
        <?php } elseif ($_SESSION['role'] == 'Chairman') {
            ?>
            <nav>
                <div class="side_navbar">
                    <span>Main Menu</span>
                    <a href="officials.php" class="active">Brgy. Officials</a>
                    <a href="residents.php">Residents Info</a>
                    <a href="clearance.php">Clearances</a>
                    <a href="permit.php">Permits</a>
                    <a href="usertype.php">User Type</a>
                    <span></span>

                    <span>Quick Link</span>
                    <a href="index.php">Home Page</a>
                    <a href="https://www.facebook.com/profile.php?id=100064518436649">Facebook Page</a>
                    <span></span>
                </div>
            </nav>
        <?php }
        ?>


        <div class="main-body">
            <div class="promo_card">
                <div>
                    <h1>Barangay Officials</h1>
                </div>
            </div>

            <div class="list">
                <div class="list1">
                    <div class="row">
                        <h4>2018 - 2023</h4>
                        <div>
                            <?php
                            if ($_SESSION['role'] == 'Chairman') {
                                ?>
                                <div class="selectFilter">
                                    <form action="" method="POST">
                                        <select name="officials" required>
                                            <option value="" disabled selected hidden>Select List Type</option>
                                            <option value="Approved">Officials List</option>
                                            <option value="Pending">Edit Requests</option>
                                        </select>
                                        <button type="submit" name="filter">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </form>
                                </div>
                                <?php
                            } elseif ($_SESSION['role'] == 'Secretary') {
                                ?>
                                <div class="selectFilter">
                                    <form action="" method="POST">
                                        <select name="officials" required>
                                            <option value="" disabled selected hidden>Select List Type</option>
                                            <option value="Approved">Officials List</option>
                                            <option value="Pending">Edit Requests</option>
                                        </select>
                                        <button type="submit" name="filter">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </form>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <table>
                        <tbody>
                            <?php
                            include('config.php');

                            if ($_SESSION['role'] == 'Secretary') {
                                if (isset($_POST['filter'])) {
                                    $list = $_POST['officials'];

                                    if ($list == 'Approved') {
                                        ?>
                                        <thead>
                                            <tr>
                                                <th>Position</th>
                                                <th>Name</th>
                                                <th>Contact Number</th>
                                                <th>Address</th>
                                                <th>Start of Term</th>
                                                <th>End of Term</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        $sql = "SELECT tblaccess.*, tblresidents.*, tblofficials.* 
                                        FROM ((tblaccess INNER JOIN tblofficials ON 
                                        tblaccess.aID=tblofficials.aID)INNER JOIN tblresidents ON
                                        tblaccess.aID=tblresidents.aID) WHERE tblofficials.oStatus = 'Approved'
                                        ORDER BY FIELD(aType, 'Chairman', 'Secretary', 'Treasurer', 'SK Chairman', 'Kagawad')";

                                        $result = mysqli_query($conn, $sql);
                                        $resultCheck = mysqli_num_rows($result);

                                        if ($resultCheck > 0) {
                                            while ($data = mysqli_fetch_array($result)) {
                                                if ($data['rSuffix'] == "N/A"){
                                                    $name = $data['rFirst']." ".$data['rLast'];
                                                } else{
                                                    $name = $data['rFirst']." ".$data['rLast']." ".$data['rSuffix'];
                                                }
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $data['aType']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $name; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $data['rContact']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo "#" . $data['rHouse'] . " " . $data['rPurok'] . ", Sampaloc, San Rafael, Bulacan"; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $data['oTermS']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $data['oTermE']; ?>
                                                    </td>
                                                    <td>
                                                        <div class="add">
                                                            <a href="editOfficials.php?aID=<?php echo $data['aID']; ?>?o">
                                                                <button><i class="fa fa-pen"></i></button>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                    } elseif ($list = 'Pending') {

                                        ?>
                                        <thead>
                                            <tr>
                                                <th>Position</th>
                                                <th>Name</th>
                                                <th>Contact Number</th>
                                                <th>Address</th>
                                                <th>Start of Term</th>
                                                <th>End of Term</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        $sql = "SELECT tblaccess.*, tblresidents.*, tblofficials.* 
                                                FROM ((tblaccess INNER JOIN tblofficials ON 
                                                tblaccess.aID=tblofficials.aID)INNER JOIN tblresidents ON
                                                tblaccess.aID=tblresidents.aID) WHERE tblofficials.oStatus = 'Pending'
                                                ORDER BY FIELD(aType, 'Chairman', 'Secretary', 'Treasurer', 'SK Chairman', 'Kagawad')";

                                        $result = mysqli_query($conn, $sql);
                                        $resultCheck = mysqli_num_rows($result);

                                        if ($resultCheck > 0) {
                                            while ($data = mysqli_fetch_array($result)) {
                                                if ($data['rSuffix'] == "N/A"){
                                                    $name = $data['rFirst']." ".$data['rLast'];
                                                } else{
                                                    $name = $data['rFirst']." ".$data['rLast']." ".$data['rSuffix'];
                                                }
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $data['aType']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $name; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $data['rContact']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo "#" . $data['rHouse'] . " " . $data['rPurok'] . ", Sampaloc, San Rafael, Bulacan"; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $data['oTermS']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $data['oTermE']; ?>
                                                    </td>
                                                    <td>
                                                        <div class="add">
                                                            <a href="editOfficials.php?aID=<?php echo $data['aID']; ?>">
                                                                <button><i class="fa fa-pen"></i></button>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <td>No Edit Request</td>
                                            <?php
                                        }
                                    }
                                } else {
                                    ?>
                                    <thead>
                                        <tr>
                                            <th>Position</th>
                                            <th>Name</th>
                                            <th>Contact Number</th>
                                            <th>Address</th>
                                            <th>Start of Term</th>
                                            <th>End of Term</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <?php

                                    $sql = "SELECT tblaccess.*, tblresidents.*, tblofficials.* 
                                    FROM ((tblaccess INNER JOIN tblofficials ON 
                                    tblaccess.aID=tblofficials.aID)INNER JOIN tblresidents ON
                                    tblaccess.aID=tblresidents.aID) WHERE tblofficials.oStatus = 'Approved'
                                    ORDER BY FIELD(aType, 'Chairman', 'Secretary', 'Treasurer', 'SK Chairman', 'Kagawad')";
                                    $result = mysqli_query($conn, $sql);
                                    $numRows = mysqli_num_rows($result);

                                    if ($numRows > 0) {
                                        while ($data = mysqli_fetch_assoc($result)) {
                                            if ($data['rSuffix'] == "N/A"){
                                                $name = $data['rFirst']." ".$data['rLast'];
                                            } else{
                                                $name = $data['rFirst']." ".$data['rLast']." ".$data['rSuffix'];
                                            }
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $data['aType']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $name; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['rContact']; ?>
                                                </td>
                                                <td>
                                                    <?php echo "#" . $data['rHouse'] . " " . $data['rPurok'] . ", Sampaloc, San Rafael, Bulacan"; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['oTermS']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['oTermE']; ?>
                                                </td>
                                                <td>
                                                    <div class="add">
                                                        <a href="editOfficials.php?aID=<?php echo $data['aID']; ?>">
                                                            <button><i class="fa fa-pen"></i></button>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                }
                            } elseif ($_SESSION['role'] == 'Chairman') {

                                if (isset($_POST['filter'])) {
                                    $list = $_POST['officials'];

                                    if ($list == 'Approved') {
                                        ?>
                                        <thead>
                                            <tr>
                                                <th>Position</th>
                                                <th>Name</th>
                                                <th>Contact Number</th>
                                                <th>Address</th>
                                                <th>Start of Term</th>
                                                <th>End of Term</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        $sql = "SELECT tblaccess.*, tblresidents.*, tblofficials.* 
                                        FROM ((tblaccess INNER JOIN tblofficials ON 
                                        tblaccess.aID=tblofficials.aID)INNER JOIN tblresidents ON
                                        tblaccess.aID=tblresidents.aID) WHERE tblofficials.oStatus = 'Approved'
                                        ORDER BY FIELD(aType, 'Chairman', 'Secretary', 'Treasurer', 'SK Chairman', 'Kagawad')";

                                        $result = mysqli_query($conn, $sql);
                                        $resultCheck = mysqli_num_rows($result);

                                        if ($resultCheck > 0) {
                                            while ($data = mysqli_fetch_array($result)) {
                                                if ($data['rSuffix'] == "N/A"){
                                                    $name = $data['rFirst']." ".$data['rLast'];
                                                } else{
                                                    $name = $data['rFirst']." ".$data['rLast']." ".$data['rSuffix'];
                                                }
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $data['aType']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $name; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $data['rContact']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo "#" . $data['rHouse'] . " " . $data['rPurok'] . ", Sampaloc, San Rafael, Bulacan"; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $data['oTermS']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $data['oTermE']; ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                    } elseif ($list = 'Pending') {

                                        ?>
                                        <thead>
                                            <tr>
                                                <th>Position</th>
                                                <th>Name</th>
                                                <th>Contact Number</th>
                                                <th>Address</th>
                                                <th>Start of Term</th>
                                                <th>End of Term</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        $sql = "SELECT tblaccess.*, tblresidents.*, tblofficials.* 
                                                FROM ((tblaccess INNER JOIN tblofficials ON 
                                                tblaccess.aID=tblofficials.aID)INNER JOIN tblresidents ON
                                                tblaccess.aID=tblresidents.aID) WHERE tblofficials.oStatus = 'Pending'
                                                ORDER BY FIELD(aType, 'Chairman', 'Secretary', 'Treasurer', 'SK Chairman', 'Kagawad')";

                                        $result = mysqli_query($conn, $sql);
                                        $resultCheck = mysqli_num_rows($result);

                                        if ($resultCheck > 0) {
                                            while ($data = mysqli_fetch_array($result)) {
                                                if ($data['rSuffix'] == "N/A"){
                                                    $name = $data['rFirst']." ".$data['rLast'];
                                                } else{
                                                    $name = $data['rFirst']." ".$data['rLast']." ".$data['rSuffix'];
                                                }
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $data['aType']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $name; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $data['rContact']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo "#" . $data['rHouse'] . " " . $data['rPurok'] . ", Sampaloc, San Rafael, Bulacan"; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $data['oTermS']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $data['oTermE']; ?>
                                                    </td>
                                                    <td>
                                                        <div class="add">
                                                            <a href="approveOfficials.php?oID=<?php echo $data['oID']; ?>">
                                                                <button><i class="fa fa-check"></i></button>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <td>No Edit Request</td>
                                            <?php
                                        }
                                    }
                                } else {
                                    ?>
                                    <thead>
                                        <tr>
                                            <th>Position</th>
                                            <th>Name</th>
                                            <th>Contact Number</th>
                                            <th>Address</th>
                                            <th>Start of Term</th>
                                            <th>End of Term</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $sql = "SELECT tblaccess.*, tblresidents.*, tblofficials.* 
                                    FROM ((tblaccess INNER JOIN tblofficials ON 
                                    tblaccess.aID=tblofficials.aID)INNER JOIN tblresidents ON
                                    tblaccess.aID=tblresidents.aID) WHERE tblofficials.oStatus != 'Pending'
                                    ORDER BY FIELD(aType, 'Chairman', 'Secretary', 'Treasurer', 'SK Chairman', 'Kagawad')";

                                    $result = mysqli_query($conn, $sql);
                                    $resultCheck = mysqli_num_rows($result);

                                    if ($resultCheck > 0) {
                                        while ($data = mysqli_fetch_array($result)) {
                                            if ($data['rSuffix'] == "N/A"){
                                                $name = $data['rFirst']." ".$data['rLast'];
                                            } else{
                                                $name = $data['rFirst']." ".$data['rLast']." ".$data['rSuffix'];
                                            }
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $data['aType']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $name; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['rContact']; ?>
                                                </td>
                                                <td>
                                                    <?php echo "#" . $data['rHouse'] . " " . $data['rPurok'] . ", Sampaloc, San Rafael, Bulacan"; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['oTermS']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['oTermE']; ?>
                                                </td>

                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <td>No Edit Request</td>
                                        <?php
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="generate">
                        Export:
                        <a href="pdfOfficials.php">
                            <button>
                                <i class="fa fa-print"></i> PDF
                            </button>
                        </a>
                        <a href="excelOfficials.php">
                            <button>
                                <i class="fa fa-print"></i> Excel
                            </button>
                        </a>
                        <a href="wordOfficials.php">
                            <button>
                                <i class="fa fa-print"></i> Word
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <script>
        var icon = document.getElementById("icon");

        icon.onclick = function() {
            document.body.classList.toggle("dark-mode");
        } 
    </script> -->
    
</body>

</html>