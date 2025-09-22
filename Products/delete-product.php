<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Delete Product</title>
  <link rel="stylesheet" href="style.delete-product.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>
  
  <main class="container">
    <h1>Delete Product</h1>

    <form action="request_delete.php" method="post" class="card">
      <fieldset>
        <legend>Confirm Deletion</legend>

        <div class="form-group">
          <label for="id">Product ID<span class="req">*</span></label>
          <input type="number" id="id" name="id" required />
        </div>

        <div class="form-group">
          <label for="reason">Reason (optional)</label>
          <textarea id="reason" name="reason" rows="4" placeholder="Why are you deleting this product?"></textarea>
        </div>

        <div class="checkbox">
          <input type="checkbox" id="confirm" name="confirm" value="yes" required />
          <label for="confirm">I understand this action cannot be undone.</label>
        </div>
      </fieldset>

      <div class="actions">
        <button type="submit" class="btn danger">Delete</button>
        <button type="reset" class="btn">Clear</button>
        <a href="./../index-main.php" class="btn back">Back</a>
      </div>
    </form>

    <!-- Server can echo a warning or result message here -->
  </main>
</body>
</html>
