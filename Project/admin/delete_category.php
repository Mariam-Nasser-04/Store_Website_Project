<?php
include('../config/constant.php');
// 1. get the id of the category
//echo $id=$_GET['id'];
if(isset($_GET['id'])AND isset($_GET['image'])){
    $id=$_GET['id'];
    $img=$_GET['image'];
    if($img!=""){
        $path="../Img/category/".$img;
        $remove=unlink($path);
        if($remove==false){
            $_SESSION['remove_c']='<div class="fail">Faild to Remove Category Image</div>';
            header("location:".siteurl.'admin/category.php');
            die();
        }
    }
    $sql="DELETE FROM category WHERE id=$id";
    $res=mysqli_query($connect,$sql);
    if($res==True){
        $_SESSION['delete_c']='<div class="success">Category Deleted Successfully</div>';
        header("location:".siteurl.'admin/category.php');
    }else{
        $_SESSION['delete_c']='<div class="fail">Failed to Delete Category</div>';
        header("location:".siteurl.'admin/category.php');
    }
}else{
    header("location:".siteurl.'admin/category.php');
}
?>