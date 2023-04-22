<?php
include_once 'config.php';
//date_default_timezone_set('UTC');
date_default_timezone_set('Asia/Manila');
$name_file = 'Barangay-Residents-List_' . (date('d-m-Y-H:i:s')) . '.doc';

$sql = "SELECT * FROM tblResidents";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);

header("Content-Type: application/vnd.ms-word; charset=utf-8");
header("Content-type: application/x-msword; charset=utf-8");
header("Content-Disposition: attachment; filename=$name_file");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
</head>

<body style="font-family: arial; font-size: 12px;">
    <table style="width: 100%; align-content: center">

        <caption>
            <h3>Barangay Residents List</h3>
        </caption>
        <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Birthday</th>
            <th>Address</th>
            <th>Contact Number</th>
            <th>Email</th>
        </thead>
        <tbody>
            <?php
            if ($resultCheck > 0) {
                while ($data = mysqli_fetch_array($result)) {

                    $rID = $data['rID'];
                    if ($data['rSuffix'] == "N/A") {
                        $rName = $data['rFirst'] . " " . $data['rLast'];
                    } else {
                        $rName = $data['rFirst'] . " " . $data['rLast'] . " " . $data['rSuffix'];
                    }
                    $rAdd = $data['rHouse'] . ", " . $data['rPurok'] . ", Sampaloc, San Rafael, Bulacan";
                    $rAge = $data['rAge'];
                    $rBday = $data['rBday'];
                    $rContact = $data['rContact'];
                    $rEmail = $data['rEmail']

                        ?>
                    <tr>
                        <td>
                            <?= $rID ?>
                        </td>
                        <td>
                            <?= $rName ?>
                        </td>
                        <td>
                            <?= $rAge ?>
                        </td>
                        <td>
                            <?= $rBday ?>
                        </td>
                        <td>
                            <?= $rAdd ?>
                        </td>
                        <td>
                            <?= $rContact ?>
                        </td>
                        <td>
                            <?= $rEmail ?>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table><br>
</body>

</html>