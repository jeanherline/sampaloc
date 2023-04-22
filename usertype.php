<?php
require('secure.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>User Type</title>
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
            background: #0052a2;
            color: white;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
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
            width: 100%;
            height: 550px;
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
            text-align:center;
           
        }

        tbody tr.active {
            font-weight: bold;
            color: #4AD489;
        }

        /* table,
        th {
            table-layout: fixed;
            padding: 1rem 1rem 1rem 1rem;
            text-align: center;
            justify-content: center;
        }
        tbody tr {
            border-bottom: 1px solid #ddd;
            text-align: center;
        }
        td {
            width: 100%;
            height: 10%;
            table-layout: fixed;
            padding: 1rem 7.5rem;
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

        <nav>
            <div class="side_navbar">
                <span>Main Menu</span>
                <a href="officials.php">Brgy. Officials</a>
                <a href="residents.php">Residents Info</a>
                <a href="clearance.php">Clearances</a>
                <a href="permit.php">Permits</a>
                <a href="usertype.php" class="active">User Type</a>
                <span></span>

                <span>Quick Link</span>
                <a href="index.php">Home Page</a>
                <a href="https://www.facebook.com/profile.php?id=100064518436649">Facebook Page</a>
            </div>
        </nav>

        <div class="main-body">
            <div class="list">
                <div class="list1">
                    <div class="row">
                        <h4>Change User Type</h4>

                        <div class="search_box">
                            <form action="" method="post">
                                <input type="text" id="search" name="valueToSearch" placeholder="Search by First Name"
                                    autocomplete="off" required>
                                <button type="submit" name="search">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>
                        <div class="selectFilter">
                            <form action="" method="post">
                                <select name="residentType" id="residentType" required size="1px">
                                    <option value="" disabled selected hidden>Select User Type</option>
                                    
                                    <option value="Resident">Residents</option>
                                    <option value="Officials">Officials</option>
                                </select>
                                <script>
                                    window.onload = function () {
                                        var selItem = sessionStorage.getItem("SelItem");
                                        $('#residentType').val(selItem);
                                    }
                                    $('#residentType').change(function () {
                                        var selVal = $(this).val();
                                        sessionStorage.setItem("SelItem", selVal);
                                    });
                                </script>
                                <button type="submit" name="selectType">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>
                        <div class="add">
                            <a href="usertype.php"><button>Refresh Table</button></a>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include('config.php');

                            if (isset($_POST['search'])) {
                                $valueToSearch = $_POST['valueToSearch'];

                                $stmnt = "SELECT * FROM tblresidents INNER JOIN tblaccess ON
                                tblaccess.aID=tblresidents.aID WHERE LOWER(rFirst) LIKE
                                LOWER('%$valueToSearch%') AND (aType!='Rejected' AND aType!='Pending' AND
                                aType!='Archive' AND aType!='Restricted')
                                ORDER BY FIELD(aType, 'Chairman', 'Secretary', 'Treasurer', 'SK Chairman', 'Kagawad', 'Resident')";
                                $res = $conn->query($stmnt);
                                $rows = mysqli_num_rows($res);

                                if ($rows > 0){
                                    while ($fet = mysqli_fetch_array($res)){
                                        if ($fet['rSuffix'] == "N/A"){
                                            $name = $fet['rFirst']." ".$fet['rLast'];
                                        } else{
                                            $name = $fet['rFirst']." ".$fet['rLast']." ".$fet['rSuffix'];
                                        }

                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $name; ?>
                                            </td>
                                            <td>
                                                <?php echo $fet['aType']; ?>
                                            </td>
                                            <td>
                                                <div class="add">
                                                    <a href="editType.php?aID=<?php echo $fet['aID']; ?>">
                                                        <button><i class="fa fa-pencil"></i> Change</button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <?php
                                } else {
                                    ?>
                                    <tr>
                                        <td>No Records Found</td>
                                    </tr>
                                    <?php
                                }
                            } elseif (isset($_POST['selectType'])) {
                                $uType = $_POST['residentType'];

                                if ($uType == 'Resident') {
                                    $sql = "SELECT * FROM tblresidents INNER JOIN tblaccess ON
                                    tblaccess.aID=tblresidents.aID WHERE aType='Resident' ORDER BY rID ASC";
                                    $result = $conn->query($sql);
                                    while ($data = mysqli_fetch_assoc($result)){
                                        if ($data['rSuffix'] == "N/A"){
                                            $name = $data['rFirst']." ".$data['rLast'];
                                        } else{
                                            $name = $data['rFirst']." ".$data['rLast']." ".$data['rSuffix'];
                                        }

                                        ?>
                                <tr>
                                    <td>
                                        <?php echo $name; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['aType']; ?>
                                    </td>
                                    <td>
                                        <div class="add">
                                            <a href="editType.php?aID=<?php echo $data['aID']; ?>">
                                                <button><i class="fa fa-pencil"></i> Change</button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>

                    <?php
                                } else {
                                    $stmnt = "SELECT * FROM tblresidents INNER JOIN tblaccess ON
                                    tblaccess.aID=tblresidents.aID WHERE aType = 'Chairman' OR aType = 'Secretary'
                                    OR aType = 'Treasurer' OR aType = 'SK Chairman' OR aType = 'Kagawad'
                                    ORDER BY FIELD(aType, 'Chairman', 'Secretary', 'Treasurer', 'SK Chairman', 'Kagawad') ";
                                    $res = $conn->query($stmnt);
                                    $rows = mysqli_num_rows($res);
                                    
                                    if ($rows > 0){
                                    while ($data = mysqli_fetch_assoc($res)){
                                        if ($data['rSuffix'] == "N/A"){
                                            $name = $data['rFirst']." ".$data['rLast'];
                                        } else{
                                            $name = $data['rFirst']." ".$data['rLast']." ".$data['rSuffix'];
                                        }

                                        ?>
                                <tr>
                                    <td>
                                        <?php echo $name; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['aType']; ?>
                                    </td>
                                    <td>
                                        <div class="add">
                                            <a href="editType.php?aID=<?php echo $data['aID']; ?>">
                                                <button><i class="fa fa-pencil"></i> Change</button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                                }    
                            }

                        }  else {
                            $sql = "SELECT * FROM tblaccess INNER JOIN tblresidents ON
                            tblaccess.aID=tblresidents.aID WHERE aType = 'Kagawad' OR aType = 'Secretary'
                            OR aType = 'SK Chairman' OR aType = 'Treasurer' OR aType = 'Chairman' 
                            ORDER BY FIELD(aType, 'Chairman', 'Secretary', 'Treasurer', 'SK Chairman', 'Kagawad')";
                            $result = mysqli_query($conn, $sql);
                            while ($data = mysqli_fetch_array($result)) {
                                if ($data['rSuffix'] == "N/A"){
                                    $name = $data['rFirst']." ".$data['rLast'];
                                } else{
                                    $name = $data['rFirst']." ".$data['rLast']." ".$data['rSuffix'];
                                }
                                
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $name; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['aType']; ?>
                                    </td>
                                    <td>
                                        <div class="add">
                                            <a href="editType.php?aID=<?php echo $data['aID']; ?>">
                                                <button><i class="fa fa-pencil"></i> Change</button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>

                            
                    <?php    }

                    ?>           
                            
                </div>
            </div>
        </div>
    </div>
</body>

</html>