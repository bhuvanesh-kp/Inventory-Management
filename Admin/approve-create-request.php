<?php // list-create-requests.php
include("./../database.php");

// Fetch pending create requests
$sql = "SELECT id, product_name as prod_name, price, quantity, status, seller_id 
        FROM admin_approval
        WHERE status = 'add' ";
$res = mysqli_query($coni, $sql);
if (!$res) {
  http_response_code(500);
  die("Query failed: " . $mysqli->error);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Admin — Pending Create Requests</title>
  <link rel="stylesheet" href="style.list-create-requests.css" />
</head>

<body>
  <main class="container">
    <header class="page-header">
      <h1>Pending Create Requests</h1>
      <nav><a href="approve-create-request.php">Approve by ID</a> | <a href="add-product.php">Direct Insert</a></nav>
    </header>

    <?php if ($res->num_rows === 0): ?>
      <p>No pending create requests.</p>
    <?php else: ?>
      <?php while ($row = $res->fetch_assoc()): ?>
        <section class="card">
          <h2>Request #<?= (int)$row['id'] ?> — <?= htmlspecialchars($row['prod_name']) ?></h2>
          <ul class="kv">
            <li><strong>Price:</strong> ₹<?= number_format($row['price'], 2) ?></li>
            <li><strong>Quantity:</strong> <?= (int)$row['quantity'] ?></li>
            <li><strong>Status:</strong> <?= htmlspecialchars($row['status']) ?></li>
            <li><strong>Seller ID:</strong> <?= htmlspecialchars($row['seller_id']) ?></li>
            <!-- <li><strong>Requested By:</strong> <?= htmlspecialchars($row['requested_by']) ?></li>
            <li><strong>Requested At:</strong> <?= htmlspecialchars($row['requested_at']) ?></li> -->
          </ul>

          <form action="add.php" method="post" class="actions">
            <input type="hidden" name="action_type" value="create">
            <input type="hidden" name="request_id" value="<?= (int)$row['id'] ?>">
            <input type="text" name="admin_note" placeholder="Admin note (optional)">
            <button type="submit" name="approve" value="<?=(int)$row['id'] ?>">Approve</button>
            <button type="submit" name="decision" value="reject">Reject</button>
            <a class="btn" href="approve-create-request.php?request_id=<?= (int)$row['id'] ?>">Open</a>
          </form>
        </section>
      <?php endwhile; ?>
    <?php endif; ?>
  </main>
</body>

</html>