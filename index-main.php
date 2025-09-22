<?php
include("database.php");


$sql_fetch = "SELECT * FROM products";
$result = mysqli_query($coni, $sql_fetch);

$sql_user = "SELECT * FROM products";
$prod = mysqli_query($coni, $sql_user);

$count_products = 0;

if (mysqli_num_rows($prod) > 0) {
  while ($row = mysqli_fetch_assoc($prod)) {
    /* echo "<b> Record $count: <br> </b>" ;
      echo $row["id"]. "<br>";
      echo $row["product_name"]. "<br>";
      echo $row["quantity"]. "<br>";
      echo $row["price"]. "<br>";
      echo $row["status"]. "<br>";
      echo $row["seller_id"]. "<br>";
      echo "Record ended". "<br> <br>"; */
    $count_products = $count_products + 1;
  }
} else {
  echo "No record found in the table";
}

$sql_recent_products = "SELECT * FROM products LIMIT 5";
$recent_products = mysqli_query($coni, $sql_recent_products);

mysqli_close($coni);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Inventory Manager — Home</title>
  <link rel="stylesheet" href="style.index.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>
  <header class="site-header">
    <div class="container">
      <h1 class="brand">Inventory Manager, Welcome <?=$_SESSION["user"] ?></h1>
      <!-- <nav class="nav">
        <a href="index.html">Home</a>
        <a href="./Products/add-product.php">Add</a>
        <a href="./Products/edit-product.php">Edit</a>
        <a href="./Products/delete-product.php">Delete</a>
        <a href="./Admin/admin-approval.php">Admin</a>
      </nav> -->
      
      <?php if ((int)$_SESSION["scope"] === 1): ?>
        <nav class="nav">
          <a href="index-main.php">Home</a>
        </nav>
      <?php elseif ((int)$_SESSION["scope"] === 2): ?>
        <nav class="nav">
          <a href="index-main.php">Home</a>
          <a href="./Products/add-product.php">Add</a>
          <a href="./Products/edit-product.php">Edit</a>
          <a href="./Products/delete-product.php">Delete</a>
        </nav>
      <?php elseif ((int)$_SESSION["scope"] === 3) : ?>
        <nav class="nav">
          <a href="index.html">Home</a>
          <a href="./Admin/admin-approval.php">Admin</a>
        </nav>
      <?php else :?>
        <nav class="nav">
          <a href="index.html">Home</a>
        </nav>
      <?php endif; ?>
    </div>
  </header>

  <main class="container">
    <section class="card">
      <h2>Find Products</h2>
      <form action="index.php" method="get" class="grid">
        <section class="custom">
          <div class="form-group">
            <label for="name">Name</label>
            <input id="name" name="name" type="text" placeholder="e.g., Mouse" />
          </div>

          <div class="form-group">
            <label for="seller_name">Seller</label>
            <input id="seller_name" name="seller_name" type="text" placeholder="e.g., TechKart" />
          </div>
        </section>


        <!-- <div class="form-group">
          <label for="status">Status</label>
          <select id="status" name="status">
            <option value="">Any</option>
            <option value="available">Available</option>
            <option value="out_of_stock">Out of Stock</option>
            <option value="discontinued">Discontinued</option>
          </select>
        </div> -->

        <!-- <div class="form-inline">
          <label>Price (₹)</label>
          <div class="inline-row">
            <input name="price_min" type="number" step="0.01" placeholder="Min" />
            <span class="sep">–</span>
            <input name="price_max" type="number" step="0.01" placeholder="Max" />
          </div>
        </div> -->

        <div class="actions">
          <button type="submit" class="btn primary">Search</button>
          <button type="reset" class="btn">Clear</button>
        </div>
      </form>
      <p class="hint">Tip: Leave fields empty to list everything.</p>
    </section>

    <!-- Quick Actions -->
     <?php if ((int)$_SESSION["scope"] === 2): ?>
    <section class="quick">
      <a class="qcard" href="/Product/add-product.html">
        <h3>Add Product</h3>
        <p>Create a new product in the staging queue.</p>
      </a>
      <a class="qcard" href="/Product/edit-product.html">
        <h3>Edit Product</h3>
        <p>Look up by ID and update details.</p>
      </a>
      <a class="qcard" href="/Product/delete-product.html">
        <h3>Delete Product</h3>
        <p>Request removal with confirmation.</p>
      </a>
      <a class="qcard" href="/Admin/admin-requests.html">
        <h3>Admin Response</h3>
        <p>Approve or reject pending changes.</p>
      </a>
    </section>
     <?php endif; ?>

    <!-- Simple Stats (server should render values) -->
    <section class="stats">
      <div class="stat">
        <div class="stat-label">Total Products</div>
        <div class="stat-value"><?= (int)$count_products ?? 0 ?></div>
      </div>
      <div class="stat">
        <div class="stat-label">In Stock</div>
        <div class="stat-value"><!-- <?= (int)$in_stock ?? 0 ?> -->0</div>
      </div>
      <div class="stat">
        <div class="stat-label">Out of Stock</div>
        <div class="stat-value"><!-- <?= (int)$oos ?? 0 ?> -->0</div>
      </div>
      <div class="stat">
        <div class="stat-label">Pending Requests</div>
        <div class="stat-value"><!-- <?= (int)$pending_requests ?? 0 ?> -->0</div>
      </div>
    </section>

    <!-- Recent Products (server loop) -->
    <section class="card">
      <div class="card-head">
        <h2>Recent Products</h2>
        <!-- Optional CTA to a full products page later -->
        <!-- <a class="btn" href="products.php">View All</a> -->
      </div>
      <div class="table-wrap">
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Qty</th>
              <th>Price (₹)</th>
              <th>Seller</th>
            </tr>
          </thead>
          <tbody>

            <?php while ($p = mysqli_fetch_assoc($recent_products)): ?>
              <tr>
                <td><?= htmlspecialchars($p['id']) ?></td>
                <td><?= htmlspecialchars($p['product_name']) ?></td>
                <td><?= htmlspecialchars($p['quantity']) ?></td>
                <td><?= number_format($p['price'], 2) ?></td>
                <td><?= htmlspecialchars($p['seller_id']) ?></td>
              </tr>
            <?php endwhile; ?>

            <?php if (mysqli_fetch_row($recent_products)): ?>
              <tr>
                <td colspan="7" class="muted">No data yet. Connect to your database to show recent items.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </section>

    <!-- Recent Requests (server loop) -->
     <?php if ((int)$_SESSION["scope"] !== 1): ?>
    <section class="card">
      <div class="card-head">
        <h2>Recent Change Requests</h2>
        <?php if ((int)$_SESSION["scope"] === 3): ?>
        <a class="btn" href="/Admin/admin-requests.html">Open Admin</a>
        <?php endif; ?>
      </div>
      <div class="table-wrap">
        <table class="table">
          <thead>
            <tr>
              <th>Req ID</th>
              <th>Type</th>
              <th>Product ID</th>
              <th>Requested By</th>
              <th>Requested At</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <!--
              Example PHP:
              <?php foreach ($recent_requests as $r): ?>
              <tr>
                <td><a href="admin-requests.html#r<?= (int)$r['request_id'] ?>">#<?= (int)$r['request_id'] ?></a></td>
                <td><?= htmlspecialchars($r['action_type']) ?></td>
                <td><?= htmlspecialchars($r['product_id'] ?? '—') ?></td>
                <td><?= htmlspecialchars($r['requested_by']) ?></td>
                <td><?= htmlspecialchars($r['requested_at']) ?></td>
                <td><?= htmlspecialchars($r['status']) ?></td>
              </tr>
              <?php endforeach; ?>
            -->
            <tr>
              <td colspan="6" class="muted">No requests yet.</td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>
    <?php endif; ?>
  </main>

  <footer class="site-footer">
    <div class="container">
      <small>© 2025 Inventory Manager</small>
    </div>
  </footer>
</body>

</html>
