<?php
include("./../database.php");
$id = (int)$_POST["approve"];
$sql_delete = "DELETE FROM admin_approval WHERE id = $id ";

$sql_check = "SELECT * FROM admin_approval WHERE id = $id";
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

try {
    mysqli_query($coni, $sql_delete);
    echo "Query updated";
    //return;
    echo "<script> window.location.replace('approve-delete-request.php'); </script>";
} catch (mysqli_sql_exception) {
    echo "Error in inserting !!";
}

?>