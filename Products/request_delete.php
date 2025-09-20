<?php
include("./../database.php");


echo "I am here";
$id = $_POST["id"];
$reason = $_POST["reason"];

//$name = $_POST["name"];
//$price = $_POST["price"];
//$qunatity = $_POST["quantity"];
//$status = $_POST["status"];
//$seller_id = $_POST["seller_id"];

$sql_check = "SELECT * FROM products WHERE id = $id";
$quey_check = mysqli_query($coni, $sql_check);


if (mysqli_num_rows($quey_check) > 0) {
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
}

//$sql_insert = "INSERT INTO products (id, product_name, quantity, price, status, seller_id) 
//VALUES ('$id', '$name', '$qunatity', '$price', '$status', '$seller_id')";

$sql_delete = "DELETE FROM products WHERE id = $id";

try {
    mysqli_query($coni, $sql_delete);
    echo "Query updated";
    //return;
    echo "<script> window.location.replace('./../index-main.php'); </script>";
} catch (mysqli_sql_exception) {
    echo "Error in inserting !!";
}

mysqli_close($coni);
//return;
?>