<?php
include('../config/constant.php');
// 1. get the code of the product
//echo $code=$_GET['code'];
$id=$_GET['id'];
// 2. create SQL Query to Delete Admin
$sql="DELETE FROM `order` WHERE id=$id";
$res=mysqli_query($connect,$sql);
if($res==True){
    $_SESSION['delete_o']='<div class="success">Order Deleted Successfully</div>';
    header("location:".siteurl.'admin/order.php');
}else{
    $_SESSION['delete_o']='<div class="fail">Failed to Delete The Order</div>';
    header("location:".siteurl.'admin/order.php');
}
?>