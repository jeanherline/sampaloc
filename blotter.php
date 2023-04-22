<?php
require('secure.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Blotter Records</title>
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
            text-align: left;
            font-weight: bold;
        }

        th,
        td {
            padding: 12px 15px;
        }

        tbody tr {
            border-bottom: 1px solid #ddd;
            text-align: left;
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
            padding: 1rem 0rem 1rem 1rem;
            text-align: center;
            justify-content: center;
        }

        td {
            padding: 1rem 1.3rem;
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
                    <a href="blotter.php" class="active">Blotter Records</a>
                    <a href="clearance.php">Clearances</a>
                    <a href="permit.php">Permits</a>
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
                    <a href="blotter.php" class="active">Blotter Records</a>
                    <a href="clearance.php">Clearances</a>
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
                        <h4>Blotter Records</h4>
                        <div class="search_box">
                            <form action="" method="post">
                                <input type="text" id="search" name="valueToSearch" placeholder="Search by Complainant"
                                    autocomplete="off" required>
                                <button type="submit" name="search">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>
                        <div class="selectFilter">
                            <form action="" method="post">
                                <select name="blotterStatus" required>
                                    <option value="" disabled selected hidden>Select Blotter Status</option>
                                    <option value="Solved">Solved</option>
                                    <option value="Unsolved">Unsolved</option>
                                </select>
                                <button type="submit" name="selectType">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>
                        <div class="add">
                            <a href="blotter.php"><button>Refresh Table</button></a>
                        </div>
                        <div class="add">
                            <a href="addBlotter.php"><button>Add Blotter</button></a>
                        </div>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Date Recorded</th>
                                <th>Date of Incident</th>
                                <th>Complainant</th>
                                <th>Reason</th>
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

                           
                            if (isset($_POST['search'])) { //search
                                $valueToSearch = $_POST['valueToSearch'];

                                $sql = "SELECT * FROM tblblotter WHERE 
                                LOWER(bCompOut) LIKE LOWER('%$valueToSearch%')";
                                $res = $conn->query($sql);
                                $rows = mysqli_num_rows($res);

                                if ($rows > 0){
                                    while ($fetch = mysqli_fetch_assoc($res)){
                                        $bOut = $fetch['bOut'];

                                        if ($bOut == "001" || $bOut == "003"){ //comp out SEARCH
                                            $sql = "SELECT * FROM tblblotter WHERE 
                                            (LOWER(tblblotter.bCompOut) LIKE LOWER('%$valueToSearch%')) AND
                                            bStatus!='Archive' ORDER BY FIELD(bStatus, 'Unsolved', 'Solved')";
                                            $result = $conn->query($sql);
                                            $rows = mysqli_num_rows($result);

                                            if($rows > 0){
                                                while($data = mysqli_fetch_assoc($result)){
                                                    $stat = $data['bStatus'];  ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $data['bDateR']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $data['bDateI']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $data['bCompOut']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $data['bReason']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $data['bStatus']; ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($stat == "Solved") { ?>
                                                            <div class="add">
                                                                <a href="viewBlotter.php?bID=<?php echo $data['bID']; ?>">
                                                                    <button><i class="fa fa-eye"></i></button>
                                                                </a>
                                                                <a href="deleteBlotter.php?bID= <?php echo $data['bID']; ?>"
                                                                    onclick="return confirm('Are you sure you want to delete this record?')">
                                                                    <button><i class="fa fa-trash"></i></button>
                                                                </a>
                                                            </div>
                                                            <?php
        
                                                        } else { ?>
                                                            <div class="add">
                                                                <a href="viewBlotter.php?bID=<?php echo $data['bID']; ?>">
                                                                    <button><i class="fa fa-eye"></i></button>
                                                                </a>
                                                                <a href="editBlotter.php?bID=<?php echo $data['bID']; ?>">
                                                                    <button><i class="fa fa-pencil"></i></button>
                                                                </a>
                                                                <a href="deleteBlotter.php?bID= <?php echo $data['bID']; ?>"
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
                                        <?php 
                                        }
                                    }
                                }
                            } else { //comp in SEARCH
                                    $sql = "SELECT * FROM tblresidents INNER JOIN tblaccess ON
                                        tblresidents.aID=tblaccess.aID INNER JOIN tblblotter ON
                                        tblblotter.bComp=tblaccess.aID WHERE 
                                        (LOWER (tblresidents.rFirst) LIKE LOWER('%$valueToSearch%') OR 
                                        LOWER(tblresidents.rLast) LIKE LOWER('%$valueToSearch%') OR
                                        LOWER(CONCAT(rFirst, ' ', rLast)) LIKE LOWER('%$valueToSearch%'))
                                        AND bStatus !='Archive' ORDER BY FIELD(bStatus, 'Unsolved', 'Solved')";
                                    $result = $conn->query($sql);
                                    $rows = mysqli_num_rows($result);
        
                                        if($rows > 0){
                                            while($data = mysqli_fetch_assoc($result)){
                                                $bOut = $data['bOut'];
                                                $stat = $data['bStatus'];

                                                if ($data['rSuffix'] == "N/A"){
                                                    $nameComp = $data['rFirst']." ".$data['rLast'];
                                                } else{
                                                    $nameComp = $data['rFirst']." ".$data['rLast']." ".$data['rSuffix'];
                                                }
                                                $stat = $data['bStatus']; 
        
                                                ?>
                                            <tr>
                                                <td>
                                                    <?php echo $data['bDateR']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['bDateI']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $nameComp; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['bReason']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['bStatus']; ?>
                                                </td>
                                                <td>
                                                    <?php if ($stat == "Solved") { ?>
                                                        <div class="add">
                                                            <a href="viewBlotter.php?bID=<?php echo $data['bID']; ?>">
                                                                <button><i class="fa fa-eye"></i></button>
                                                            </a>
                                                            <a href="deleteBlotter.php?bID= <?php echo $data['bID']; ?>"
                                                                onclick="return confirm('Are you sure you want to delete this record?')">
                                                                <button><i class="fa fa-trash"></i></button>
                                                            </a>
                                                        </div>
                                                        <?php
        
                                                    } else { ?>
                                                        <div class="add">
                                                            <a href="viewBlotter.php?bID=<?php echo $data['bID']; ?>">
                                                                <button><i class="fa fa-eye"></i></button>
                                                            </a>
                                                            <a href="editBlotter.php?bID=<?php echo $data['bID']; ?>">
                                                                <button><i class="fa fa-pencil"></i></button>
                                                            </a>
                                                            <a href="deleteBlotter.php?bID= <?php echo $data['bID']; ?>"
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
                                    <?php 
                                    }
                                }
                            }

                        elseif (isset($_POST['selectType'])) { //filter
                            $bStatus = $_POST['blotterStatus'];

                                $sql = "SELECT * FROM tblblotter WHERE 
                                bStatus = '$bStatus'";
                                $res = $conn->query($sql);
                                $rows = mysqli_num_rows($res);

                                if ($rows > 0){
                                    while ($data = mysqli_fetch_assoc($res)){
                                        $bOut = $data['bOut'];
                                        $stat = $data['bStatus'];
                                        
                                        if ($bOut == "001" || $bOut == "003"){
                                            $nameComp = $data['bCompOut'];
                                        } else if ($bOut == "002" || $bOut == "004"){
                                            $id = $data['bComp'];

                                            $sql = "SELECT * FROM tblresidents INNER JOIN tblaccess ON
                                            tblresidents.aID=tblaccess.aID INNER JOIN tblblotter ON
                                            tblblotter.bComp=tblaccess.aID WHERE bStatus = '$bStatus' AND
                                            tblresidents.aID= '$id'
                                            ORDER BY FIELD(bStatus, 'Unsolved', 'Solved')";
                                        $result = $conn->query($sql);
                                        $rows = mysqli_num_rows($result);
                                            if($rows > 0){
                                                while($fetch = mysqli_fetch_assoc($result)){        
                                                    if ($fetch['rSuffix'] == "N/A"){
                                                        $nameComp = $fetch['rFirst']." ".$fetch['rLast'];
                                                    } else{
                                                        $nameComp = $fetch['rFirst']." ".$fetch['rLast']." ".$fetch['rSuffix'];
                                                    }
                                        }
                                    }
                                }
                                          ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $data['bDateR']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $data['bDateI']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $nameComp; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $data['bReason']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $data['bStatus']; ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($stat == "Solved") { ?>
                                                            <div class="add">
                                                                <a href="viewBlotter.php?bID=<?php echo $data['bID']; ?>">
                                                                    <button><i class="fa fa-eye"></i></button>
                                                                </a>
                                                                <a href="deleteBlotter.php?bID= <?php echo $data['bID']; ?>"
                                                                    onclick="return confirm('Are you sure you want to delete this record?')">
                                                                    <button><i class="fa fa-trash"></i></button>
                                                                </a>
                                                            </div>
                                                            <?php
        
                                                        } else { ?>
                                                            <div class="add">
                                                                <a href="viewBlotter.php?bID=<?php echo $data['bID']; ?>">
                                                                    <button><i class="fa fa-eye"></i></button>
                                                                </a>
                                                                <a href="editBlotter.php?bID=<?php echo $data['bID']; ?>">
                                                                    <button><i class="fa fa-pencil"></i></button>
                                                                </a>
                                                                <a href="deleteBlotter.php?bID= <?php echo $data['bID']; ?>"
                                                                    onclick="return confirm('Are you sure you want to delete this record?')">
                                                                    <button><i class="fa fa-trash"></i></button>
                                                                </a>
                                                            </div>
                                                            <?php
        
                                                        } ?>
        
                                                    </td>
                                                </tr> <?php


                                                    }
                                                } else {    ?>
                                    <tr>
                                        <td>No Records Found</td>
                                    </tr>
                                <?php 
                                }
                            }
               
                            




                        else {
                                $result_count = mysqli_query(
                                    $conn,
                                    "SELECT COUNT(*) As total_records FROM `tblBlotter`
                                    WHERE tblBlotter.bStatus = 'Solved' OR tblBlotter.bStatus = 'Unsolved'"
                                );
                                $total_records = mysqli_fetch_array($result_count);
                                $total_records = $total_records['total_records'];
                                $total_no_of_pages = ceil($total_records / $total_records_per_page);
                                $second_last = $total_no_of_pages - 1; // total pages minus 1
                            
                                $sql2 = "SELECT * FROM tblblotter WHERE tblblotter.bStatus = 'Solved' 
                                    OR tblBlotter.bStatus = 'Unsolved' ORDER BY FIELD(bStatus, 'Unsolved', 'Solved') 
                                    LIMIT $offset, $total_records_per_page";
                                $result2 = mysqli_query($conn, $sql2);
                                $numRows2 = mysqli_num_rows($result2);
                                
                                if ($numRows2 > 0){
                                    while ($data = mysqli_fetch_assoc($result2)){
                                        $bOut = $data['bOut'];
                                        $stat = $data['bStatus'];
                                        
                                        if ($bOut == "001" || $bOut == "003"){
                                            $nameComp = $data['bCompOut'];
                                        } else if ($bOut == "002" || $bOut == "004"){
                                            $id = $data['bComp'];

                                            $sql = "SELECT * FROM tblresidents INNER JOIN tblaccess ON
                                            tblresidents.aID=tblaccess.aID INNER JOIN tblblotter ON
                                            tblblotter.bComp=tblaccess.aID WHERE bStatus != 'Archive' AND
                                            tblresidents.aID= '$id'
                                            ORDER BY FIELD(bStatus, 'Unsolved', 'Solved')";
                                        $result = $conn->query($sql);
                                        $rows = mysqli_num_rows($result);
                                            if($rows > 0){
                                                while($fetch = mysqli_fetch_assoc($result)){        
                                                    if ($fetch['rSuffix'] == "N/A"){
                                                        $nameComp = $fetch['rFirst']." ".$fetch['rLast'];
                                                    } else{
                                                        $nameComp = $fetch['rFirst']." ".$fetch['rLast']." ".$fetch['rSuffix'];
                                                    }
                                        }
                                    }
                                }
                                          ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $data['bDateR']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $data['bDateI']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $nameComp; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $data['bReason']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $data['bStatus']; ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($stat == "Solved") { ?>
                                                            <div class="add">
                                                                <a href="viewBlotter.php?bID=<?php echo $data['bID']; ?>">
                                                                    <button><i class="fa fa-eye"></i></button>
                                                                </a>
                                                                <a href="deleteBlotter.php?bID= <?php echo $data['bID']; ?>"
                                                                    onclick="return confirm('Are you sure you want to delete this record?')">
                                                                    <button><i class="fa fa-trash"></i></button>
                                                                </a>
                                                            </div>
                                                            <?php
        
                                                        } else { ?>
                                                            <div class="add">
                                                                <a href="viewBlotter.php?bID=<?php echo $data['bID']; ?>">
                                                                    <button><i class="fa fa-eye"></i></button>
                                                                </a>
                                                                <a href="editBlotter.php?bID=<?php echo $data['bID']; ?>">
                                                                    <button><i class="fa fa-pencil"></i></button>
                                                                </a>
                                                                <a href="deleteBlotter.php?bID= <?php echo $data['bID']; ?>"
                                                                    onclick="return confirm('Are you sure you want to delete this record?')">
                                                                    <button><i class="fa fa-trash"></i></button>
                                                                </a>
                                                            </div>
                                                            <?php
        
                                                        } ?>
        
                                                    </td>
                                                </tr> <?php


                                                    }
                                                } else {    ?>
                                    <tr>
                                        <td>No Records Found</td>
                                    </tr>
                                <?php 
                                }
                            }
                            ?>
                        </tbody>
                    </table>

                    <?php
                    if (isset($_POST['search'])) {

                    } elseif (isset($_POST['selectType'])) {

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
                                //echo "<li><a href='?page_no=1'>&lsaquo;&lsaquo; First</a></li>";
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
                    <div class="row">
                        <div class="generate">
                            Export: <a href="pdfBlotter.php">
                                <button>
                                    <i class="fa fa-print"></i> PDF
                                </button>
                            </a>
                            <a href="excelBlotter.php">
                                <button>
                                    <i class="fa fa-print"></i> Excel
                                </button>
                            </a>
                            <a href="wordBlotter.php">
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