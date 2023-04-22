<?php
require('secure.php');

if (isset($_GET['oID'])) {
    $id = $_GET['oID'];
}

include("config.php");

$query = "UPDATE tblofficials SET oStatus = 'Approved' WHERE oID = '$id'";
$result = mysqli_query($conn, $query);

if ($result) {
    header('location: officials.php');
} else {
    echo "<br><p><font color=green>Data Not Updated</font color></p>";
}
mysqli_close($conn);
?>