<?php
$con=mysqli_connect('127.0.0.1','root','');
if(!$con)
{
echo  "Not connected to server";
}
if(!mysqli_select_db($con,'ecommerce'))
{
    echo "Not connected to db";
}
session_start();
$isbn=$_GET['isbn'];
$sql="SELECT * FROM book WHERE isbn=$isbn";
 $rec=mysqli_query($con,$sql);
$rec1=mysqli_fetch_assoc($rec);
$name=$rec1['name'];
$author=$rec1['author'];
$price=$rec1['price'];
$dis=$rec1['discount'];
$stock=$rec1['stock'];
$pic=$rec1['picture'];
$rating=$rec1['rating'];
$des=$rec1['description'];
$p=$price;
$q=($p-$p*$dis/100);
if(isset($_POST['cart1']))
{
    $uname=$_SESSION["currentuser"];
    $sqlque="SELECT * FROM cart where username='$uname'";
    $rec=mysqli_query($con,$sqlque);
    $getval=mysqli_fetch_assoc($rec);
    $cartid='';
    if(mysqli_num_rows($rec)>0)
    {
            $id=$getval['cartid'];
    $_SESSION["usercartid"]=$id;
        $q=($p-$p*$dis/100);
        $sqlque="INSERT INTO cart(cartid,quantity,price,username,isbn) VALUES($id,1,$q,'$uname',$isbn)";
        $query=mysqli_query($con,$sqlque);
    }
    else{
        $cartid1='';
    while(true)
    {
            $cartid1=(rand()%10000)+80000000;
    $sql="SELECT * FROM cart where cartid=$cartid1";
    $rec=mysqli_query($con,$sql);
    if(!$rec)
    {
        echo "Error During Select";
    }
    if(mysqli_num_rows($rec)>0)
    {
         continue;
    }
    else
    break;
    }
    $q1=($p-$p*$dis/100);  
    $sql2="INSERT INTO cart(cartid,quantity,price,username,isbn) values('$cartid1','1','$q1','$uname','$isbn')";
    $rec2=mysqli_query($con,$sql2);
        if(!$rec2)
    {
        echo "Error During Insert";
    }
}
}
if(isset($_POST['buy']))
{
    $_SESSION['bookname']=$name;
    $_SESSION['bookquantity']=$q;
    header("Location: http://localhost/example/Ecommerce/pay.php");
}
?>
<!DOCTYPE HTML>
<html>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <head>
    <title>Dashboard | Book Display</title>
    </head>
    <style>
    body{
    transition: background-color 0.5s;
}
    .sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #111;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
    font-family: Palatino Linotype;
}

.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display: block;
    transition: 0.3s
}
.sidenav a:hover, .offcanvas a:focus{
    color: #f1f1f1;
}

    .topnav{
    background-color: #333;
    overflow: hidden;
    font-family: Palatino Linotype;
    }
    .topnav a {
    float: left;
    display: block;
        color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
}
.dropdown .drpbutton{
    float: right;
    display: block;
    border: none;
    outline: none;
        color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    background-color: inherit;
    font-size: 17px;
}
.drpbutton:hover{
    background-color: #ddd;
    color: black;
}

.dropcontent{
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 150px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 2;
}
.dropcontent a{
    float: none;
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
    font-size: 15px;
}
.topnav a:hover {
    background-color: #ddd;
    color: black;
}
.dropdown {
    float: right;
    overflow: hidden;
}

.dropdown:hover .dropcontent{
display: block;
}
.topnav a.active {
    background-color: #4CAF50;
    color: white;
}
#main {
    transition: margin-left .5s;
    padding: 16px;
}

.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
    </style>
    <body>
<div class="topnav" id="myTopnav">
    <a href="http://localhost/example/Ecommerce/dashboard.php">Home</a>
  <a href="http://localhost/example/Ecommerce/book.php">Books</a>
  <a href="http://localhost/example/Ecommerce/cart.php">Cart</a>
  <a href="http://localhost/example/Ecommerce/orders.php">MyOrders</a>
  <div class="dropdown">
<button class="drpbutton" style="font-family: Palatino Linotype;">Hi <?php echo "<strong>".$_SESSION["currentuser"]."</strong>!!!"?></button>
    <a href="http://localhost/example/Ecommerce/initial.php">Logout</a>
</div>
</div>
<br>
<div class="well">
<center>
<div class="font-awesome">
<label><strong><font color="blue"> ISBN :</font></strong></label>
<label><?php echo $isbn ?></label><br>
<label><strong><font color="blue"> Title :</font></strong></label>
<label><?php echo $name ?></label><br>
<label><strong><font color="blue"> Author :</font></strong></label>
<label><?php echo $author ?></label><br>
<label><strong><font color="blue"> Rate :</font></strong></label>
<label><?php echo $price ?></label><br>
<label><strong><font color="blue"> Discount :</font></strong></label>
<label><?php echo $dis ?></label><br>
<label><strong><font color="blue"> Stock :</font></strong></label>
<label><?php echo $stock ?></label><br>
<label><strong><font color="blue"> Rating :</font></strong></label>
<label><?php echo $rating ?></label><br>
<label><strong><font color="blue"> Description :</font></strong></label>
<label><?php echo $des?></label><br>
</div>
</div>
<div class="well">
<center>
<?php $val2="http://localhost/example/Ecommerce/review.php?isbn=".$isbn ?>
<a href='<?php echo $val2 ?>'>Click to write Review</a>
<br>
<?php $val3="http://localhost/example/Ecommerce/readreview.php?isbn=".$isbn ?>
<a href='<?php echo $val3 ?>'>Click to read Reviews</a>
</div>
<br>
</center>

<?php
echo '<center><img src="'.$pic.'" alt=\'img\'></center>'
?>
<br>
<?php
$newval=$_GET['isbn'];
$val='http://localhost/example/Ecommerce/BOOKS/dispbook.php?isbn='.$newval;
?>
<form method='POST' action='<?php echo $val ?>' role='form'>
<div class="form-group">
<button type='submit' id='cart'class="btn btn-success form-control" name='cart1'>ADD TO CART</button>
<button type='submit' id='buy' class="btn btn-danger form-control" name='buy'>BUY</button>
</div>
</form>
</body>
</html>