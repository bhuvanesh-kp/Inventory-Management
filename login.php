<?php
include("database.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login</title>
  <link rel="stylesheet" href="style.login.css" />
</head>

<body>
  <main class="page">
    <form class="form" action="working.php" method="post" autocomplete="on">
      <h1 class="title">Login</h1>

      <div class="field">
        <label for="name">Name</label>
        <input
          type="text"
          id="name"
          name="name"
          placeholder="Enter your name"
          required/>
      </div>

      <div class="field">
        <label for="user_id">ID</label>
        <input
          type="text"
          id="user_id"
          name="id" 
          placeholder="Enter your ID"
          pattern="[A-Za-z0-9-_]{3,20}"
          title="3-20 characters: letters, numbers, hyphen or underscore"
          required/>
      </div>

      <button type="submit" class="btn">Sign In</button>
    </form>
  </main>
</body>
</html>
