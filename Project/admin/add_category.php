<?php
include("reuse/header.php");
?>

<div class="main">
    <div class="appear">
        <h1>Add Category</h1>
        <br><br>
        <?php
            if(isset($_SESSION['add_c'])){
                echo $_SESSION['add_c'];
                unset($_SESSION['add_c']); 
            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']); 
            }
        ?> <br><br>
            <form action="" method="post" enctype="multipart/form-data"> <!--to uploade the image-->
            <table class="table-2">
                    <tr>
                        <td>Title</td>
                        <td><input type="text" name="title" placeholder="Category Title"></td>
                    </tr>
                    <tr>
                        <td>Select Image</td>
                        <td><input type="file" name="set_img"></td>
                    </tr>
                    <tr>
                        <td>Active</td>
                        <td>
                            <input type="radio" name="active" value="Yes">Yes
                            <input type="radio" name="active" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="Submit" value="Add Category" class="btn-2">
                        </td>
                    </tr>
                </table>
            </form>
            <?php
                if(isset($_POST['Submit'])){
                    $title=$_POST['title'];
                    // check if the other data is selected
                    if(isset($_POST['active'])){
                        $a=$_POST['active'];
                    }else {
                        // set a defult value
                        $a='No';
                    }
                    // check if the image is selected or not
                    if(isset($_FILES['set_img']['name'])){
                        $img=$_FILES['set_img']['name'];
                        if($img!=""){
                            // to rename the image
                            $ext=end(explode('.',$img));
                            $img="Category".rand(000,999).'.'.$ext;

                            $src=$_FILES['set_img']['tmp_name'];
                            $path='../Img/category/'.$img;
                            //upload the image
                            $upload=move_uploaded_file($src,$path);
                            if($upload==FALSE){
                                $_SESSION['upload']='<div class="fail">failed To Upload Image</div>';
                                header('location:'.siteurl.'admin/add_category.php');
                                die(); // to stop the process
                            }
                            }
                    }else{
                        $img='';
                    }
                    //insert into database
                    $Insert = "INSERT INTO category (title,active,image) VALUES ('$title','$a','$img')";      
                    $res=mysqli_query($connect,$Insert) or die(mysqli_error());
                    if($res==TRUE){
                        // echo "Data Inserted";
                         $_SESSION['add_c']='<div class="success">Category Added Successfully</div>';
                         header('location:'.siteurl.'admin/category.php');
                     }else{
                        // echo "Faild to Insert Data";
                         $_SESSION['add_c']='<div class="fail">failed To Add Category</div>';
                         header('location:'.siteurl.'admin/add_category.php');
                     }
                }
            ?>

    </div>
</div>

<?php
include("reuse/footer.php");
?>