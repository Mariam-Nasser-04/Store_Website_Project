<?php include('reuse/header.php');?>
<section>
            <center>
        <div class="page">
        <?php
             $sql="SELECT * FROM products";
             $res=mysqli_query($connect,$sql);
             $count=mysqli_num_rows($res);
             $i=1;
            if($count>0){
                   while($row=mysqli_fetch_assoc($res)){
                    $type=$row['type'];
                    if($type=='Running Shoes'){
                        $code=$row['code'];
                        $F_size=$row['F_size'];
                        $T_size=$row['T_size'];
                        $price=$row['price'];
                        $img=$row['image'];
                        ?>
                        <div class="Card">
                        <img src="Img/product/<?php echo $img;?>" alt="shoes">
                            <h3>Price : <?php echo $price?> L.E</h3>
                            <h3>Code : <?php echo $code?></h3><br>
                            <a href="<?php echo siteurl;?>order.php?code=<?php echo $code;?>">Order</a>
                            <h3>Size : <?php 
                            for ($i=$F_size ,$j=1; $i <= $T_size; $i++,$j++) { 
                                if($j%7==0)
                                echo"<br>&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;";
                                echo "<p id='size'>".$i."</p>";
                            }
                            
                            ?></h3><br>
                            </div>
                        <?php
                    }
                   }
            }else{
                echo '<div class="fail">Product Not Added</div>';
            }
         ?>
            </div>
            <br><br>
<?php include('reuse/footer.php');?>