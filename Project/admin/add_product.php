<?php
include("reuse/header.php");
?>

<div class="main">
    <div class="appear">
        <h1>Add Product</h1>
        <br><br>
        <?php
            if(isset($_SESSION['add_p'])){
                echo $_SESSION['add_p'];
                unset($_SESSION['add_p']); 
            }
            if(isset($_SESSION['upload_p'])){
                echo $_SESSION['upload_p'];
                unset($_SESSION['upload_p']); 
            }
        ?> <br><br>
            <form action="" method="post" enctype="multipart/form-data"> <!--to uploade the image-->
            <table class="table-2">
                    <tr>
                        <td>Code</td>
                        <td><input type="text" name="code" placeholder="Enter Code"></td>
                    </tr>
                    <tr>
                        <td>Type</td>
                        <td><input type="text" name="type" placeholder="Enter Type"></td>
                    </tr>
                    <tr>
                        <td>Size</td>
                        <td><input type="number" name="F_size" placeholder="From"></td>
                        <td><input type="number" style="position: absolute; top:345px; left: 610px;" name="T_size" placeholder="To"></td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td><input type="number" name="price" placeholder="Enter Price"></td>
                    </tr>
                    <tr>
                        <td>Select Image</td>
                        <td><input type="file" name="set_img"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="Submit" value="Add Product" class="btn-2">
                        </td>
                    </tr>
                </table>
            </form>
            <?php
            
                function if_exist($c){
                    $Server='localhost';
                    $DB_User='root';
                    $DB_Pass='';
                    $DB_name="store_data";
                
                    $connect=mysqli_connect($Server,$DB_User,$DB_Pass,$DB_name) or die("wrong");
                    $DB_select = mysqli_select_db($connect,$DB_name) or die(mysqli_error());
                    $sql2 = "SELECT * FROM products";
                    $res2=mysqli_query($connect,$sql2) or die(mysqli_error());
                    if($res2==TRUE){
                        $count2 = mysqli_num_rows($res2); // to get the number of rows in the database
                        if($count2>0){
                            $j=0;
                            while($row = mysqli_fetch_assoc($res2)){
                                $code[$j++]=$row['code'];
                            }
                            for ($i=0; $i < $j; $i++) { 
                                if($code[$i]==$c) return true;
                            }
                            return false;
                        }
                    }
                }

                if(isset($_POST['Submit'])){
                        $code=$_POST['code'];
                        $type=$_POST['type'];
                        $F_size=$_POST['F_size'];
                        $T_size=$_POST['T_size'];
                        $price=$_POST['price'];
                        // check if the image is selected or not
                    if(!if_exist($code)){    
                        if(isset($_FILES['set_img']['name'])){
                            $img=$_FILES['set_img']['name'];
                            if($img!=""){
                                // to rename the image
                                $ext=end(explode('.',$img));
                                $img="Product".rand(000,999).'.'.$ext;

                                $src=$_FILES['set_img']['tmp_name'];
                                $path='../Img/product/'.$img;
                                //upload the image
                                $upload=move_uploaded_file($src,$path);
                                if($upload==FALSE){
                                    $_SESSION['upload_p']='<div class="fail">failed To Upload Image</div>';
                                    header('location:'.siteurl.'admin/add_product.php');
                                    die(); // to stop the process
                                }
                                }
                        }else{
                            $img='';
                        }
                        //insert into database
                        $Insert = "INSERT INTO products (code,type,F_size,T_size,price,image) VALUES ('$code','$type','$F_size','$T_size','$price','$img')";      
                        $res=mysqli_query($connect,$Insert) or die(mysqli_error());
                        if($res==TRUE){
                            // echo "Data Inserted";
                            $_SESSION['add_p']='<div class="success">Product Added Successfully</div>';
                            header('location:'.siteurl.'admin/product.php');
                        }else{
                            // echo "Faild to Insert Data";
                            $_SESSION['add_p']='<div class="fail">failed To Add Product</div>';
                            header('location:'.siteurl.'admin/add_product.php');
                        }
                    }else{
                        // is already exist
                        echo '<center><div class="fail">This Code Is Already Exist</div></center>'; 
                    }    
                }
            ?>

    </div>
</div>

<?php
include("reuse/footer.php");
?>