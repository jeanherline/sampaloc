<?php
include_once 'config.php';
date_default_timezone_set('Asia/Manila');
$name_file = 'Barangay-Residents-List_' . (date('d-m-Y-H:i:s')) . '.xls';

$sql = "SELECT * FROM tblResidents";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);

header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-type: application/x-msexcel; charset=utf-8");
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
    <table style="width: 100%;">
        <caption>
            <h2>Barangay Residents List</h2>
        </caption>
        <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Age</th>
            <th>Civil Status</th>
            <th>Birthday</th>
            <th>Birthplace</th>
            <th>Address</th>
            <th>Contact Number</th>
            <th>Email Address</th>
            <th>Voter Status</th>
            <th>Precint Number</th>
            <th>Occupation</th>
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
                    $rGender = $data['rGender'];
                    $rAge = $data['rAge'];
                    $rCivil = $data['rCivil'];
                    $rBday = $data['rBday'];
                    $rBplace = $data['rBplace'];
                    $rContact = $data['rContact'];
                    $rEmail = $data['rEmail'];
                    $rVoter = $data['rVoter'];
                    $rPrecinct = $data['rPrecinct'];
                    $rOccup = $data['rOccup'];
                    ?>
                    <tr>
                        <td>
                            <?= $rID ?>
                        </td>
                        <td>
                            <?= $rName ?>
                        </td>
                        <td>
                            <?= $rGender ?>
                        </td>
                        <td>
                            <?= $rAge ?>
                        </td>
                        <td>
                            <?= $rCivil ?>
                        </td>
                        <td>
                            <?= $rBday ?>
                        </td>
                        <td>
                            <?= $rBplace ?>
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
                        <td>
                            <?= $rVoter ?>
                        </td>
                        <td>
                            <?= $rPrecinct ?>
                        </td>
                        <td>
                            <?= $rOccup ?>
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