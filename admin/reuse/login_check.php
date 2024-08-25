<?php
    // check the user is logged in or not 
    if(!isset($_SESSION['user'])){// if the user is not logged in
        $_SESSION['no']='<div class="fail">Please Login To Access Admin Panel</div>';
        header('location:'.siteurl.'admin/login.php');
    }
?>