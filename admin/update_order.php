<?php
    include("reuse/header.php");
?>

<div class="main">
    <div class="appear">
        <h1>Update Admin</h1> <br>
        <?php
        if(isset($_SESSION['update_o'])){
            echo $_SESSION['update_o'];
            unset($_SESSION['update_o']);
        }
        ?>
        <br>
        <?php
        $id=$_GET['id'];
        $sql = "SELECT * FROM `order` WHERE id=$id";
        $res=mysqli_query($connect,$sql);
        if($res==TRUE){
            $count = mysqli_num_rows($res);
            if($count==1){
                //echo "Admine Avilable";
                $row = mysqli_fetch_assoc($res);
                $c_name=$row['user_name'];
                $type=$row['type'];
                $code=$row['code'];
                $size=$row['size'];
                $qty=$row['quantity'];
                $phone=$row['phone_number'];
                $email=$row['email'];
                $old_address=$row['address'];
                $price=$row['price'];
                $t_price=$row['total_price'];
                $date=$row['date'];
                $statues=$row['statues'];
            }else{
                header("location:".siteurl.'admin/order.php');
            }
        }
        ?>
        <form action="" method="post">
        <table class="table-2">
                    <tr>
                        <td>Order Name</td>
                        <td><?php echo $type;?>-<?php echo $code;?></td>
                    </tr>
                    <tr>
                        <td>Total Price</td>
                        <td><?php echo $t_price;?></td>
                    </tr>
                    <tr>
                        <td>Customer Name</td>
                        <td><input type="text" name="c_name" value="<?php echo $c_name;?>"></td>
                    </tr>
                    <tr>
                        <td>Quantity</td>
                        <td><input type="number" name="qty" value="<?php echo $qty;?>"></td>
                    </tr>
                    <tr>
                        <td>Statues</td>
                        <td>
                            <select name="statues">
                            <option value="Ordered">Ordered</option>
                            <option value="On Delivery">On Delivery</option>
                            <option value="Delivered">Delivered</option>
                            <option value="Cancelled">Cancelled</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Customer Email</td>
                        <td><input type="text" name="email" value="<?php echo $email;?>"></td>
                    </tr>
                    <tr>
                        <td>Customer contact</td>
                        <td><input type="text" name="contact" value="<?php echo $phone;?>"></td>
                    </tr>
                    <tr>
                        <td>Customer Address</td>
                        <td><textarea name="address" cols="30" rows="5"></textarea></td>
                    </tr>
                    <tr>
                        <td>
                            <input type="hidden" name="id" value=<?php echo $id;?>>
                            <input type="hidden" name="price" value=<?php echo $price;?>>
                            <input type="hidden" name="old_address" value=<?php echo $old_address;?>>
                            <input type="submit" name="Submit" value="Update Order" class="btn-2">
                        </td>
                    </tr>
                </table>
        </form>
    </div>
</div>

<?php
    if(isset($_POST['Submit'])){
        //echo "Done";
        $id=$_POST['id'];
        $c_name=$_POST['c_name'];
        $qty=$_POST['qty'];
        $statues=$_POST['statues'];
        $email=$_POST['email'];
        $price=$row['price'];
        $t_price=$price*$qty;
        $phone=$_POST['contact'];
        $address=$_POST['address'];
        if($address=='') $address=$old_address;
        $sql = "UPDATE `order` SET user_name='$c_name',quantity='$qty',statues='$statues',email='$email',total_price='$t_price',price='$price',phone_number='$phone',address='$address' WHERE id=$id;";
        $res =mysqli_query($connect,$sql);

        if($res==TRUE){
            $_SESSION['update_o']='<div class="success">Order Updated Successfully</div>';
            header("location:".siteurl.'admin/order.php');
        }else{
            $_SESSION['update_o']='<div class="fail">Failed To Update Order</div>';
            header("location:".siteurl.'admin/update_order.php');
        }
    }

?>

<?php
    include("reuse/footer.php");
?>