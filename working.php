<?php
include("database.php");

$name = $_POST["name"];
$id = $_POST["id"];


echo "I am here <br>";
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //$user_name = filter_list(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
  //$id = filter_list(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);

  if (empty($name)) echo "Enter your UserName";
  elseif (empty($id)) echo "Enter your ID";
  else {

    try {
      $sql_add_user = "INSERT INTO users (name, id) VALUES('$name', '$id')";
      mysqli_query($coni, $sql_add_user);

      echo "User $name is added, Welcome to the Inventory";

      echo "<script> window.location.replace('index-main.php'); </script>";

    } catch (mysqli_sql_exception) {
      echo "Database connection Error";
    }
  }
//}

mysqli_close($coni)
?>