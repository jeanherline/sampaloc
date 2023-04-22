<?php
include_once 'config.php';
//date_default_timezone_set('UTC');
date_default_timezone_set('Asia/Manila');
$name_file = 'Barangay-Clearance-List_' . (date('d-m-Y-H:i:s')) . '.doc';

$sql = "SELECT * FROM tblResidents INNER JOIN tblAccess ON 
tblResidents.aID=tblAccess.aID INNER JOIN tblClearance ON
tblClearance.aID=tblAccess.aID";
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
            <h3>Barangay Clearance List</h3>
        </caption>
        <thead>
            <th>Clearance Number</th>
            <th>Resident Name</th>
            <th>Findings</th>
            <th>Purpose</th>
            <th>OR Number</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Date</th>
        </thead>
        <tbody>
            <?php
            if ($resultCheck > 0) {
                while ($data = mysqli_fetch_array($result)) {

                    $cPurpose = $data['cPurpose'];
                    $cStatus = $data['cStatus'];
                    $cStamp = $data['cStamp'];

                    if (empty($data['cNum'])) {
                        $cNum = "N/A";
                    } else {
                        $cNum = $data['cNum'];
                    }

                    if (empty($data['cFindings'])) {
                        $cNum = "N/A";
                    } else {
                        $cFindings = $data['cFindings'];
                    }

                    if (empty($data['cOR'])) {
                        $cOR = "N/A";
                    } else {
                        $cOR = $data['cOR'];
                    }

                    if (empty($data['cAmount'])) {
                        $cAmount = "N/A";
                    } else {
                        $cAmount = $data['cAmount'];
                    }

                    if ($data['rSuffix'] == "N/A") {
                        $cName = $data['rFirst'] . " " . $data['rLast'];
                    } else {
                        $cName = $data['rFirst'] . " " . $data['rLast'] . " " . $data['rSuffix'];
                    }

                    ?>
                    <tr>
                        <td>
                            <?= $cNum ?>
                        </td>
                        <td>
                            <?= $cName ?>
                        </td>
                        <td>
                            <?= $cFindings ?>
                        </td>
                        <td>
                            <?= $cPurpose ?>
                        </td>
                        <td>
                            <?= $cOR ?>
                        </td>
                        <td>
                            <?= $cAmount ?>
                        </td>
                        <td>
                            <?= $cStatus ?>
                        </td>
                        <td>
                            <?= $cStamp ?>
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