<?php include('reuse/header.php');?>

    <?php
        if(isset($_GET['code'])){
            $code=$_GET['code'];
            // Get The Details
            $sql="SELECT * FROM products WHERE code='$code'";
            $res=mysqli_query($connect,$sql);
            $count=mysqli_num_rows($res);
            if($count==1){
                $row=mysqli_fetch_assoc($res);
                $type=$row['type'];
                $F_size=$row['F_size'];
                $T_size=$row['T_size'];
                $price=$row['price'];
                $img=$row['image'];
            }else{
                // Order Is Not avaliable 
                header("location:".siteurl);
            }
        }else{
            // go to home page
            header("location:".siteurl);
        }
    ?>

<div class="main-o">
    <h2 class="Text-center o" style="color:black;"> Fill this form to confirm your order.</h2>
    <form action="" class="order" method="post">
        <fieldset>
            <legend>Selected Product</legend>
            <div class="order-type">
                <h3 class="o"><?php echo $type;?></h3>
                <input type="hidden" name="type" value="<?php echo $type?>">
                <p class="order-price">Price: <?php echo $price;?> L.E</p>
                <input type="hidden" name="price" value="<?php echo $price?>">
                <p class="order-price">size:</p>
                <select name="size" class="input-responsive">
                    <?php
                    for ($i=$F_size; $i <= $T_size; $i++) { 
                        echo "<option>".$i."</option>";
                    }
                    ?>
                </select>
                <input type="hidden" name="code" value="<?php echo $code?>">
                <div class="order-label">Quantity</div>
                <input type="number" name="qty" class="input-responsive" value="1" require>
            </div>
            <div class="order-img">
                <?php
                    if(!$img==''){
                        ?>
                            <img src="<?php echo siteurl;?>Img/product/<?php echo $img;?>" alt="Order" class="img-responsive img-curve">
                        <?php
                    }else{
                       
                    }
                ?>
                <!-- <img src="Img/d5.png" alt="-" class="img-responsive img-curve"> -->
            </div>
            
        </fieldset>
        <fieldset>
            <legend>Delivery Details</legend>
            <div class="order-label">Full Name</div>
            <input type="text" name="f_name" placeholder="Full Name" class="input-responsive" required>

            <div class="order-label">Phone Number</div>
            <input type="tel" name="contact" placeholder="E.g. 0100xxxxx" class="input-responsive" required>
            <?php
                    if(isset($_SESSION['tele'])){
                        echo $_SESSION['tele'];
                        unset($_SESSION['tele']);
                    }
                ?>
            <div class="order-label">Email</div>
            <input type="email" name="email" placeholder="E.g. hi@gmail.com" class="input-responsive" required>
            <div class="order-label">Address</div>
            <textarea name="address" rows="10" placeholder="E.g. Street,City,Country" class="input-responsive" required></textarea>
    <br>
            <input type="submit" name="Submit" value="Confirm Order" class="btn-1">
        </fieldset>
    </form>
        <?php
            if(isset($_POST['Submit'])){
                $tel=$_POST['contact'];
                if(strlen($tel)==12){
                //Get The Details
                $u_name=$_POST['f_name'];
                $type=$_POST['type'];
                $code=$_POST['code'];
                $size=$_POST['size'];
                $qty=$_POST['qty'];
                $email=$_POST['email'];
                $address=$_POST['address'];
                $price=$_POST['price'];
                $t_price=$price*$qty; 
                $date=date('y.m.d h:i:sa');// order date
                $statues='Ordered';

                $Insert = "INSERT INTO `order`(`user_name`, `type`, `code`, `size`, `quantity`, `phone_number`, `email`, `address`, `price`, `total_price`, `date`, `statues`) VALUES ('$u_name','$type','$code','$size','$qty','$tel','$email','$address','$price','$t_price','$date','$statues')";      
                $res2=mysqli_query($connect,$Insert);
                if($res2==TRUE){
                    $_SESSION['order']='<div class="success" style="font-size: 2rem;">Order Placed Successfully</div>';
                    header("location:".siteurl.'index.php#TI');
                }else{
                    $_SESSION['order']='<div class="fail" style="font-size: 2rem;">Failed To Order</div>';
                    header("location:".siteurl.'index.php#TI');
                }
            }
            else{
                   $_SESSION['tele']='<div class="fail">This Phone Number Isn\'t Valid.</div>';
            }
            }
        ?>

</div>

<?php include('reuse/footer.php');?>