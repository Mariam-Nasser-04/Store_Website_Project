<?php
    include('reuse/header.php');
?>
   <div class="main">
        <div class="appear">
             <h1>Manage Products</h1> 
             <br> <br> 
             <?php
            if(isset($_SESSION['add_p'])){
                echo $_SESSION['add_p'];
                unset($_SESSION['add_p']); 
            }
            if(isset($_SESSION['no_p'])){
                echo $_SESSION['no_p'];
                unset($_SESSION['no_p']);
            }
            if(isset($_SESSION['delete_p'])){
                echo $_SESSION['delete_p'];
                unset($_SESSION['delete_p']);
            }
            if(isset($_SESSION['remove_p'])){
                echo $_SESSION['remove_p'];
                unset($_SESSION['remove_p']);
            }
            if(isset($_SESSION['update_p'])){
                echo $_SESSION['update_p'];
                unset($_SESSION['update_p']);
            }
            if(isset($_SESSION['upload_p'])){
                echo $_SESSION['upload_p'];
                unset($_SESSION['upload_p']);
            }
            ?><br><br>
            <!-- button to add an admin -->
             <a href="<?php echo siteurl; ?>admin/add_product.php" class="btn-1">Add Product</a>
             <a href="<?php echo siteurl; ?>admin/product_search.php" class="btn-1">Search For Product</a>
            <br> <br> <br>
            <table class="table">
                <tr>
                    <th>no.</th>
                    <th>Type</th>
                    <th>Code</th>
                    <th>Size</th>
                    <th>Price</th>
                   <th>Image</th> 
                    <th>Actions</th>
                </tr>
                <?php
                $sql = "SELECT * FROM products"; // select all
                $res = mysqli_query($connect,$sql);
                    if($res==TRUE){
                        $i=1;
                        $count = mysqli_num_rows($res); // to get the number of rows in the database
                        if($count>0){
                            while($rows = mysqli_fetch_assoc($res)){
                                // store the data in variables 
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
                        }else {
                            ?>
                            <tr>
                                <td colspan="7"><div class="fail">No Product Added</div></td>
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