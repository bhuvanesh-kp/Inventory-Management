<?php
include("./../database.php");

$id = $_POST["id"];
//echo " I am ussing this id = $id";
$sql_pull = "SELECT id,  product_name as prod_name, price, quantity, seller_id 
            FROM products WHERE id = $id";

$result = mysqli_query($coni, $sql_pull);
$row = mysqli_fetch_assoc($result);
$id = $row["id"];
$prod_name = $row["prod_name"];
$quantity = $row["quantity"];
$price = $row["price"];
// $status = $row["status"];
$seller_id = $row["seller_id"];


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Product — View Details</title>
  <link rel="stylesheet" href="style.view-product.css" />
</head>

<body>
  <main class="container">
    <header class="page-header">
      <h1>Product Details</h1>
      <nav class="page-nav">
        <a class="btn" href="./edit-product.php">← Back to Search</a>
      </nav>
    </header>

    <!-- Read-only details (populate via PHP in value="...") -->
      <section class="card">
        <form class="product-form" action="#" method="post">
          <fieldset>
            <legend>Basic Info</legend>
            <div class="grid">
              <div class="form-group">
                <label for="id">Product ID</label>
                <input type="text" id="id" name="id" value="<?=$id?>" readonly />
              </div>

              <div class="form-group">
                <label for="prod_name">Product Name</label>
                <input type="text" id="prod_name" name="prod_name" value="<?=$prod_name?>"readonly />
              </div>

              <div class="form-group">
                <label for="seller_id">Seller ID</label>
                <input type="text" id="seller_id" name="seller_id" value="<?=$seller_id?>" readonly/>
              </div>
            </div>
          </fieldset>

          <fieldset>
            <legend>Inventory & Pricing</legend>
            <div class="grid">
              <div class="form-group">
                <label for="price">Price</label>
                <input type="number" step="0.01" id="price" name="price" value="<?=$price?>" readonly/>
              </div>

              <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" name="quantity" value="<?=$quantity?>" readonly/>
              </div>

              <!-- <div class="form-group">
                <label for="status">Status</label>
                <input type="text" id="status" name="status" value="" />
              </div> -->
            </div>
          </fieldset>

          <!-- Optional actions (links only; no JS) -->
          <!-- <div class="actions">
            <a class="btn" href="edit-product.php?id=" id="editLink">Edit</a>
            <a class="btn danger" href="delete-product.php?id=" id="deleteLink">Delete</a>
          </div> -->

          <!-- Tip: In PHP, echo the ID into the hrefs above, e.g. edit-product.php?id=<?php echo $id; ?> -->
        </form>
      </section>


      <!-- Form to edit and update details -->
       <section class="card">
        <form class="product-form" action="request_edit.php" method="POST">
          <fieldset>
            <legend>Edit Info</legend>
            <div class="grid">
              <div class="form-group">
                <label for="id">Product ID</label>
                <input type="text" id="id" name="id" value="<?=$id?>" readonly />
              </div>

              <div class="form-group">
                <label for="prod_name">Product Name</label>
                <input type="text" id="prod_name" name="prod_name" value="<?=$prod_name?>" required/>
              </div>

              <div class="form-group">
                <label for="seller_id">Seller ID</label>
                <input type="text" id="seller_id" name="seller_id" value="<?=$seller_id?>" required/>
              </div>
            </div>
          </fieldset>

          <fieldset>
            <legend>Inventory & Pricing</legend>
            <div class="grid">
              <div class="form-group">
                <label for="price">Price</label>
                <input type="number" step="0.01" id="price" name="price" value="<?=$price?>" required/>
              </div>

              <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" name="quantity" value="<?=$quantity?>" required />
              </div>

              <!-- <div class="form-group">
                <label for="status">Status</label>
                <input type="text" id="status" name="status" value="" />
              </div> -->
            </div>
          </fieldset>

          <!-- Optional actions (links only; no JS) -->
          <div class="actions">
          <button class="btn approve" type="submit" name="approve" value="<?= $id ?>">apply changes</button>
          <button class="btn reject" type="submit" name="decision" value="reject">Reject</button>
        </div>

          <!-- Tip: In PHP, echo the ID into the hrefs above, e.g. edit-product.php?id=<?php echo $id; ?> -->
        </form>
  </main>
</body>

</html>