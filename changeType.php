<?php
require('secure.php');

if (isset($_GET['aID'])) {
    include("config.php");

    $aType = $_POST['aType'];
    $aID = $_GET['aID'];
    
    $query = "UPDATE tblaccess SET aType = '$aType' WHERE aID = '$aID'";
    $result = mysqli_query($conn, $query);

    header('location: usertype.php');
    mysqli_close($conn);
}
?>