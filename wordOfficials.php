<?php
include_once 'config.php';
//date_default_timezone_set('UTC');
date_default_timezone_set('Asia/Manila');
$name_file = 'Barangay-Officials-List_' . (date('d-m-Y-H:i:s')) . '.doc';

$sql = "SELECT * FROM tblofficials INNER JOIN tblaccess ON
tblaccess.aID=tblofficials.aID INNER JOIN tblresidents ON
tblaccess.aID=tblresidents.aID";
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
            <h3>Barangay Officials List</h3>
        </caption>
        <thead>
            <th>Position</th>
            <th>Name</th>
            <th>Contact Number</th>
            <th>Address</th>
            <th>Start of Term</th>
            <th>End of Term</th>
        </thead>
        <tbody>
            <?php
            if ($resultCheck > 0) {
                while ($data = mysqli_fetch_array($result)) {

                    $posi = $data['aType'];
                    if ($data['rSuffix'] == "N/A") {
                        $offName = $data['rFirst'] . " " . $data['rLast'];
                    } else {
                        $offName = $data['rFirst'] . " " . $data['rLast'] . " " . $data['rSuffix'];
                    }
                    $add = $data['rHouse'] . ", " . $data['rPurok'] . ", Sampaloc, San Rafael, Bulacan";
                    $endOfTerm = $data['oTermE'];
                    $startOfTerm = $data['oTermS'];
                    $contact = $data['rContact'];

                    ?>
                    <tr>
                        <td>
                            <?= $posi ?>
                        </td>
                        <td>
                            <?= $offName ?>
                        </td>
                        <td>
                            <?= $contact ?>
                        </td>
                        <td>
                            <?= $add ?>
                        </td>
                        <td>
                            <?= $startOfTerm ?>
                        </td>
                        <td>
                            <?= $endOfTerm ?>
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