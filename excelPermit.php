<?php
include_once 'config.php';
date_default_timezone_set('Asia/Manila');
$name_file = 'Barangay-Permit-List_' . (date('d-m-Y-H:i:s')) . '.xls';

$sql = "SELECT * FROM tblResidents INNER JOIN tblAccess ON 
tblResidents.aID=tblAccess.aID INNER JOIN tblPermit ON
tblPermit.aID=tblAccess.aID";
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
            <h2>Barangay Permit List</h2>
        </caption>
        <thead>
            <th>Permit Number</th>
            <th>Resident Name</th>
            <th>Business Name</th>
            <th>Business Address</th>
            <th>Business Type</th>
            <th>OR Number</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Date and Time</th>
        </thead>
        <tbody>
            <?php
            if ($resultCheck > 0) {
                while ($data = mysqli_fetch_array($result)) {
                    $pStatus = $data['pStatus'];
                    $pStamp = $data['pStamp'];
                    $pBName = $data['pBName'];
                    $pBAdd = $data['pBAdd'];
                    $pBType = $data['pBType'];

                    if (empty($data['pNum'])) {
                        $pNum = "N/A";
                    } else {
                        $pNum = $data['pNum'];
                    }

                    if (empty($data['pFindings'])) {
                        $pFindings = "N/A";
                    } else {
                        $pFindings = $data['pFindings'];
                    }

                    if (empty($data['pOR'])) {
                        $pOR = "N/A";
                    } else {
                        $pOR = $data['pOR'];
                    }

                    if (empty($data['pAmount'])) {
                        $pAmount = "N/A";
                    } else {
                        $pAmount = $data['pAmount'];
                    }

                    if ($data['rSuffix'] == "N/A") {
                        $pName = $data['rFirst'] . " " . $data['rLast'];
                    } else {
                        $pName = $data['rFirst'] . " " . $data['rLast'] . " " . $data['rSuffix'];
                    }
                    ?>
                    <tr>
                        <td>
                            <?= $pNum ?>
                        </td>
                        <td>
                            <?= $pName ?>
                        </td>
                        <td>
                            <?= $pBName ?>
                        </td>
                        <td>
                            <?= $pBAdd ?>
                        </td>
                        <td>
                            <?= $pBType ?>
                        </td>
                        <td>
                            <?= $pOR ?>
                        </td>
                        <td>
                            <?= $pAmount ?>
                        </td>
                        <td>
                            <?= $pStatus ?>
                        </td>
                        <td>
                            <?= $pStamp ?>
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