<?php
// approve-edit-request.php
include("./../database.php");
$err = null;
$found = false;
$request = null;
$current = null;

// Utility: safe compare (treat null/empty as "no proposal")
function has_proposal($val)
{
  return !(is_null($val) || $val === '');
}

// Load the update request
// ASSUMPTION: change_requests row for updates includes:
//   id, action_type='update', product_id,
//   prod_name (proposed), price (proposed), quantity (proposed), status (proposed), seller_id (proposed),
//   requested_by, requested_at, request_status
$sql = "SELECT id,  product_name as prod_name, price, quantity, status, seller_id 
            FROM admin_approval
            WHERE status ='edit' ";

$sql_products = "SELECT id,  product_name as prod_name, price, quantity, seller_id 
            FROM products ";

$sql_join = "SELECT p.id as id, p.product_name as prev_name, p.price as prev_price, p.quantity as prev_quantity,
    p.seller_id as prev_seller_id, e.product_name as prod_name, e.price as price, e.quantity as quantity, e.seller_id as seller_id, e.status as status
    FROM products p join admin_approval e on p.id = e.id WHERE e.status = 'edit' ";

/* $stmt = mysqli_prepare($coni, $sql);
    $stmt->bind_param("i", $rid);
    $stmt->execute();
    $res = $stmt->get_result();
    $request = $res->fetch_assoc(); */
$query = mysqli_query($coni, $sql_join); // query for the request in admin_approval table

//$request = mysqli_fetch_assoc($query);


if (mysqli_num_rows($query) == 0) {
  $err = "Update request not found.";
  echo "$err <br>";
}

$found = true;
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Approve — Edit Request</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="style.approve-edit-request.css" />
</head>

<body>
  <main class="container">
    <header class="page-header">
      <h1>Approve — Edit Request</h1>
      <nav class="crumbs"><a href="admin-approval.php" class="btn">← Back to Approvals</a></nav>
      <p class="sub">Fetch a pending <strong>update</strong> request, compare current vs proposed, then approve or reject.</p>
    </header>

    <div class="form-group">
          <label for="req">Request ID</label>
          <input type="number" id="req" name="request_id" required value="<?= isset($_GET['request_id']) ? (int)$_GET['request_id'] : '' ?>" />
        </div>
        <div class="actions">
          <button class="btn" type="submit">Fetch Request</button>
        </div>
        <p class="muted">Server loads both current product and proposed values.</p>

    <!-- Lookup form -->
    <?php while ($r = mysqli_fetch_assoc($query)): ?>
      <form action="edit.php" method="POST" class="card form lookup">
        


        <?php if ($err): ?>
          <p class="err"><?= htmlspecialchars($err) ?></p>
        <?php endif; ?>


        <section class="card">
          <h2 class="h">Request Meta</h2>
          <ul class="kv">
            <li><strong>Request #</strong> <?= (int)$r["id"] ?></li> <!-- need to make this request ID has a random number -->
            <li><strong>Product ID</strong> <?= (int)$r['id'] ?></li>
            <!-- <li><strong>Requested By</strong> <?= htmlspecialchars($r['requested_by']) ?></li>
    <li><strong>Requested At</strong> <?= htmlspecialchars($r['requested_at']) ?></li>
    <li><strong>Status</strong> <?= htmlspecialchars($r['request_status']) ?></li> -->
          </ul>
        </section>

        <!-- Comparison table -->

        <section class="card compare">
          <h2 class="h">Changes</h2>
          <table class="diff">
            <thead>
              <tr>
                <th>Field</th>
                <th>Current</th>
                <th>Proposed</th>
              </tr>
            </thead>
            <tbody>
              <tr class="<?= $chg_name ? 'changed' : '' ?>">
                <td>Name</td>
                <td><?= htmlspecialchars($r['prev_name']) ?></td>
                <td><?= has_proposal($r['prod_name']) ? htmlspecialchars($r['prod_name']) : '<span class="muted">—</span>' ?></td>
              </tr>
              <tr class="<?= $chg_price ? 'changed' : '' ?>">
                <td>Price (₹)</td>
                <td><?= number_format((float)$r['prev_price'], 2) ?></td>
                <td><?= has_proposal($r['price']) ? number_format((float)$r['price'], 2) : '<span class="muted">—</span>' ?></td>
              </tr>
              <tr class="<?= $chg_quantity ? 'changed' : '' ?>">
                <td>Quantity</td>
                <td><?= (int)$r['prev_quantity'] ?></td>
                <td><?= has_proposal($r['quantity']) ? (int)$r['quantity'] : '<span class="muted">—</span>' ?></td>
              </tr>
              <!-- <tr class="<?= $chg_status ? 'changed' : '' ?>">
        <td>Status</td>
        <td><?= htmlspecialchars($r['status']) ?></td>
        <td><?= has_proposal($r['status']) ? htmlspecialchars($r['status']) : '<span class="muted">—</span>' ?></td>
      </tr> -->
              <tr class="<?= $chg_seller ? 'changed' : '' ?>">
                <td>Seller ID</td>
                <td><?= htmlspecialchars($r['prev_seller_id']) ?></td>
                <td><?= has_proposal($r['seller_id']) ? htmlspecialchars($r['seller_id']) : '<span class="muted">—</span>' ?></td>
              </tr>
            </tbody>
          </table>
          <p class="muted">Only fields with proposed values (and different from current) are highlighted.</p>
        </section>
      </form>


      <!-- Decision form -->
      <form action="edit.php" method="POST" class="card form">
        <input type="hidden" name="action_type" value="update" />
        <div class="form-group">
          <label for="rid">Request ID</label>
          <input type="number" id="rid" name="request_id" required value="<?= (int)$r['id'] ?>" />
        </div>
        <div class="form-group">
          <label for="note">Admin Note (optional)</label>
          <textarea id="note" name="admin_note" rows="3" placeholder="Reason or comments"></textarea>
        </div>
        <div class="actions">
          <button class="btn approve" type="submit" name="approve" value="<?= $r["id"] ?>">Approve</button>
          <button class="btn reject" type="submit" name="decision" value="reject">Reject</button>
        </div>
      </form>
    <?php endwhile; ?>

  </main>
</body>

</html>