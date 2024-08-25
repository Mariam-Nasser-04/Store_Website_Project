<?php
     // Start Session
     session_start();
     define('siteurl','http://localhost/project/');
     
     $Server='localhost';
     $DB_User='root';
     $DB_Pass='';
     $DB_name="store_data";
 
     $connect=mysqli_connect($Server,$DB_User,$DB_Pass,$DB_name) or die("wrong");
     
     $DB_select = mysqli_select_db($connect,$DB_name) or die(mysqli_error());

?>