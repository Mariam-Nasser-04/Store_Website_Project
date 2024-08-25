<?php
    include('reuse/header.php');
?>
   <div class="main">
        <div class="appear">
            <h1>Manage Admin</h1> <br>
            <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']); 
            }
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']); 
            }
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']); 
            }
            if(isset($_SESSION['user-not-found'])){
                echo $_SESSION['user-not-found'];
                unset($_SESSION['user-not-found']); 
            }
            if(isset($_SESSION['pass-not-match'])){
                echo $_SESSION['pass-not-match'];
                unset($_SESSION['pass-not-match']); 
            }
            if(isset($_SESSION['change_pass'])){
                echo $_SESSION['change_pass'];
                unset($_SESSION['change_pass']); 
            }
            ?>
            <br> <br> 
            <!-- button to add an admin -->
             <a href="add_admin.php" class="btn-1">Add Admin</a>
            <br> <br> <br>
            <table class="table">
                <tr>
                    <th>no.</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>

                <?php
                $sql = "SELECT * FROM admin"; // select all
                $res = mysqli_query($connect,$sql);
                    if($res==TRUE){
                        $count = mysqli_num_rows($res); // to get the number of rows in the database
                        if($count>0){
                            $i=1;
                            while($rows = mysqli_fetch_assoc($res)){
                                // store the data in variables 
                                $id=$rows['id'];
                                $fname=$rows['full_name'];
                                $uname=$rows['username'];
                                $E=$rows['email'];
                                // display the data in the table
                                ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $fname; ?></td>
                                    <td><?php echo $uname; ?></td>
                                    <td><?php echo $E; ?></td>
                                    <td>
                                        <a href="<?php echo siteurl;?>admin/update_admin.php?id=<?php echo $id;?>" class="btn-2">Update</a>
                                        <a href="<?php echo siteurl;?>admin/delete_admin.php?id=<?php echo $id;?>" class="btn-3">Delete</a>
                                        <a href="<?php echo siteurl;?>admin/change_pass.php?id=<?php echo $id;?>" class="btn-4">Change Password</a>
                                    </td>
                                </tr>  
                                <?php
                            }
                        }else {

                        }
                    }
                ?>
            </table>

        </div>
   </div>
<?php
    include('reuse/footer.php');
?>