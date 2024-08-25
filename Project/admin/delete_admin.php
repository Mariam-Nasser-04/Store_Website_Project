<?php
include('../config/constant.php');
// 1. get the id of the admin
 $id=$_GET['id'];
// 2. create SQL Query to Delete Admin
$sql="DELETE FROM admin WHERE id=$id";
$res=mysqli_query($connect,$sql);
if($res==TRUE){
    //echo "Admin Deleted";
    $_SESSION['delete']='<div class="success">Admin Deleted Successfully</div>';
    header('location:'.siteurl.'admin/manage.php');
}else {
    //echo "Failed To Delete";
    $_SESSION['delete']='<div class="fail">Failed To Delete Try Again Later</div>';
    header('location:'.siteurl.'admin/manage.php');
}
// 3. Redirect to Manage Admin page with massage (success/error)
?>