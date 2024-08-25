<?php
    include('../config/constant.php');
    session_destroy(); // to unset the $_SESSION['user]
    header('location:'.siteurl.'admin/login.php');
?>