<?php
include("./../database.php");

/*$id = 234;
$name = "Munch";
$price = 10;
$qunatity = 150;
$status = "Available";
$seller_id = 1345;

*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Add Product</title>
  <link rel="stylesheet" href="style.add-product.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>
  <main class="container">
    <h1>Add New Product</h1>

    <!-- On the server, you can show success/error messages above this form -->

    <form action="request_admin.php" method="post" class="card">
      <fieldset>
        <legend>Product Details</legend>

        <!-- If your DB auto-generates id, leave this blank or remove this field -->
        <div class="form-group">
          <label for="id">ID (optional)</label>
          <input type="number" id="id" name="id" min="1" placeholder="Leave empty if auto" />
        </div>

        <div class="form-group">
          <label for="name">Name<span class="req">*</span></label>
          <input type="text" id="name" name="name" required />
        </div>

        <div class="form-group">
          <label for="quantity">Quantity<span class="req">*</span></label>
          <input type="number" id="quantity" name="quantity" min="0" step="1" required />
        </div>

        <div class="form-group">
          <label for="price">Price (₹)<span class="req">*</span></label>
          <input type="number" id="price" name="price" min="0" step="0.01" required />
        </div>

        <!-- <div class="form-group">
          <label for="status">Status<span class="req">*</span></label>
          <select id="status" name="status" required>
            <option value="" selected disabled>Choose…</option>
            <option value="Available">Available</option>
            <option value="Not Available">Out of Stock</option>
          </select>
        </div> -->

        <div class="form-group">
          <label for="seller_id">Seller ID<span class="req">*</span></label>
          <input type="number" id="seller_id" name="seller_id" required />
        </div>
      </fieldset>

      <div class="actions">
        <button type="submit" class="btn primary">Add Product</button>
        <button type="reset" class="btn">Clear</button>
        <a href="./../index-main.php" class="btn back">Back</a>
      </div>
    </form>

    <p class="note">Fields marked with <span class="req">*</span> are required.</p>
  </main>
</body>

</html>