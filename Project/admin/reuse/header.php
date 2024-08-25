<?php
    include('../config/constant.php');
    include('login_check.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home-Page</title>
    <link rel="stylesheet" href="../css/Admin.css">
    <script src="https://kit.fontawesome.com/e5999de624.js" crossorigin="anonymous"></script>
</head>
<body>
   <div class="header Text-center">
    <div class="appear">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="manage.php">Admin</a></li>
        <li><a href="category.php">Categories</a></li>
        <li><a href="product.php">Products</a></li>
        <li><a href="order.php">orders</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
    </div>
   </div>