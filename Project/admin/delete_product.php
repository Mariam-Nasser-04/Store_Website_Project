<?php
include('../config/constant.php');
// 1. get the code of the product
//echo $code=$_GET['code'];
if(isset($_GET['code'])AND isset($_GET['image'])){
    $code=$_GET['code'];
    $img=$_GET['image'];
    if($img!=""){
        $path="../Img/product/".$img;
        $remove=unlink($path);
        if($remove==false){
            $_SESSION['remove_p']='<div class="fail">Faild to Remove Product Image</div>';
            header("location:".siteurl.'admin/product.php');
            die();
        }
    }
    $sql="DELETE FROM products WHERE code='$code'";
    $res=mysqli_query($connect,$sql);
    if($res==True){
        $_SESSION['delete_p']='<div class="success">Product Deleted Successfully</div>';
        header("location:".siteurl.'admin/product.php');
    }else{
        $_SESSION['delete_p']='<div class="fail">Failed to Delete Product</div>';
        header("location:".siteurl.'admin/product.php');
    }
}else{
    header("location:".siteurl.'admin/product.php');
}
?>