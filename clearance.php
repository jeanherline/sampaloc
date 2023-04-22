<?php
require('secure.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Clearance</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/sections.css" />
    <link rel="icon" href="assets/images/bLogo.png" type="image/icon type" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <style>
        /* Main Body Section */
        .main-body {
            width: 80%;
            padding: 1rem;
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

        button:hover {
            background: #4AD489;
            color: #000;
            transition: 0.5rem;
        }

        .list {
            width: 90%;
            align-items: center;
            justify-content: space-between;
        }

        .row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /*Table*/
        table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 15px;
            min-width: 100%;
            overflow: hidden;
            border-radius: 5px 5px 0 0;
            color: #000;
            background: #fff;
            padding: 1rem;
        }

        table thead tr {
            color: #fff;
            background: #34AF6D;
            text-align: center;
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

        /* table {
            display: block;
            overflow-y: scroll;
            width: 100%;
            height: 530px;
            font-size: 15px;
            color: #000;
            background: #fff;
            padding: 1rem;
            text-align: center;
            border-radius: 10px;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        table,
        th {
            table-layout: fixed;
            padding: 1rem 1em 1rem 1rem;
            text-align: center;
            justify-content: center;
        }

        td {
            table-layout: fixed;
            padding: 1rem 4rem;
            text-align: center;
            justify-content: center;
        } */
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
                    <a href="clearance.php" class="active">Clearances</a>
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
                    <a href="residents.php">Residents Info</a>
                    <a href="clearance.php" class="active">Clearances</a>
                    <a href="permit.php">Permits</a>
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
                    <a href="clearance.php" class="active">Clearances</a>
                    <a href="permit.php">Permits</a>
                    <span></span>

                    <span>Quick Link</span>
                    <a href="index.php">Home Page</a>
                    <a href="https://www.facebook.com/profile.php?id=100064518436649">Facebook Page</a>
                </div>
            </nav>
        <?php } elseif (
            $_SESSION['role'] == 'Resident' or $_SESSION['role'] == 'Restricted' ||
            $_SESSION['role'] == 'SK Chairman' or $_SESSION['role'] == 'Treasurer'
        ) {
            ?>

            <nav>
                <div class="side_navbar">
                    <span>Apply Online</span>

                    <a href="clearance.php" class="active">Clearances</a>
                    <a href="permit.php">Permits</a>
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
                        <h4>Barangay Clearance</h4>
                        <?php
                        if ($_SESSION['role'] == 'Chairman' or $_SESSION['role'] == 'Kagawad' or $_SESSION['role'] == 'Secretary') {
                            ?>
                            <div class="search_box">
                                <form action="" method="post">
                                    <input type="text" id="search" name="valueToSearch" placeholder="Search by Name"
                                        autocomplete="off" required>
                                    <button type="submit" name="search">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </form>
                            </div>

                            <?php
                        } else if ($_SESSION['role'] == 'Resident' || $_SESSION['role'] == 'SK Chairman' or $_SESSION['role'] == 'Treasurer') { ?>
                                <div class="search_box">
                                    <form action="" method="post">
                                        <input type="text" id="search" name="valueToSearch" placeholder="Search by Purpose"
                                            autocomplete="off" required>
                                        <button type="submit" name="search">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="add">
                                    <a href="addClearance.php"><button>Request Clearance</button></a>
                                </div>
                            <?php
                        } else if ($_SESSION['role'] == 'Restricted') { ?>
                                    <div class="search_box">
                                        <form action="" method="post">
                                            <input type="text" id="search" name="valueToSearch" placeholder="Search by Purpose"
                                                autocomplete="off" required>
                                            <button type="submit" name="search">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="add">
                                        <a href="#.php"><button>Request Blocked</button></a>
                                    </div>
                            <?php
                        }
                        ?>
                        <div class="add">
                            <a href="clearance.php"><button>Refresh Table</button></a>
                        </div>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Client Name</th>
                                <th>Findings</th>
                                <th>Purpose</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include('config.php');

                            if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
                                $page_no = $_GET['page_no'];
                            } else {
                                $page_no = 1;
                            }
                            $total_records_per_page = 10;
                            $offset = ($page_no - 1) * $total_records_per_page;
                            $previous_page = $page_no - 1;
                            $next_page = $page_no + 1;
                            $adjacents = "2";

                            if ( $_SESSION['role'] == 'Resident' ||
                            $_SESSION['role'] == 'SK Chairman' or $_SESSION['role'] == 'Treasurer') {
                                if (isset($_POST['search'])) {
                                    $userid = $_SESSION['userid'];
                                    $valueToSearch = $_POST['valueToSearch'];
                            
                                    $sql = "SELECT * FROM tblclearance INNER JOIN tblresidents ON
                                    tblresidents.aID=tblclearance.aID WHERE cPurpose LIKE '%$valueToSearch%' AND
                                    tblresidents.aID = '$userid' ORDER BY cStatus DESC";
                                    $result = mysqli_query($conn, $sql);
                                    $numRows = mysqli_num_rows($result);

                                    $res = "SELECT * FROM tblaccess WHERE aType = 'Restricted' && aID = '$userid'";
                                    $resresult = $conn->query($res);
                                    $role = mysqli_fetch_assoc($resresult);
                                    $userRole = $role['aType'];

                                    if ($userRole == "Restricted"){?>
                                        <div class="add">
                                            <a href="viewClearance.php?cID=<?php echo $data['cID']; ?>">
                                                <button><i class="fa fa-eye"></i></button>
                                            </a>
                                        </div> <?php
                                    } 


                                    if ($numRows > 0) {
                                        while ($data = mysqli_fetch_assoc($result)) { 
                                            if ($data['rSuffix']=="N/A"){
                                                $name = $data['rFirst']." ".$data['rLast'];
                                            } else {
                                                $name = $data['rFirst']." ".$data['rLast']." ".$data['rSuffix'];
                                            }?>
                                            <tr>
                                                <td>
                                                    <?php echo $name; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['cFindings']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['cPurpose']; ?>
                                                </td>
                                                <td>₱
                                                    <?php echo $data['cAmount']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['cStatus']; ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                    if ($data['cStatus'] == "Approved" || $data['cStatus'] == "Declined"){?>
                                                    <div class="add">
                                                        <a href="viewClearance.php?cID=<?php echo $data['cID']; ?>">
                                                            <button><i class="fa fa-eye"></i></button>
                                                        </a>
                                                    </div> <?php
                                                    } else if ($data['cStatus'] == "Pending"){ ?>
                                                        <div class="add">
                                                        <a href="viewClearance.php?cID=<?php echo $data['cID']; ?>">
                                                            <button><i class="fa fa-eye"></i></button>
                                                        </a>
                                                        <a href="editClearance.php?cID=<?php echo $data['cID']; ?>">
                                                            <button><i class="fa fa-pencil"></i></button>
                                                        </a>
                                                     </div> <?php
                                                    }  
                                                 ?>    
                                                </td>
                                            </tr>
                                        <?php }
                                        mysqli_close($conn);
                                    } else {
                                        ?>
                                        <tr>
                                            <td>No Records Found</td>
                                        </tr>
                                    <?php }
                                } else {
                                    $userid = $_SESSION['userid'];

                                    $result_count = mysqli_query(
                                        $conn,
                                        "SELECT COUNT(*) As total_records FROM `tblclearance` WHERE aID='$userid' ORDER BY cStatus DESC "
                                    );
                                    $total_records = mysqli_fetch_array($result_count);
                                    $total_records = $total_records['total_records'];
                                    $total_no_of_pages = ceil($total_records / $total_records_per_page);
                                    $second_last = $total_no_of_pages - 1; // total pages minus 1
                            
                                    $SELECT = "SELECT * FROM tblclearance INNER JOIN tblresidents
                                    ON tblclearance.aID=tblresidents.aID WHERE tblresidents.aID = '$userid'
                                    ORDER BY cStatus DESC LIMIT $offset, $total_records_per_page";
                                    $resultID = mysqli_query($conn, $SELECT);
                                    $numRows = mysqli_num_rows($resultID);

                                    if ($numRows > 0) {
                                        while ($data = mysqli_fetch_assoc($resultID)) { 
                                            if ($data['rSuffix']=="N/A"){
                                                $name = $data['rFirst']." ".$data['rLast'];
                                            } else {
                                                $name = $data['rFirst']." ".$data['rLast']." ".$data['rSuffix'];
                                            }?>
                                            <tr>
                                                <td>
                                                    <?php echo $name; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['cFindings']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['cPurpose']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['cAmount']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['cStatus']; ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                    if ($data['cStatus'] == "Approved" || $data['cStatus'] == "Declined"){?>
                                                    <div class="add">
                                                        <a href="viewClearance.php?cID=<?php echo $data['cID']; ?>">
                                                            <button><i class="fa fa-eye"></i></button>
                                                        </a>
                                                    </div> <?php
                                                    } else if ($data['cStatus'] == "Pending"){ ?>
                                                        <div class="add">
                                                        <a href="viewClearance.php?cID=<?php echo $data['cID']; ?>">
                                                            <button><i class="fa fa-eye"></i></button>
                                                        </a>
                                                        <a href="editClearance.php?cID=<?php echo $data['cID']; ?>">
                                                            <button><i class="fa fa-pencil"></i></button>
                                                        </a>
                                                     </div> <?php
                                                    }   ?>    
                                                </td>
                                        </tr>
                                        <?php
                                    } 
                                } else {
                                        ?>
                                        <tr>
                                            <td>No Records Found</td>
                                        </tr>
                                    <?php }
                                }
                            } elseif( $_SESSION['role'] == 'Restricted'){
                                if (isset($_POST['search'])) {
                                    $userid = $_SESSION['userid'];
                                    $valueToSearch = $_POST['valueToSearch'];
                            
                                    $sql = "SELECT * FROM tblclearance INNER JOIN tblresidents ON
                                    tblresidents.aID=tblclearance.aID WHERE cPurpose LIKE '%$valueToSearch%' AND
                                    tblresidents.aID = '$userid' ORDER BY cStatus DESC";
                                    $result = mysqli_query($conn, $sql);
                                    $numRows = mysqli_num_rows($result);

                                    $res = "SELECT * FROM tblaccess WHERE aType = 'Restricted' && aID = '$userid'";
                                    $resresult = $conn->query($res);
                                    $role = mysqli_fetch_assoc($resresult);
                                    $userRole = $role['aType'];

                                    if ($userRole == "Restricted"){?>
                                        <div class="add">
                                            <a href="viewClearance.php?cID=<?php echo $data['cID']; ?>">
                                                <button><i class="fa fa-eye"></i></button>
                                            </a>
                                        </div> <?php
                                    } 


                                    if ($numRows > 0) {
                                        while ($data = mysqli_fetch_assoc($result)) { 
                                            if ($data['rSuffix']=="N/A"){
                                                $name = $data['rFirst']." ".$data['rLast'];
                                            } else {
                                                $name = $data['rFirst']." ".$data['rLast']." ".$data['rSuffix'];
                                            }?>
                                            <tr>
                                                <td>
                                                    <?php echo $name; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['cFindings']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['cPurpose']; ?>
                                                </td>
                                                <td>₱
                                                    <?php echo $data['cAmount']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['cStatus']; ?>
                                                </td>
                                                <td>
                                                    <div class="add">
                                                        <a href="viewClearance.php?cID=<?php echo $data['cID']; ?>">
                                                            <button><i class="fa fa-eye"></i></button>
                                                        </a>
                                                    </div> 
                                                </td>
                                            </tr>
                                        <?php }
                                        mysqli_close($conn);
                                    } else {
                                        ?>
                                        <tr>
                                            <td>No Records Found</td>
                                        </tr>
                                    <?php }
                                } else {
                                    $userid = $_SESSION['userid'];

                                    $result_count = mysqli_query(
                                        $conn,
                                        "SELECT COUNT(*) As total_records FROM `tblclearance` WHERE aID='$userid' ORDER BY cStatus DESC "
                                    );
                                    $total_records = mysqli_fetch_array($result_count);
                                    $total_records = $total_records['total_records'];
                                    $total_no_of_pages = ceil($total_records / $total_records_per_page);
                                    $second_last = $total_no_of_pages - 1; // total pages minus 1
                            
                                    $SELECT = "SELECT * FROM tblclearance INNER JOIN tblresidents
                                    ON tblclearance.aID=tblresidents.aID WHERE tblresidents.aID = '$userid'
                                    ORDER BY cStatus DESC LIMIT $offset, $total_records_per_page";
                                    $resultID = mysqli_query($conn, $SELECT);
                                    $numRows = mysqli_num_rows($resultID);

                                    if ($numRows > 0) {
                                        while ($data = mysqli_fetch_assoc($resultID)) { 
                                            if ($data['rSuffix']=="N/A"){
                                                $name = $data['rFirst']." ".$data['rLast'];
                                            } else {
                                                $name = $data['rFirst']." ".$data['rLast']." ".$data['rSuffix'];
                                            }?>
                                            <tr>
                                                <td>
                                                    <?php echo $name; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['cFindings']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['cPurpose']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['cAmount']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['cStatus']; ?>
                                                </td>
                                                <td>
                                                    <div class="add">
                                                        <a href="viewClearance.php?cID=<?php echo $data['cID']; ?>">
                                                            <button><i class="fa fa-eye"></i></button>
                                                        </a>
                                                    </div>
                                                </td>
                                        </tr>
                                        <?php
                                    } 
                                } else {
                                        ?>
                                        <tr>
                                            <td>No Records Found</td>
                                        </tr>
                                    <?php }
                                }

                            } elseif ($_SESSION['role'] == 'Secretary') {
                                if (isset($_POST['search'])) {
                                    $valueToSearch = $_POST['valueToSearch'];
                            
                                    $sql = "SELECT * FROM tblclearance INNER JOIN tblaccess ON
                                    tblaccess.aID=tblclearance.aID INNER JOIN tblresidents ON
                                    tblresidents.aID=tblaccess.aID WHERE
                                    (LOWER (tblresidents.rFirst) LIKE LOWER('%$valueToSearch%') OR 
                                    LOWER(tblresidents.rLast) LIKE LOWER('%$valueToSearch%') OR
                                    LOWER(CONCAT(rFirst, ' ', rLast)) LIKE LOWER('%$valueToSearch%'))
                                    AND cStatus = 'Approved' ORDER BY cStatus DESC";
                                    $result = mysqli_query($conn, $sql);
                                    $numRows = mysqli_num_rows($result);

                                    if ($numRows > 0) {
                                        while ($data = mysqli_fetch_assoc($result)) { 
                                            if ($data['rSuffix']=="N/A"){
                                                $name = $data['rFirst']." ".$data['rLast'];
                                            } else {
                                                $name = $data['rFirst']." ".$data['rLast']." ".$data['rSuffix'];
                                            }?>
                                            <tr>
                                                <td>
                                                    <?php echo $name; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['cFindings']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['cPurpose']; ?>
                                                </td>
                                                <td>₱
                                                    <?php echo $data['cAmount']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['cStatus']; ?>
                                                </td>
                                                <td>
                                                    <div class="add">
                                                        <a href="viewClearance.php?cID=<?php echo $data['cID']; ?>">
                                                            <button><i class="fa fa-eye"></i></button>
                                                        </a>
                                                        <a href="editClearance.php?cID=<?php echo $data['cID']; ?>">
                                                            <button><i class="fa fa-pencil"></i></button>
                                                        </a>
                                                        <a href="printClearance.php?cID=<?php echo $data['cID']; ?>">
                                                            <button><i class="fa fa-print"></i></button>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php }
                                        mysqli_close($conn);
                                    } else {
                                        ?>
                                        <tr>
                                            <td>No Records Found</td>
                                        </tr>
                                    <?php }
                                } else {
                                    $result_count = mysqli_query(
                                        $conn,
                                        "SELECT COUNT(*) As total_records FROM `tblclearance` WHERE cStatus = 'Approved'"
                                    );
                                    $total_records = mysqli_fetch_array($result_count);
                                    $total_records = $total_records['total_records'];
                                    $total_no_of_pages = ceil($total_records / $total_records_per_page);
                                    $second_last = $total_no_of_pages - 1; // total pages minus 1
                            
                                    $sql2 = "SELECT * FROM tblclearance INNER JOIN tblaccess ON
                                    tblaccess.aID=tblclearance.aID INNER JOIN tblresidents ON
                                    tblresidents.aID=tblaccess.aID WHERE cStatus = 'Approved' 
                                    ORDER BY cStatus DESC LIMIT $offset, $total_records_per_page ";
                                    $result2 = mysqli_query($conn, $sql2);
                                    $numRows2 = mysqli_num_rows($result2);

                                    if ($numRows2 > 0) {
                                        while ($data = mysqli_fetch_assoc($result2)) { 
                                            if ($data['rSuffix']=="N/A"){
                                                $name = $data['rFirst']." ".$data['rLast'];
                                            } else {
                                                $name = $data['rFirst']." ".$data['rLast']." ".$data['rSuffix'];
                                            }?>
                                            <tr>
                                                <td>
                                                    <?php echo $name; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['cFindings']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['cPurpose']; ?>
                                                </td>
                                                <td>₱
                                                    <?php echo $data['cAmount']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['cStatus']; ?>
                                                </td>
                                                <td>
                                                    <div class="add">
                                                        <a href="viewClearance.php?cID=<?php echo $data['cID']; ?>">
                                                            <button><i class="fa fa-eye"></i></button>
                                                        </a>
                                                        <a href="editClearance.php?cID=<?php echo $data['cID']; ?>">
                                                            <button><i class="fa fa-pencil"></i></button>
                                                        </a>
                                                        <a href="printClearance.php?cID=<?php echo $data['cID']; ?>">
                                                            <button><i class="fa fa-print"></i></button>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td>No Records Found</td>
                                        </tr>
                                    <?php }
                                }
                            } elseif ($_SESSION['role'] == 'Chairman' or $_SESSION['role'] == 'Kagawad') {

                                if (isset($_POST['search'])) {
                                    $valueToSearch = $_POST['valueToSearch'];

                                    $sql = "SELECT * FROM tblclearance INNER JOIN tblaccess ON
                                    tblaccess.aID=tblclearance.aID INNER JOIN tblresidents ON
                                    tblresidents.aID=tblaccess.aID WHERE 
                                    (LOWER (tblresidents.rFirst) LIKE LOWER('%$valueToSearch%') OR 
                                    LOWER(tblresidents.rLast) LIKE LOWER('%$valueToSearch%') OR
                                    LOWER(CONCAT(rFirst, ' ', rLast)) LIKE LOWER('%$valueToSearch%'))
                                    ORDER BY cStatus DESC";
                                    $result = mysqli_query($conn, $sql);
                                    $numRows = mysqli_num_rows($result);

                                    $blotterRec = "SELECT * FROM tblaccess WHERE aType = 'Restricted' ";
                                    $blotterRes = $conn->query($blotterRec);
                                    $fet = mysqli_fetch_assoc($blotterRes);
                                    

                                    if ($numRows > 0) {
                                        while ($data = mysqli_fetch_assoc($result)) { 
                                            if ($data['rSuffix']=="N/A"){
                                                $name = $data['rFirst']." ".$data['rLast'];
                                            } else {
                                                $name = $data['rFirst']." ".$data['rLast']." ".$data['rSuffix'];
                                            }
                                            $wBlotter = $fet['aID'];
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $name; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['cFindings']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['cPurpose']; ?>
                                                </td>
                                                <td>₱
                                                    <?php echo $data['cAmount']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['cStatus']; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $fetchStatus = $data['cStatus'];

                                                    if ($wBlotter == $data['aID'] && $fetchStatus == "Pending") {
                                                        echo "<font color = red>Existing Blotter Record </font color>"; ?>
                                                        <div class="add">
                                                            <a href="viewClearance.php?cID=<?php echo $data['cID']; ?>">
                                                                <button><i class="fa fa-eye"></i></button> </a>
                                                            <a href="rejectClearance.php?cID=<?php echo $data['cID']; ?>">
                                                                <button><i class="fa fa-close"></i></button>
                                                            </a>
                                                        </div>
                                                        <?php
                                                    } else {
                                                        if ($fetchStatus == "Pending") { ?>
                                                            <div class="add">
                                                                <a href="viewClearance.php?cID=<?php echo $data['cID']; ?>">
                                                                    <button><i class="fa fa-eye"></i></button>
                                                                    <a href="approveClearance.php?cID=<?php echo $data['cID']; ?>">
                                                                        <button><i class="fa fa-check"></i></button>
                                                                    </a>
                                                                    <a href="rejectClearance.php?cID=<?php echo $data['cID']; ?>">
                                                                        <button><i class="fa fa-close"></i></button>
                                                                    </a>
                                                            </div>
                                                            <?php
                                                        } elseif ($fetchStatus == "Approved" || $fetchStatus == "Declined") { ?>
                                                            <div class="add">
                                                                <a href="viewClearance.php?cID=<?php echo $data['cID']; ?>">
                                                                    <button><i class="fa fa-eye"></i></button>
                                                                </a>
                                                            </div>
                                                            <?php

                                                        }
                                                    }
                                        }
                                        mysqli_close($conn); ?>
                                            </td>
                                        </tr>
                                    <?php } else {
                                        ?>
                                        <tr>
                                            <td>No Records Found</td>
                                        </tr>
                                    <?php }
                                } else {
                                    $result_count = mysqli_query(
                                        $conn,
                                        "SELECT COUNT(*) As total_records FROM `tblclearance`"
                                    );
                                    $total_records = mysqli_fetch_array($result_count);
                                    $total_records = $total_records['total_records'];
                                    $total_no_of_pages = ceil($total_records / $total_records_per_page);
                                    $second_last = $total_no_of_pages - 1; // total pages minus 1
                            
                                    $sql2 = "SELECT * FROM tblclearance INNER JOIN tblaccess ON
                                    tblaccess.aID=tblclearance.aID INNER JOIN tblresidents ON
                                    tblresidents.aID=tblaccess.aID ORDER BY cStatus DESC
                                    LIMIT $offset, $total_records_per_page";
                                    $result2 = mysqli_query($conn, $sql2);
                                    $numRows2 = mysqli_num_rows($result2);

                                    $blotterRec = "SELECT * FROM tblaccess WHERE aType = 'Restricted' ";
                                    $blotterRes = $conn->query($blotterRec);
                                    $fet = mysqli_fetch_assoc($blotterRes);

                                    if ($numRows2 > 0) {
                                        while ($data = mysqli_fetch_assoc($result2)) {
                                            if ($data['rSuffix']=="N/A"){
                                                $name = $data['rFirst']." ".$data['rLast'];
                                            } else {
                                                $name = $data['rFirst']." ".$data['rLast']." ".$data['rSuffix'];
                                            } 
                                            $wBlotter = $fet['aID'];
                                    
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $name; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['cFindings']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['cPurpose']; ?>
                                                </td>
                                                <td>₱
                                                    <?php echo $data['cAmount']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['cStatus']; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $fetchStatus2 = $data['cStatus'];

                                                    if ($wBlotter == $data['aID'] && $fetchStatus2 == "Pending") {
                                                        echo "<font color = red>Existing Blotter Record </font color>"; ?>
                                                        <div class="add">
                                                            <a href="viewClearance.php?cID=<?php echo $data['cID']; ?>">
                                                                <button><i class="fa fa-eye"></i></button> </a>
                                                            <a href="rejectClearance.php?cID=<?php echo $data['cID']; ?>">
                                                                <button><i class="fa fa-close"></i></button>
                                                            </a>
                                                        </div>
                                                        <?php
                                                    } else {
                                                        if ($fetchStatus2 == "Pending") { ?>
                                                            <div class="add">
                                                                <a href="viewClearance.php?cID=<?php echo $data['cID']; ?>">
                                                                    <button><i class="fa fa-eye"></i></button>
                                                                    <a href="approveClearance.php?cID=<?php echo $data['cID']; ?>">
                                                                        <button><i class="fa fa-check"></i></button>
                                                                    </a>
                                                                    <a href="rejectClearance.php?cID=<?php echo $data['cID']; ?>">
                                                                        <button><i class="fa fa-close"></i></button>
                                                                    </a>
                                                            </div>
                                                            <?php
                                                        } elseif ($fetchStatus2 == "Approved" || $fetchStatus2 == "Declined") { ?>

                                                            <div class="add">
                                                                <a href="viewClearance.php?cID=<?php echo $data['cID']; ?>">
                                                                    <button><i class="fa fa-eye"></i></button>
                                                                </a>
                                                            </div>
                                                            <?php

                                                        }
                                                    }
                                        } ?>
                                            </td>
                                        </tr>
                                        <?php
                                    } else {
                                        ?>
                                        <tr>
                                            <td>No Records Found</td>
                                        </tr>
                                        <?php
                                    }
                                }
                            } else {
                                ?>
                                <tr>
                                    <td>No Records Found</td>
                                </tr>
                                <?php
                            }
                            ?>

                        </tbody>
                    </table>

                    <?php
                    if (isset($_POST['search'])) {
                        ?>

                        <?php
                    } else {
                        ?>
                        <div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
                            <strong>Page
                                <?php echo $page_no . " of " . $total_no_of_pages; ?>
                            </strong>
                        </div>
                        <br>
                        <ul class="pagination">
                            <?php // if($page_no > 1){ echo "<li><a href='?page_no=1'>First Page</a></li>"; } ?>
                            <?php if ($page_no == $total_no_of_pages) {
                                echo "<li><a href='?page_no=1'>&lsaquo;&lsaquo; First</a></li>";
                            } ?>
                            <li <?php if ($page_no <= 1) {
                                echo "class='disabled'";
                            } ?>>
                                <a <?php if ($page_no > 1) {
                                    echo "href='?page_no=$previous_page'";
                                } ?>>Previous</a>

                            </li>

                            <?php

                            if ($total_no_of_pages <= 10) {
                                for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
                                    if ($counter == $page_no) {
                                        echo "<li class='active'><a>$counter</a></li>";
                                    } else {
                                        echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                                    }
                                }
                            } elseif ($total_no_of_pages > 10) {

                                if ($page_no <= 4) {
                                    for ($counter = 1; $counter < 8; $counter++) {
                                        if ($counter == $page_no) {
                                            echo "<li class='active'><a>$counter</a></li>";
                                        } else {
                                            echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                                        }
                                    }
                                    echo "<li><a>...</a></li>";
                                    echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
                                    echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                                } elseif ($page_no > 4 && $page_no < $total_no_of_pages - 4) {
                                    echo "<li><a href='?page_no=1'>1</a></li>";
                                    echo "<li><a href='?page_no=2'>2</a></li>";
                                    echo "<li><a>...</a></li>";
                                    for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {
                                        if ($counter == $page_no) {
                                            echo "<li class='active'><a>$counter</a></li>";
                                        } else {
                                            echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                                        }
                                    }
                                    echo "<li><a>...</a></li>";
                                    echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
                                    echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                                } else {
                                    echo "<li><a href='?page_no=1'>1</a></li>";
                                    echo "<li><a href='?page_no=2'>2</a></li>";
                                    echo "<li><a>...</a></li>";

                                    for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
                                        if ($counter == $page_no) {
                                            echo "<li class='active'><a>$counter</a></li>";
                                        } else {
                                            echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                                        }
                                    }
                                }
                            }
                            ?>

                            <li <?php if ($page_no >= $total_no_of_pages) {
                                echo "class='disabled'";
                            } ?>>
                                <a <?php if ($page_no < $total_no_of_pages) {
                                    echo "href='?page_no=$next_page'";
                                } ?>>Next</a>
                            </li>
                            <?php if ($page_no < $total_no_of_pages) {
                                echo "<li><a href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
                            } ?>
                        </ul>

                        <?php
                    }
                    ?>

                    <br><br>
                    <?php
                    if (
                        $_SESSION['role'] == 'Chairman' or $_SESSION['role'] == 'Kagawad'
                        or $_SESSION['role'] == 'Secretary'
                    ) {
                        ?>
                        <div class="row">
                            <div class="generate">
                                Export: <a href="pdfClearance.php">
                                    <button>
                                        <i class="fa fa-print"></i> PDF
                                    </button>
                                </a>
                                <a href="excelClearance.php">
                                    <button>
                                        <i class="fa fa-print"></i> Excel
                                    </button>
                                </a>
                                <a href="wordClearance.php">
                                    <button>
                                        <i class="fa fa-print"></i> Word
                                    </button>
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>