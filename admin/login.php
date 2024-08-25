<?php include("../config/constant.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Store System </title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/Admin.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="login">
    <h1 class="Text-center">Login</h1><br><br>
    <?php
        if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        } 
        if(isset($_SESSION['no'])){
            echo $_SESSION['no'];
            unset($_SESSION['no']);
        }
    ?><br>
    <form action="" method="post" class="Text-center">
        <div class="input-box">
            <input type="text" name="username" placeholder="Username" required>
            <i class='bx bxs-user'></i>
        </div>
        <div class="input-box">
            <input type="password" name="password" placeholder="Password" required>
            <i class='bx bxs-lock-alt'></i>
        </div>
        <input type="submit" name="Submit" value="Login" class="btn">
        <div class="register">
        </div>
    </form>
    </div>
</body>
</html>
<?php
    if(isset($_POST['Submit'])){
        $u_name=$_POST['username'];
        $pass=md5($_POST['password']);
        $sql ="SELECT * FROM admin WHERE username='$u_name' AND password='$pass' ";
        $res=mysqli_query($connect,$sql);
        $count=mysqli_num_rows($res);
        if($count==1){
            $_SESSION['login']='<div class="success">Login Successfull</div>';
            $_SESSION['user']=$u_name;
            header('location:'.siteurl.'admin/');
        }else{
            $_SESSION['login']="<div class='fail'>Data Didn't Match</div>";
            header('location:'.siteurl.'admin/login.php');
        }
    }
?>