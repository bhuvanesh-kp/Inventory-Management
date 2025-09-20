<?php
include("./../database.php");

$id = $_POST["id"];
$name = $_POST["name"];
$price = $_POST["price"];
$qunatity = $_POST["quantity"];
$status = "add"; 
$seller_id = $_POST["seller_id"];
$feed_back = "empty for now";

$sql_check = "SELECT * FROM products WHERE 'id' = '$id'";
$quey_check = mysqli_query($coni, $sql_check);

$sql_delete = "DELETE FROM products WHERE 'id' = '$id'";

if (mysqli_num_rows($quey_check) > 0){
    echo "Record already exists cannot add it again <br>";
    return;
}



$sql_insert = "INSERT INTO admin_approval (id, product_name, quantity, price, status, seller_id, feed_back) 
                VALUES ($id, '$name', $qunatity, $price, '$status', $seller_id, '$feed_back' )";

try {
    mysqli_query($coni, $sql_insert);
    echo "Query updated";
    //return;
    echo "<script> window.location.replace('./../index-main.php'); </script>";
} catch (mysqli_sql_exception) {
    echo "Error in inserting !!";
}

mysqli_close($coni);
return;

?>