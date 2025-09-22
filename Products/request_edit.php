<?php
include("./../database.php");


$id = (int)$_POST["id"];
$name = $_POST["prod_name"];
$price = (int)$_POST["price"];
$qunatity = (int)$_POST["quantity"];
$status = "edit"; 
$seller_id = (int)$_POST["seller_id"];
$feed_back = "empty for now";


$sql_edit = "INSERT INTO admin_approval (id, product_name, quantity, price, status, seller_id, feed_back) 
                VALUES ($id, '$name', $qunatity, $price, '$status', $seller_id, '$feed_back' )";

try {
    mysqli_query($coni, $sql_edit);
    echo "Query updated";
    //return;
    echo "<script> window.location.replace('./../index-main.php'); </script>";
} catch (mysqli_sql_exception) {
    echo "Error in inserting !! during editing process";
}

?>