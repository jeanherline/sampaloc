<?php
require('secure.php');

if (isset($_GET['bID'])) {
    include("config.php");

    $bID = $_GET['bID'];
    $query = "UPDATE tblblotter SET bStatus = 'Archive' WHERE bID = '$bID'";
    $result = mysqli_query($conn, $query);

    header('location: blotter.php');
}
?>