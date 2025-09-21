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
      /* $sql_add_user = "INSERT INTO users (name, id) VALUES('$name', '$id')";
      mysqli_query($coni, $sql_add_user); */

      $sql_check_user = "SELECT *  FROM users WHERE id = $id AND name = '$name'";
      $user = mysqli_query($coni, $sql_check_user);
      
      $user_name;
      $user_id;
      $user_scope;

      while ($result = mysqli_fetch_assoc($user)){
        $user_id = (int)$result["id"]."<br>";
        $user_name = $result["name"]."<br>";
        $user_scope = $result["access"]."<br>";
      }
      //$scope = (int)$result["access"];
      //echo "$scope";
      //echo $GLOBALS["access_scope"] = mysqli_fetch_assoc($user)["access"];
      if (!(isset($user_name))){
        return "No record found";
        exit;
      }
      
      //echo "$user_name Welcome to the Inventory";
      $_SESSION["scope"] = $user_scope;
      $_SESSION["user"] = $user_name;

      echo "<script> window.location.replace('index-main.php'); </script>";

    } catch (mysqli_sql_exception) {
      echo "Database connection Error";
    }
  }
//}

mysqli_close($coni)
?>