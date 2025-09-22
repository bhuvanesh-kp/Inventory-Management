<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Admin — Approvals</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="style.admin-approval.css" />
</head>

<body>
    <main class="container">
        <header class="page-header">
            <h1>Admin — Approvals</h1>
            <p class="sub">Review pending requests and decide to approve or reject.</p>
        </header>


        <nav class="cards">
            <a class="card" href="approve-create-request.php">
                <h2>Create Requests</h2>
                <p>Approve or reject new product additions.</p>
            </a>
            <a class="card" href="approve-edit-request.php">
                <h2>Edit Requests</h2>
                <p>Approve or reject updates to existing products.</p>
            </a>
            <a class="card danger" href="approve-delete-request.php">
                <h2>Delete Requests</h2>
                <p>Approve or reject product removals.</p>
            </a>
        </nav>


        <!-- <section class="hint">
            <p class="muted">Tip: When you convert these to PHP, fetch the request details by <code>request_id</code>
                and render the forms below with real values.</p>
        </section> -->
    </main>
</body>

</html>