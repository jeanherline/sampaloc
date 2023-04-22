<?php
require('secure.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Resident Profiling</title>
    <link rel="stylesheet" type="text/css" href="assets/css/sections.css" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
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

        .page button {
            display: inline;
            background: white;
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
            padding: 1rem 1rem 1rem 1rem;
            text-align: center;
            justify-content: center;
        }

        td {
            table-layout: fixed;
            padding: 1rem 1.8rem;
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
            <div class="list">
                <div class="list1">
                    <div class="row">
                        <h4>Profiling Records</h4>
                        <div class="search_box">
                            <form action="" method="GET">
                                <input type="text" id="search" name="valueToSearch" placeholder="Search by First Name"
                                    value="<?php if (isset($_GET['search']))
                                        echo $_GET['search']; ?>" autocomplete="off">
                                <button type="submit" name="search">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>
                        <div class="selectFilter">
                            <form action="" method="GET">
                                <select name="residentType" id="residentType" required>
                                    <option value="">Select Resident Type</option>
                                    <option value="Resident" <?php if (isset($_GET['selectType']) && $_GET['selectType'] == 'Resident')
                                        echo 'selected'; ?>>Resident</option>
                                    <option value="Pending" <?php if (isset($_GET['selectType']) && $_GET['selectType'] == 'Pending')
                                        echo 'selected'; ?>>Pending</option>
                                    <option value="Restricted" <?php if (isset($_GET['selectType']) && $_GET['selectType'] == 'Restricted')
                                        echo 'selected'; ?>>Restricted</option>
                                    <option value="Rejected" <?php if (isset($_GET['selectType']) && $_GET['selectType'] == 'Rejected')
                                        echo 'selected'; ?>>Rejected</option>
                                </select>
                                <button type="submit" name="selectType">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>
                        <div class="add">
                            <a href="addResident.php"><button>Add Resident</button></a>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Last Name</th>
                                <th>Suffix</th>
                                <th>Birthday</th>
                                <th>Age</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            include('config.php');


                            if (isset($_GET['search'])) {

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

                                $valueToSearch = $_GET['valueToSearch'];

                                $result_count = mysqli_query(
                                    $conn,
                                    "SELECT COUNT(*) As total_records FROM `tblresidents` WHERE LOWER(rFirst) LIKE LOWER('%$valueToSearch%')"
                                );
                                $total_records = mysqli_fetch_array($result_count);
                                $total_records = $total_records['total_records'];
                                $total_no_of_pages = ceil($total_records / $total_records_per_page);
                                $second_last = $total_no_of_pages - 1; // total pages minus 1
                            
                                $sql = "SELECT * FROM tblresidents INNER JOIN tblaccess ON
                                tblaccess.aID=tblresidents.aID WHERE LOWER(rFirst) LIKE LOWER('%$valueToSearch%')
                                LIMIT $offset, $total_records_per_page";
                                $result = mysqli_query($conn, $sql);
                                $numRows = mysqli_num_rows($result);

                                if ($numRows > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $stat = $row['aType']; ?>
                                        <tr>
                                            <td>
                                                <?php echo $row['rID']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['rFirst']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['rMid']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['rLast']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['rSuffix']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['rBday']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['rAge']; ?>
                                            </td>
                                            <td>
                                                <?php $stat = $row['aType'];
                                                if ($stat == 'Pending') { ?>
                                                    <div class="add">
                                                        <a href="viewResident.php?rID=<?php echo $row['rID']; ?>">
                                                            <button><i class="fa fa-eye"></i></button> </a>
                                                        <a href="approveReg.php?rID=<?php echo $row['rID']; ?>">
                                                            <button><i class="fa fa-check"></i></button> </a>
                                                        <a href="rejectReg.php?rID=<?php echo $row['rID']; ?>">
                                                            <button><i class="fa fa-close"></i></button> </a>
                                                    </div>
                                                    <?php
                                                } elseif ($stat == 'Rejected') {
                                                    ?>
                                                    <div class="add">
                                                        <a href="viewResident.php?rID=<?php echo $row['rID']; ?>">
                                                            <button><i class="fa fa-eye"></i></button>
                                                        </a>
                                                        <a href="approveReg.php?rID=<?php echo $row['rID']; ?>">
                                                            <button><i class="fa fa-check"></i></button> </a>
                                                    </div>
                                                    <?php
                                                } else { ?>
                                                    <div class="add">
                                                        <a href="viewResident.php?rID=<?php echo $row['rID']; ?>">
                                                            <button><i class="fa fa-eye"></i></button>
                                                        </a>
                                                        <a href="editResident.php?rID=<?php echo $row['rID']; ?>">
                                                            <button><i class="fa fa-pencil"></i></button>
                                                        </a>
                                                        <a href="deleteResident.php?rID= <?php echo $row['rID']; ?>"
                                                            onclick="return confirm('Are you sure you want to delete this record?')">
                                                            <button><i class="fa fa-trash"></i></button>
                                                        </a>
                                                        <a href="printIndigency.php?rID=<?php echo $row['rID']; ?>">
                                                            <button><i class="fa fa-print"></i></button>
                                                        </a>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php }
                                    // mysqli_close($conn);
                                } else {
                                    ?>
                                    <tr>
                                        <td>No Records Found</td>
                                    </tr>
                                    <?php
                                }
                            } elseif (isset($_GET['selectType'])) {
                                $bStatus = $_GET['residentType'];

                                if ($bStatus == 'Resident') {
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

                                    $result_count = mysqli_query(
                                        $conn,
                                        "SELECT COUNT(*) As total_records FROM `tblaccess` WHERE aType='Resident'||aType='Kagawad'||
                                        aType='Secretary'||aType='Chairman'||aType='SK Chairman'||aType='Treasurer'"
                                    );
                                    $total_records = mysqli_fetch_array($result_count);
                                    $total_records = $total_records['total_records'];
                                    $total_no_of_pages = ceil($total_records / $total_records_per_page);
                                    $second_last = $total_no_of_pages - 1; // total pages minus 1
                            
                                    $sql = "SELECT * FROM tblresidents INNER JOIN tblaccess ON
                                    tblaccess.aID=tblresidents.aID WHERE aType='Resident'||aType='Kagawad'||
                                    aType='Secretary'||aType='Chairman'||aType='SK Chairman'||aType='Treasurer'
                                    LIMIT $offset, $total_records_per_page";
                                    $result = mysqli_query($conn, $sql);
                                    $numRows = mysqli_num_rows($result);

                                    if ($numRows > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $stat = $row['aType']; ?>
                                            <tr>
                                                <td>
                                                    <?php echo $row['rID']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['rFirst']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['rMid']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['rLast']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['rSuffix']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['rBday']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['rAge']; ?>
                                                </td>
                                                <td>
                                                    <div class="add">
                                                        <a href="viewResident.php?rID=<?php echo $row['rID']; ?>">
                                                            <button><i class="fa fa-eye"></i></button>
                                                        </a>
                                                        <a href="editResident.php?rID=<?php echo $row['rID']; ?>">
                                                            <button><i class="fa fa-pencil"></i></button>
                                                        </a>
                                                        <a href="deleteResident.php?rID= <?php echo $row['rID']; ?>"
                                                            onclick="return confirm('Are you sure you want to delete this record?')">
                                                            <button><i class="fa fa-trash"></i></button>
                                                        </a>
                                                        <a href="printIndigency.php?rID=<?php echo $row['rID']; ?>">
                                                            <button><i class="fa fa-print"></i></button>
                                                        </a>
                                                    </div>
                                                    <?php
                                        }
                                        ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } elseif ($bStatus == 'Restricted' || $bStatus == 'Pending' || $bStatus == 'Rejected') {
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

                                    $result_count = mysqli_query(
                                        $conn,
                                        "SELECT COUNT(*) As total_records FROM `tblaccess` WHERE aType='$bStatus'"
                                    );
                                    $total_records = mysqli_fetch_array($result_count);
                                    $total_records = $total_records['total_records'];
                                    $total_no_of_pages = ceil($total_records / $total_records_per_page);
                                    $second_last = $total_no_of_pages - 1; // total pages minus 1
                            
                                    $sql = "SELECT * FROM tblresidents INNER JOIN tblaccess ON
                                        tblaccess.aID=tblresidents.aID WHERE aType='$bStatus'
                                        LIMIT $offset, $total_records_per_page";
                                    $result = mysqli_query($conn, $sql);
                                    $numRows = mysqli_num_rows($result);

                                    if ($numRows > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $stat = $row['aType']; ?>
                                            <tr>
                                                <td>
                                                    <?php echo $row['rID']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['rFirst']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['rMid']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['rLast']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['rSuffix']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['rBday']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['rAge']; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($stat == 'Pending') { ?>
                                                        <div class="add">
                                                            <a href="viewResident.php?rID=<?php echo $row['rID']; ?>">
                                                                <button><i class="fa fa-eye"></i></button> </a>
                                                            <a href="approveReg.php?rID=<?php echo $row['rID']; ?>">
                                                                <button><i class="fa fa-check"></i></button> </a>
                                                            <a href="rejectReg.php?rID=<?php echo $row['rID']; ?>">
                                                                <button><i class="fa fa-close"></i></button> </a>
                                                        </div>
                                                        <?php
                                                    } elseif ($stat == 'Rejected') {
                                                        ?>
                                                        <div class="add">
                                                            <a href="viewResident.php?rID=<?php echo $row['rID']; ?>">
                                                                <button><i class="fa fa-eye"></i></button> </a>
                                                            <a href="approveReg.php?rID=<?php echo $row['rID']; ?>">
                                                                <button><i class="fa fa-check"></i></button> </a>
                                                        </div>
                                                        <?php
                                                    } else { ?>
                                                        <div class="add">
                                                            <a href="viewResident.php?rID=<?php echo $row['rID']; ?>">
                                                                <button><i class="fa fa-eye"></i></button>
                                                            </a>
                                                            <a href="editResident.php?rID=<?php echo $row['rID']; ?>">
                                                                <button><i class="fa fa-pencil"></i></button>
                                                            </a>
                                                            <a href="deleteResident.php?rID= <?php echo $row['rID']; ?>"
                                                                onclick="return confirm('Are you sure you want to delete this record?')">
                                                                <button><i class="fa fa-trash"></i></button>
                                                            </a>
                                                        </div>
                                                        <?php
                                                    } ?>
                                                </td>
                                            </tr>
                                        <?php }
                                    } else {
                                        ?>
                                        <tr>
                                            <td>No Records Found</td>
                                        </tr>
                                    <?php }
                                }
                            } else {
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

                                $result_count = mysqli_query(
                                    $conn,
                                    "SELECT COUNT(*) As total_records FROM `tblaccess` WHERE aType!='Archive'"
                                );
                                $total_records = mysqli_fetch_array($result_count);
                                $total_records = $total_records['total_records'];
                                $total_no_of_pages = ceil($total_records / $total_records_per_page);
                                $second_last = $total_no_of_pages - 1; // total pages minus 1
                            
                                $sql2 = "SELECT tblaccess.*, tblresidents.* FROM tblresidents INNER JOIN tblaccess ON
                                tblaccess.aID=tblresidents.aID WHERE aType!='Archive' LIMIT $offset, $total_records_per_page";
                                $result2 = mysqli_query($conn, $sql2);
                                $numRows2 = mysqli_num_rows($result2);

                                if ($numRows2 > 0) {
                                    while ($row = mysqli_fetch_assoc($result2)) {
                                        $stat = $row['aType']; ?>
                                        <tr>
                                            <td>
                                                <?php echo $row['rID']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['rFirst']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['rMid']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['rLast']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['rSuffix']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['rBday']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['rAge']; ?>
                                            </td>
                                            <td>
                                                <?php $stat = $row['aType'];
                                                if ($stat == 'Pending') { ?>
                                                    <div class="add">
                                                        <a href="viewResident.php?rID=<?php echo $row['rID']; ?>">
                                                            <button><i class="fa fa-eye"></i></button> </a>
                                                        <a href="approveReg.php?rID=<?php echo $row['rID']; ?>">
                                                            <button><i class="fa fa-check"></i></button> </a>
                                                        <a href="rejectReg.php?rID=<?php echo $row['rID']; ?>">
                                                            <button><i class="fa fa-close"></i></button> </a>
                                                    </div>
                                                    <?php
                                                } elseif ($stat == 'Rejected') {
                                                    ?>
                                                    <div class="add">
                                                        <a href="viewResident.php?rID=<?php echo $row['rID']; ?>">
                                                            <button><i class="fa fa-eye"></i></button> </a>
                                                        <a href="approveReg.php?rID=<?php echo $row['rID']; ?>">
                                                            <button><i class="fa fa-check"></i></button> </a>
                                                    </div>
                                                    <?php
                                                } else { ?>
                                                    <div class="add">
                                                        <a href="viewResident.php?rID=<?php echo $row['rID']; ?>">
                                                            <button><i class="fa fa-eye"></i></button>
                                                        </a>
                                                        <a href="editResident.php?rID=<?php echo $row['rID']; ?>">
                                                            <button><i class="fa fa-pencil"></i></button>
                                                        </a>
                                                        <a href="deleteResident.php?rID= <?php echo $row['rID']; ?>"
                                                            onclick="return confirm('Are you sure you want to delete this record?')">
                                                            <button><i class="fa fa-trash"></i></button>
                                                        </a>
                                                        <a href="printIndigency.php?rID=<?php echo $row['rID']; ?>">
                                                            <button><i class="fa fa-print"></i></button>
                                                        </a>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php }
                                } else {
                                    ?>
                                    <tr>
                                        <td>No Records Found</td>
                                    </tr>
                                    <?php
                                }
                            } ?>
                        </tbody>
                    </table>
                    <div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
                        <strong>Page
                            <?php echo $page_no . " of " . $total_no_of_pages; ?>
                        </strong>
                    </div>
                    <br>
                    <ul class="pagination">
                        <?php
                        // if($page_no > 1){ echo "<li><a href='?page_no=1'>First Page</a></li>"; } ?>
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
                    <br><br>
                    <div class="row">
                        <div class="generate">
                            Export: <a href="pdfResidents.php">
                                <button>
                                    <i class="fa fa-print"></i> PDF
                                </button>
                            </a>
                            <a href="excelResidents.php">
                                <button>
                                    <i class="fa fa-print"></i> Excel
                                </button>
                            </a>
                            <a href="wordResidents.php">
                                <button>
                                    <i class="fa fa-print"></i> Word
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>