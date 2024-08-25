<?php
    include("reuse/header.php");
?>

<div class="main">
    <div class="appear">
        <h1>Update Admin</h1> <br><br>
        <?php
        $id=$_GET['id'];
        $sql = "SELECT * FROM admin WHERE id=$id";
        $res=mysqli_query($connect,$sql);
        if($res==TRUE){
            $count = mysqli_num_rows($res);
            if($count==1){
                //echo "Admine Avilable";
                $row = mysqli_fetch_assoc($res);
                $f_name=$row['full_name'];
                $u_name=$row['username'];
            }else{
                header("location:".siteurl.'admin/manage.php');
            }
        }
        ?>
        <form action="" method="post">
        <table class="table-2">
                    <tr>
                        <td>Full Name</td>
                        <td><input type="text" name="Full_Name" value="<?php echo $f_name;?>"></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td><input type="text" name="Username" value="<?php echo $u_name;?>"></td>
                    </tr>
                    <tr>
                        <td>
                            <input type="hidden" name="id" value=<?php echo $id;?>>
                            <input type="submit" name="Submit" value="Update Admin" class="btn-2">
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
        $f_name=$_POST['Full_Name'];
        $u_name=$_POST['Username'];
        $sql = "UPDATE admin SET full_name= '$f_name',username='$u_name' WHERE id=$id;";
        $res =mysqli_query($connect,$sql);

        if($res==TRUE){
            $_SESSION['update']='<div class="success">Admin Updated Successfully</div>';
            header("location:".siteurl.'admin/manage.php');
        }else{
            $_SESSION['update']='<div class="fail">Failed To Update Admin</div>';
            header("location:".siteurl.'admin/update_admin.php');
        }
    }

?>

<?php
    include("reuse/footer.php");
?>