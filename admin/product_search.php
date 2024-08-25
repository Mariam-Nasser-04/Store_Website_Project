<?php
    include('../config/constant.php');
    include('reuse/login_check.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home-Page</title>
    <link rel="stylesheet" href="../css/Admin.css">
    <link rel="stylesheet" href="../css/search.css">
    <script src="../jquery.js"></script>
    <script src="https://kit.fontawesome.com/e5999de624.js" crossorigin="anonymous"></script>
</head>
<body style="background-color: rgba(232, 232, 232);">
   <div class="header Text-center">
    <div class="appear">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="manage.php">Admin</a></li>
        <li><a href="category.php">Categories</a></li>
        <li><a href="product.php">Products</a></li>
        <li><a href="order.php">orders</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
    </div>
   </div>
   <div class="main">
        <div class="appear">
            <div class="search-box">
                <form method="post" class="row">
                    <input type="text" name="search-txt" id="input-box" placeholder="Search">
                    <button name="Submit-btn" class="bnt-search"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
                <div class="contant">
                <?php
                if(isset($_SESSION['Data'])){
                    echo $_SESSION['Data'];
                    unset($_SESSION['Data']);
                }
                ?>
                    <table class="table">
                        <?php
                        if(isset($_POST['Submit-btn'])){
                            $text=$_POST['search-txt'];
                            $sql="SELECT * FROM `products` WHERE code='$text' OR type='$text' OR F_size='$text' OR T_size='$text'";
                            $res=mysqli_query($connect,$sql);
                            if($res==TRUE){
                                $count=mysqli_num_rows($res);
                                if($count>0){
                                    echo "
                                    <tr>
                                        <th>no.</th>
                                        <th>Type</th>
                                        <th>Code</th>
                                        <th>Size</th>
                                        <th>Price</th>
                                        <th>Image</th> 
                                        <th>Actions</th>
                                    </tr>";
                                    $i=1;
                                    while($rows = mysqli_fetch_assoc($res)){
                                        $code=$rows['code'];
                                        $type=$rows['type'];
                                        $F_size=$rows['F_size'];
                                        $T_size=$rows['T_size'];
                                        $price=$rows['price'];
                                        $img=$rows['image'];
                                // display the data in the table
                                ?>
                                <tr>
                                    <td><?php echo $i++;   ?></td>
                                    <td><?php echo $type;   ?></td>
                                    <td><?php echo $code;   ?></td>
                                    <td>From: <?php echo $F_size;?>&emsp13; To: <?php echo $T_size;?></td>
                                    <td><?php echo $price;  ?> L.E</td>
                                    <td>
                                        <?php 
                                            if($img!=''){
                                                ?>
                                               <img src="<?php echo siteurl; ?>Img/product/<?php echo $img; ?>"width='100px' style="border-radius:50%; height:100px;">
                                                <?php
                                            }else{
                                                echo '<center><div class="fail">Image not Added</div></center>';
                                            }
                                        ?>
                                    </td>

                                    <td>
                                    <a href="<?php echo siteurl;?>admin/update_product.php?code=<?php echo $code;?>" class="btn-2">Update</a>
                                    <a href="<?php echo siteurl;?>admin/delete_product.php?code=<?php echo $code;?>&image=<?php echo $img;?>" class="btn-3">Delete</a>
                                    </td>
                                </tr>  
                                <?php
                                    }
                                }else{
                                    $_SESSION['Data']='<center><div style="margin:50px;" class="fail">Data Is Not Found</div></center>';
                                    header("location:".siteurl.'admin/product_search.php');
                                }
                            }
                        }
                        ?>
                    </table>
            </div>
        </div>
    </div>
</body>
</html>