<?php
    include("reuse/header.php");
?>

<div class="main">
    <div class="appear">
        <h1>Update Product</h1> <br><br>
<?php
if(isset($_GET['code'])){
    $c_code=$_GET['code'];
    $sql="SELECT * FROM products WHERE code='$c_code'";
    $res=mysqli_query($connect,$sql);
    $count=mysqli_num_rows($res);
    if($count>0){
        $rows=mysqli_fetch_assoc($res);
        $c_code=$rows['code'];
        $type=$rows['type'];
        $F_size=$rows['F_size'];
        $T_size=$rows['T_size'];
        $price=$rows['price'];
        $c_img=$rows['image'];
    }else{
        $_SESSION['no_p']='<div class="fail">Product Not Found</div>';
        header("location:".siteurl.'admin/product.php');
    }
}else{
    header('location:'.siteurl.'admin/product.php');
}
?>

        <form action="" method="post" enctype="multipart/form-data">
        <table class="table-2">
                    <tr>
                        <td>Code</td>
                        <td><input type="text" name="code" value="<?php echo $c_code ?>"></td>
                    </tr>
                    <tr>
                        <td>Type</td>
                        <td><input type="text" name="type" value="<?php echo $type ?>"></td>
                    </tr>
                    <tr>
                        <td>Size</td>
                        <td>From: <input type="number" name="F_size" value="<?php echo $F_size ?>">&emsp13;&emsp13;To: <input type="number" name="T_size" value="<?php echo $T_size ?>"></td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td><input type="number" name="price" value="<?php echo $price ?>"></td>
                    </tr>
                    <tr>
                        <td>Current Image</td>
                        <td>
                            <?php
                                if($c_img!=''){
                                    ?>
                                    <img src="<?php echo siteurl;?>Img/product/<?php echo $c_img;?>" width="100px" style="border-radius:50%; height:100px;">
                                    <?php
                                }else{
                                    echo '<div class="fail">Image Not Added</div>';
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>New Image</td>
                        <td><input type="file" name="image" ></td>
                    </tr>
                    <tr>
                        <td>
                            <input type="hidden" name="c_image" value="<?php echo $c_img?>">
                            <input type="submit" name="Submit" value="Update Product" class="btn-2">
                        </td>
                    </tr>
                </table>
        </form>
        <?php
            if(isset($_POST['Submit'])){
                $code=$_POST['code'];
                $type=$_POST['type'];
                $F_size=$_POST['F_size'];
                $T_size=$_POST['T_size'];
                $price=$_POST['price'];
                $c_img=$_POST['c_image'];

                if(isset($_FILES['image']['name'])){
                    $img=$_FILES['image']['name'];
                    if($img!=''){
                            $ext=end(explode('.',$img));
                            $img="Product".rand(000,999).'.'.$ext;
                            $src=$_FILES['image']['tmp_name'];
                            $path='../Img/product/'.$img;
                            //upload the image
                            $upload=move_uploaded_file($src,$path);
                            if($upload==FALSE){
                                $_SESSION['upload_p']='<div class="fail">failed To Upload Image</div>';
                                header('location:'.siteurl.'admin/product.php');
                                die(); // to stop the process
                            }
                            if($c_img!=''){
                            $path="../Img/product/".$c_img;
                            $remove=unlink($path);
                            if($remove==false){
                                $_SESSION['remove_p']='<div class="fail">Faild to Remove Current Image</div>';
                                header('location:'.siteurl.'admin/product.php');
                                die();
                            }
                        }
                    }else{
                        $img=$c_img;
                    }
                }else{
                    $img=$c_img;
                }

                $sql="UPDATE products SET code='$code',type='$type',F_size='$F_size',T_size='$T_size',price='$price',image='$img' WHERE code='$c_code'";

                $res=mysqli_query($connect,$sql);
                if($res==true){
                    $_SESSION['update_p']='<div class="success">Product Updated Successfully</div>';
                    header('location:'.siteurl.'admin/product.php');
                }else{
                    $_SESSION['update_p']='<div class="fail">Failed to Updated Product</div>';
                    header('location:'.siteurl.'admin/product.php');
                }

            }
        ?>
    </div>
</div>
<?php
    include("reuse/footer.php");
?>