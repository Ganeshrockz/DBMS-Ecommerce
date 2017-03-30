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
?>
<!DOCTYPE HTML>
<html>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <head>
    <title>Read Reviews | Ecommerce</title>
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
    <a href="dashboard.php">Home</a>
  <a href="book.php">Books</a>
  <a href="cart.php">Cart</a>
  <a href="orders.php">MyOrders</a>
  <div class="dropdown">
<button class="drpbutton" style="font-family: Palatino Linotype;">Hi <?php echo "<strong>".$_SESSION["currentuser"]."</strong>!!!"?></button>
    <a href="initial.php">Logout</a>
</div>
</div>
<?php
$sql="SELECT * FROM book where isbn=$isbn";
$que=mysqli_query($con,$sql);
$res=mysqli_fetch_assoc($que);
echo "<div class=\"well\"><strong><center><h1>".$res['name']."</h1></strong>";
echo "<h5>Written By</h5>";
echo "<h3>".$res['author']."</h5></center></div>";
$us=$_SESSION["currentuser"];
$sql="SELECT * FROM review where username='$us' and isbn=$isbn";
$rec=mysqli_query($con,$sql);
$count=0;
if(mysqli_num_rows($rec)>0)
{
while($rec1=mysqli_fetch_assoc($rec))
{
    $count++;
    echo "<div class=\"well\"><strong>Review".$count."</strong>";
    echo "<br>";
    echo "Written By<strong> ".$rec1['username']."</strong>";
    echo "<br>";
    echo "<br>";
    echo "On <strong> ".$rec1['date1']."</strong>";
    echo "<br>";
    echo "<br>";
    echo "<h3>".$rec1['reviews']."</h3></div>";
    echo "<hr>";
}
}
else {
    echo "<h1><center><font color=\"red\">NO REVIEWS YET</font></center></h1>";
}
?>
</form>
</body>
</html>