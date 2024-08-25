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
                            $sql="SELECT * FROM `order` WHERE user_name='$text' OR email='$text' OR address='$text' OR type='$text' OR code='$text' OR size='$text' OR quantity='$text' OR statues='$text' OR total_price='$text'";
                            $res=mysqli_query($connect,$sql);
                            if($res==TRUE){
                                $count=mysqli_num_rows($res);
                                if($count>0){
                                    echo "
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Address</th>
                                        <th>Product Type</th>
                                        <th>Product Code</th>
                                        <th>Size</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th>Date</th>
                                        <th>Statues</th>
                                        <th>Actions</th>
                                    </tr>";
                                    $i=1;
                                    while($row = mysqli_fetch_assoc($res)){
                                        $price=$row['price'];
                                        $id=$row['id'];
                                        $c_name=$row['user_name'];
                                        $type=$row['type'];
                                        $code=$row['code'];
                                        $size=$row['size'];
                                        $qty=$row['quantity'];
                                        $phone=$row['phone_number'];
                                        $email=$row['email'];
                                        $address=$row['address'];
                                        $t_price=$row['total_price'];
                                        $date=$row['date'];
                                        $statues=$row['statues'];
                                // display the data in the table
                                ?>
                                    <tr>
                                        <td><?php echo $c_name;   ?></td>
                                        <td><?php echo $email;   ?></td>
                                        <td><?php echo $phone;   ?></td>
                                        <td><?php echo $address;   ?></td>
                                        <td><?php echo $type;  ?></td>
                                        <td><?php echo $code;  ?></td>
                                        <td><?php echo $size;  ?></td>
                                        <td><?php echo $qty;  ?></td>
                                        <td><?php echo $t_price;  ?></td>
                                        <td><?php echo $date;  ?></td>
                                        <td><?php echo $statues;  ?></td>
                                        <td>
                                        <a href="<?php echo siteurl;?>admin/update_order.php?id=<?php echo $id;?>" class="btn-2">Update</a>
                                        <a href="<?php echo siteurl;?>admin/delete_order.php?id=<?php echo $id;?>" class="btn-3">Delete</a>
                                        </td>
                                    </tr>
                             <?php
                                    }
                                }else{
                                    $_SESSION['Data']='<center><div style="margin:50px;" class="fail">Data Is Not Found</div></center>';
                                    header("location:".siteurl.'admin/order_search.php');
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