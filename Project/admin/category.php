<?php
    include('reuse/header.php');
?>
   <div class="main">
        <div class="appear">
              <h1>Manage Categories</h1>
              <br> <br>
              <?php
            if(isset($_SESSION['add_c'])){
                echo $_SESSION['add_c'];
                unset($_SESSION['add_c']); 
            }
            if(isset($_SESSION['remove_c'])){
                echo $_SESSION['remove_c'];
                unset($_SESSION['remove_c']);
            }
            if(isset($_SESSION['delete_c'])){
                echo $_SESSION['delete_c'];
                unset($_SESSION['delete_c']);
            }
            if(isset($_SESSION['no_c'])){
                echo $_SESSION['no_c'];
                unset($_SESSION['no_c']);
            }
            if(isset($_SESSION['update_c'])){
                echo $_SESSION['update_c'];
                unset($_SESSION['update_c']);
            }
            if(isset($_SESSION['upload_c'])){
                echo $_SESSION['upload_c'];
                unset($_SESSION['upload_c']);
            }
            ?>
              <br> <br>
            <!-- button to add an admin -->
             <a href="<?php echo siteurl; ?>admin/add_category.php" class="btn-1">Add Category</a>
            <br> <br> <br>
            <table class="table">
                <tr>
                    <th>no.</th>
                    <th>Type</th>
                    <th>Active</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>

                <?php
                $sql = "SELECT * FROM category"; // select all
                $res = mysqli_query($connect,$sql);
                    if($res==TRUE){
                        $i=1;
                        $count = mysqli_num_rows($res); // to get the number of rows in the database
                        if($count>0){
                            while($rows = mysqli_fetch_assoc($res)){
                                // store the data in variables 
                                $id=$rows['id'];
                                $t=$rows['title'];
                                $a=$rows['active'];
                                $img=$rows['image'];
                                // display the data in the table
                                ?>
                                <tr>
                                    <td><?php echo $i++;  ?></td>
                                    <td><?php echo $t;   ?></td>
                                    <td><?php echo $a;   ?></td>
                                    <td>
                                        <?php 
                                            if($img!=''){
                                                ?>
                                               <img src="<?php echo siteurl; ?>Img/category/<?php echo $img; ?>" width='130px' height='100px'>
                                                <?php
                                            }else{
                                                echo '<center><div class="fail">Image not Added</div></center>';
                                            }
                                        ?>
                                    </td>

                                    <td>
                                    <a href="<?php echo siteurl;?>admin/update_category.php?id=<?php echo $id;?>" class="btn-2">Update</a>
                                    <a href="<?php echo siteurl;?>admin/delete_category.php?id=<?php echo $id;?>&image=<?php echo $img;?>" class="btn-3">Delete</a>
                                    </td>
                                </tr>  
                                <?php
                            }
                        }else {
                            ?>
                            <tr>
                                <td colspan="6"><div class="fail">No Category Added</div></td>
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