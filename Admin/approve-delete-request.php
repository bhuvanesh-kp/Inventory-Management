<!--  Delete Admin completed  -->

<?php
include("./../database.php");

$err = null;
$found = false;
$request = null;

$sql = "SELECT id, product_name as prod_name, quantity, price, status, seller_id, feed_back as reason
            FROM admin_approval 
            WHERE status = 'delete' ";

$query = mysqli_query($coni, $sql);

$found = true;
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Approve — Delete Request</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="style.approve-delete-request.css" />
</head>

<body>
  <main class="container">
    <header class="page-header">
      <h1>Approve — Delete Request</h1>
      <nav class="crumbs"><a href="admin-approval.html" class="btn">← Back to Approvals</a></nav>
      <p class="sub">Fetch a pending <strong>delete</strong> request, verify product details and reason, then approve or reject.</p>
    </header>

    <div class="form-group">
      <label for="req">Request ID</label>
      <input type="number" id="req" name="request_id" required value="<?= isset($_GET['request_id']) ? (int)$_GET['request_id'] : '' ?>" />
    </div>
    <div class="actions">
      <button class="btn" type="submit">Fetch Request</button>
    </div>
    <p class="muted">Server loads the product preview and the submitter's reason for deletion.</p>
    </form>

    <!-- Lookup form -->

    <?php while ($product = mysqli_fetch_assoc($query)): ?>
      <form action="delete.php" class="card form lookup" method="POST">
        <?php if ($err): ?>
          <p class="err"><?= htmlspecialchars($err) ?></p>
        <?php endif; ?>


        <section class="card preview">
          <h2 class="h">Product Preview</h2>
          <dl class="kv">
            <div>
              <dt>Product ID</dt>
              <dd><?= (int)$product['id'] ?></dd>
            </div>
            <div>
              <dt>Name</dt>
              <dd><?= htmlspecialchars($product['prod_name']) ?></dd>
            </div>
            <div>
              <dt>Quantity</dt>
              <dd><?= is_null($product['quantity']) ? '—' : (int)$product['quantity'] ?></dd>
            </div>
            <div>
              <dt>Price (₹)</dt>
              <dd><?= is_null($product['price']) ? '—' : number_format((float)$product['price'], 2) ?></dd>
            </div>
            <div>
              <dt>Status</dt>
              <dd><?= htmlspecialchars($product['status']) ?></dd>
            </div>
            <div>
              <dt>Seller ID</dt>
              <dd><?= htmlspecialchars($product['seller_id']) ?></dd>
            </div>
          </dl>

          <h3 class="h2">Submitter's Reason</h3>
          <p class="reason"><?= $product['reason'] !== null && $product['reason'] !== '' ? nl2br(htmlspecialchars($product['reason'])) : '<span class="muted">No reason provided.</span>' ?></p>

          <ul class="kv" style="margin-top:12px">
            <li><strong>product #</strong> <?= (int)$product['id'] ?></li>
          </ul>

          <div class="actions">
            <button class="btn approve" type="submit" name="approve" value=<?= htmlspecialchars($product['id']) ?> >Approve</button>
            <button class="btn reject" type="submit" name="decision" value="reject">Reject</button>
          </div>
        </section>
      <?php endwhile; ?>

  </main>
</body>

</html>