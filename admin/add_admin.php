<?php
    include('reuse/header.php');
?>
<div class="main">
        <div class="appear">
            <h1>Add Admin</h1>
            <br><br>
            <?php
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']); 
                }
            ?>
            <br><br>
            <form action="" method="post">
                <table class="table-2">
                    <tr>
                        <td>Full Name</td>
                        <td><input type="text" name="Full_Name" placeholder="Enter Your Name"></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td><input type="text" name="Username" placeholder="Your Username"></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input type="text" name="Email" placeholder="Your Email"></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input type="password" name="Password" placeholder="Your Password"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="Submit" value="Add Admin" class="btn-2">
                        </td>
                    </tr>
                </table>
            </form>
    </div>
</div>

<?php
    include('reuse/footer.php');
?>

<?php
    // Move the data to the database
    if(isset($_POST['Submit']))
    {
        
        $f_name=$_POST['Full_Name'];
        $u_name=$_POST['Username'];
        $Email=$_POST['Email'];
        $pass=md5($_POST['Password']);
        //echo $f_name,'<br>',$u_name,'<br>',$pass;
        // $count="SELECT * FROM admin";
        // $res=mysqli_query($connect,$count) or die(mysqli_error());
        // $i=mysqli_num_rows($res) + 1;
        //echo $i;
        // set the data
        $Insert = "INSERT INTO admin (id,full_name,username,email,password) VALUES ('$i','$f_name','$u_name','$Email','$pass')";      
        //echo $Insert;
        $res=mysqli_query($connect,$Insert) or die(mysqli_error());
        if($res==TRUE){
           // echo "Data Inserted";
            $_SESSION['add']='<div class="success">Admin Added Successfully</div>';
            header('location:'.siteurl.'admin/manage.php');
        }else{
           // echo "Faild to Insert Data";
            $_SESSION['add']='<div class="fail">failed To Add Admin</div>';
            header('location:'.siteurl.'admin/add_admin.php');
        }
    }
?>