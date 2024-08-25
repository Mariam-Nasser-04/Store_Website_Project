<?php
    include('reuse/header.php');
?>
   <div class="main">
        <div class="appear">
            <h1>Manage Orders</h1><br><br>
            <a href="<?php echo siteurl; ?>admin/order_search.php" class="btn-1">Search</a>
            <br> <br>
            <?php
             if(isset($_SESSION['update_o'])){
                echo $_SESSION['update_o'];
                unset($_SESSION['update_o']);
            }
            if(isset($_SESSION['delete_o'])){
                echo $_SESSION['delete_o'];
                unset($_SESSION['delete_o']);
            }
            ?> 
            <br> <br>
            <table class="table">
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
                </tr>
                <?php
                $sql = "SELECT * FROM `order` WHERE 1"; // select all
                $res = mysqli_query($connect,$sql);
                    if($res==TRUE){
                        $count = mysqli_num_rows($res); // to get the number of rows in the database
                        if($count>0){
                            while($row = mysqli_fetch_assoc($res)){
                                // store the data in variables 
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
                        }else {
                            ?>
                            <tr>
                                <td colspan="12"><div class="fail">No Order</div></td>
                            </tr>
                                <?php
                        }
                    }
                ?>
            </table>


        </div>
   </div>
<?php
    include('reuse/footer.php');
?>