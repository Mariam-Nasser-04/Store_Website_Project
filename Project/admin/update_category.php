<?php
    include("reuse/header.php");
?>

<div class="main">
    <div class="appear">
        <h1>Update Category</h1> <br><br>
<?php
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql="SELECT * FROM category WHERE id=$id";
    $res=mysqli_query($connect,$sql);
    $count=mysqli_num_rows($res);
    if($count>0){
        $row=mysqli_fetch_assoc($res);
        $title=$row['title'];
        $a=$row['active'];
        $c_img=$row['image'];
    }else{
        $_SESSION['no_c']='<div class="fail">Category Not Found</div>';
        header("location:".siteurl.'admin/category.php');
    }
}else{
    header('location:'.siteurl.'admin/category.php');
}
?>

        <form action="" method="post" enctype="multipart/form-data">
        <table class="table-2">
                    <tr>
                        <td>Title</td>
                        <td><input type="text" name="title" value="<?php echo $title?>"></td>
                    </tr>
                    <tr>
                        <td>Active</td>
                        <td>
                            <input <?php if($a=="Yes"){echo 'checked';}?> type="radio" name="Active" value="Yes">Yes
                            <input <?php if($a=="No"){echo 'checked';}?> type="radio" name="Active" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td>Current Image</td>
                        <td>
                            <?php
                                if($c_img!=''){
                                    ?>
                                    <img src="<?php echo siteurl;?>Img/category/<?php echo $c_img;?>" width="100px" style="border-radius:50%; height:100px;">
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
                            <input type="hidden" name="id" value="<?php echo $id?>">
                            <input type="submit" name="Submit" value="Update Category" class="btn-2">
                        </td>
                    </tr>
                </table>
        </form>
        <?php
            if(isset($_POST['Submit'])){
                $id=$_POST['id'];
                $title=$_POST['title'];
                $c_img=$_POST['c_image'];
                $a=$_POST['Active'];

                if(isset($_FILES['image']['name'])){
                    $img=$_FILES['image']['name'];
                    if($img!=''){
                            $ext=end(explode('.',$img));
                            $img="Category".rand(000,999).'.'.$ext;
                            $src=$_FILES['image']['tmp_name'];
                            $path='../Img/category/'.$img;
                            //upload the image
                            $upload=move_uploaded_file($src,$path);
                            if($upload==FALSE){
                                $_SESSION['upload_c']='<div class="fail">failed To Upload Image</div>';
                                header('location:'.siteurl.'admin/category.php');
                                die(); // to stop the process
                            }
                            if($c_img!=''){
                            $path="../Img/category/".$c_img;
                            $remove=unlink($path);
                            if($remove==false){
                                $_SESSION['remove_c']='<div class="fail">Faild to Remove Current Image</div>';
                                header("location:".siteurl.'admin/category.php');
                                die();
                            }
                        }
                    }else{
                        $img=$c_img;
                    }
                }else{
                    $img=$c_img;
                }

                $sql="UPDATE category SET title='$title',active='$a',image='$img' WHERE id=$id";

                $res=mysqli_query($connect,$sql);
                if($res==true){
                    $_SESSION['update_c']='<div class="success">Category Updated Successfully</div>';
                    header('location:'.siteurl.'admin/category.php');
                }else{
                    $_SESSION['update_c']='<div class="fail">Failed to Updated Category</div>';
                    header('location:'.siteurl.'admin/category.php');
                }

            }
        ?>
    </div>
</div>
<?php
    include("reuse/footer.php");
?>