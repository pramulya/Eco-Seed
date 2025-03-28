<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simple Cart</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    .cart-container {
      width: 50%;
      margin: auto;
    }
  </style>
</head>

<body>
  <div class="cart-container">
    <h2>Shopping Cart</h2>

    <?php
    $conn = mysqli_connect("127.0.0.1", "root", "", "datamarketplace", port: 3308);
    if (!$conn) {
      die("koneksi gagal");
    }
    ?>

  </div>
</body>

</html>