<?php
include_once 'config.php';
date_default_timezone_set('Asia/Manila');
$name_file = 'Barangay-Blotter-List_' . (date('d-m-Y-H:i:s')) . '.xls';

$sql = "SELECT * FROM tblresidents INNER JOIN tblaccess ON 
tblresidents.aID=tblaccess.aID INNER JOIN tblblotter ON
tblblotter.bComp=tblaccess.aID";
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
            <h2>Barangay Blotter List</h2>
        </caption>
        <thead>
            <th>ID</th>
            <th>Date Recorded</th>
            <th>Date of Incident</th>
            <th>Complainant</th>
            <th>Location</th>
            <th>Person to Complain</th>
            <th>Reason</th>
            <th>Status</th>
        </thead>
        <tbody>
            <?php
            if ($resultCheck > 0) {
                while ($data = mysqli_fetch_array($result)) {

                    $bID = $data['bID'];
                    $bDateR = $data['bDateR'];
                    $bDateI = $data['bDateI'];

                    if ($data['rSuffix'] == "N/A") {
                        $bComp = $data['rFirst'] . " " . $data['rLast'];
                    } else {
                        $bComp = $data['rFirst'] . " " . $data['rLast'] . " " . $data['rSuffix'];
                    }

                    $bLoc = $data['bLoc'];

                    if ($data['rSuffix'] == "N/A") {
                        $bPers = $data['rFirst'] . " " . $data['rLast'];
                    } else {
                        $bPers = $data['rFirst'] . " " . $data['rLast'] . " " . $data['rSuffix'];
                    }
                    $bReason = $data['bReason'];
                    $bStatus = $data['bStatus'];

                    ?>
                    <tr>
                        <td>
                            <?= $bID ?>
                        </td>
                        <td>
                            <?= $bDateR ?>
                        </td>
                        <td>
                            <?= $bDateI ?>
                        </td>
                        <td>
                            <?= $bComp ?>
                        </td>
                        <td>
                            <?= $bLoc ?>
                        </td>
                        <td>
                            <?= $bPers ?>
                        </td>
                        <td>
                            <?= $bReason ?>
                        </td>
                        <td>
                            <?= $bStatus ?>
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