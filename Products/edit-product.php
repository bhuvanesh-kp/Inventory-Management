<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Edit Product</title>
  <link rel="stylesheet" href="style.edit-product.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>
  
  <main class="container">
    <h1>Edit Existing Product</h1>

    <form action="view-product.php" method="POST">
      <label for="product_id">Enter Product ID:</label>
      <input type="text" id="product_id" name="id" required>
      <button type="submit" class="btn primary">Search</button>
      <a href="./../index-main.php" class="btn back">Back</a>
    </form>

    <p class="note">First load the product with its ID. The server should pre-fill the fields for editing.</p>
  </main>
</body>
</html>
