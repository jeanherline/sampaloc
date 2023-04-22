<?php
require('secure.php');

if (isset($_GET['rID'])) {
    include("config.php");

    $rID = $_GET['rID'];

    $sel = "SELECT * FROM tblresidents INNER JOIN tblaccess ON
    tblaccess.aID=tblresidents.aID WHERE rID='$rID'";
    $res = $conn->query($sel);
    $data = mysqli_fetch_assoc($res);
    $aid = $data['aID'];

    $sql = "UPDATE tblaccess SET aType='Archive' WHERE aID='$aid'";
    mysqli_query($conn, $sql);

    header('location: residents.php');

}

?>