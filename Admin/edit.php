<?php
include("./../database.php");
$id = (int)$_POST["approve"];

$sql = "SELECT id,  product_name as prod_name, price, quantity, status, seller_id 
            FROM admin_approval
            WHERE id = $id ";

$old_val = mysqli_query($coni, $sql);
$prod_name = "";
$quantity = "";
$price = "";
$seller_id = "";

while($in = mysqli_fetch_assoc($old_val)){
    $prod_name = $in["prod_name"];
    $quantity = (int)$in["quantity"];
    $price = (int)$in["price"];
    $seller_id = (int)$in["seller_id"];
}

$sql_update = "UPDATE products 
    SET id = $id, product_name = '$prod_name', quantity = $quantity, price = $price, seller_id = $seller_id 
    WHERE id = $id";

$query_update = mysqli_query($coni, $sql_update);

/* if (mysqli_num_rows($quey_check) > 0) {
    //echo "Record dont exists !! please verify the product ID <br>";
    while($row = mysqli_fetch_assoc($quey_check)){
      //echo "<b> Record $count: <br> </b>" ;
      echo $row["id"]. "<br>";
      echo $row["product_name"]. "<br>";
      echo $row["quantity"]. "<br>";
      echo $row["price"]. "<br>";
      echo $row["status"]. "<br>";
      echo $row["seller_id"]. "<br>";
      echo "Record ended". "<br> <br>";
    }
} */

try {
    if ($query_update){
        echo "Query updated";
        $sql_remove = "DELETE FROM admin_approval WHERE id = $id ";
        mysqli_query($coni, $sql_remove);
        echo "<script> window.location.replace('approve-edit-request.php'); </script>";
    }
} catch (mysqli_sql_exception) {
    echo "Error in inserting !!";
} 

?>