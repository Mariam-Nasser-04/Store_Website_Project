<?php
    include('reuse/header.php');
?>

<div class="main">
    <div class="appear">
        <h1>Change Password</h1>
        <br><br>
        <?php
        if(isset($_GET['id'])){
            $id=$_GET['id'];
        }
        ?>
        <form action="" method="post">
        <table class="table-2">
                    <tr>
                        <td>Old Password</td>
                        <td><input type="password" name="old_password" placeholder="Old Password"></td>
                    </tr>
                    <tr>
                        <td>New Password</td>
                        <td><input type="password" name="new_password" placeholder="New Password"></td>
                    </tr>
                    <tr>
                        <td>Confirm Password</td>
                        <td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>
                    </tr>
                    <tr>
                        <td>
                            <input type="hidden" name="id" value=<?php echo $id;?>>
                            <input type="submit" name="Submit" value="Change Password" class="btn-2">
                        </td>
                    </tr>
        </table>
        </form>
    </div>
</div>
<?php
    if(isset($_POST['Submit'])){
        $id=$_POST['id'];
        $old_pass=md5($_POST['old_password']);
        $n_pass=md5($_POST['new_password']);
        $c_pass=md5($_POST['confirm_password']);

        $sql = "SELECT * FROM admin WHERE id=$id AND password='$old_pass'";
        $res =mysqli_query($connect,$sql);

        if($res==TRUE){
            $count=mysqli_num_rows($res);
            if($count==1){
            if($n_pass==$c_pass){
                    $sql2="UPDATE admin SET password='$n_pass' WHERE id=$id";
                    $res2 =mysqli_query($connect,$sql2);
                    if($res2==TRUE){
                     $_SESSION['change_pass']='<div class="success">Password Changed Successfully</div>';
                     header("location:".siteurl.'admin/manage.php');
                    }else{
                        $_SESSION['change_pass']='<div class="fail">Failed To Change Password</div>';
                        header("location:".siteurl.'admin/manage.php');
                    }
            }else{
                $_SESSION['pass-not-match']='<div class="fail">Password Not Match</div>';
                header("location:".siteurl.'admin/manage.php');
            }
        }else{
            $_SESSION['user-not-found']='<div class="fail">User Is Not Found</div>';
            header("location:".siteurl.'admin/manage.php');
        }
        }
    }
?>

<?php
    include('reuse/footer.php');
?>