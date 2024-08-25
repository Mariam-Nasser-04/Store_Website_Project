<?php
    include('config/constant.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Store</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
<section id="container">
<div class="header Text-center">
        <div class="appear">
    <ul>
        <li id="logo"><a href="<?php echo siteurl;?>index.php">SANDAL</a></li>
        <li><a href="<?php echo siteurl;?>index.php">Home</a></li>
        <li><a href="<?php echo siteurl;?>index.php#TI">Categories</a></li>
        <li><a href="<?php echo siteurl;?>#contact_us">Contact Us</a></li>
        <!-- <li><a href="<?php echo siteurl;?>order.php">Order</a></li> -->
        <!-- <li><a href="#">Login</a></li> -->
    </ul>
    </div>
</div>
<script src="http://localhost/project/script.js"></script>
<?php //include('reuse/header.php');?>    
<center>
    
            <div class="B">
        <a href="#TI"><button type="button" class="SHOP">Shop Now</button> </a>
            </div>
            </section>
            <section id="index">
                <center>
            <table id="TI">
            <tr>
                <br><br>
                <?php
            if(isset($_SESSION['order'])){
                echo $_SESSION['order'];
                unset($_SESSION['order']);
            }?>
                <?php
                    $sql="SELECT * FROM category WHERE active='Yes' LIMIT 4";
                    $res=mysqli_query($connect,$sql);
                    $count=mysqli_num_rows($res);
                    $i=1;
                    if($count>0){
                        while($row=mysqli_fetch_assoc($res)){
                            // get the values like title ,image name
                            $type=$row['title'];
                            $img=$row['image'];
                            ?>
                                <td id="p">
                                    <a href="<?php
                                        if($type=='Running Shose'){
                                            echo "Running_Shoes";
                                        }
                                        else echo $type;?>.php">
                                        <div class="card"><br>  
                                        <div id="img<?php echo $i++;?>" style="background-image: url(<?php echo'Img/category/'.$img;?>);"></div>
                                        <h3 class="text"><?php echo $type;?>
                                        </h3>
                                        </div>
                                    </a>
                                </td>
                                <td>&emsp13;&emsp13;&emsp13;&emsp13;</td>
                            <?php
                        }
                    }else{
                        echo '<div class="fail">Category Not Added</div>';
                    }
                ?>               
            </tr>
            </table>
<?php include('reuse/footer.php');?>