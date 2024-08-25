<?php
    include('reuse/header.php');
?>
   <div class="main">
            <div class="appear">
                <h1>Dashboard</h1>
                <br><br>
                <?php
                    if(isset($_SESSION['login'])){
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <br><br>
        <div class="col-4 Text-center">
            <?php
                $sql1="SELECT * FROM category";
                $res1=mysqli_query($connect,$sql1);
                $count1=mysqli_num_rows($res1);
            ?>
            <h1><?php echo $count1; ?></h1>
            <br>
             Categories
        </div>
        <div class="col-4 Text-center">
             <?php
                $sql2="SELECT * FROM products";
                $res2=mysqli_query($connect,$sql2);
                $count2=mysqli_num_rows($res2);
            ?>
            <h1><?php echo $count2; ?></h1>
            <br>
             products
        </div>
        <div class="col-4 Text-center">
            <?php
                $sql3="SELECT * FROM `order`";
                $res3=mysqli_query($connect,$sql3);
                $count3=mysqli_num_rows($res3);
            ?>
            <h1><?php echo $count3; ?></h1>
            <br>
             orders
        </div>
        <div class="col-4 Text-center">
            <?php
                $sql4="SELECT SUM(total_price) AS Total FROM `order` WHERE statues='Delivered'";
                $res4=mysqli_query($connect,$sql4);
                $row=mysqli_fetch_assoc($res4);
                $total = $row['Total'];
            ?>
            <h1><?php echo $total." L.E";?></h1>
            <br>
             Revenue Generated
        </div>
        <div class="fix"></div>
            </div>
   </div>
<?php
    include('reuse/footer.php');
?>
<!-- Code To Reset The ID -->
 <!-- 
        SET @num:=0;
        UPDATE `` SET id=@num:=(@num+1);
        ALTER TABLE `` AUTO_INCREMENT =1;
 -->