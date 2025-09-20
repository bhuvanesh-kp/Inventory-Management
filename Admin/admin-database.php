<?php
    include("./../database.php");
    $sql_fetch = "SELECT * FROM admin_approval";
    $result = mysqli_query($coni, $sql_fetch);
?>