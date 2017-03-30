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
?>
<!DOCTYPE HTML>
<html>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <head>
    <title>Dashboard | Ecommerce</title>
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
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 70%;
      margin: auto;
  }
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
    </style>
    <body>
       <!-- <div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <strong><a href="#" style="font-size: 24px;">Home</a>
  <a href="#">Products</a>
  <a href="#">Clients</a>
  <a href="#">Contact</a></strong>
</div>-->
<div class="topnav" id="myTopnav">
     
  <!--<a href="javascript:void(0)" onclick="openNav()" >&#9776;</a>-->
    <a href="dashboard.php">Home</a>
  <a href="book.php">Books</a>
  <a href="cart.php">Cart</a>
  <a href="orders.php">MyOrders</a>
  <div class="dropdown">
<button class="drpbutton" style="font-family: Palatino Linotype;">Hi <?php echo "<strong>".$_SESSION["currentuser"]."</strong>!!!"?></button>
    <a href="initial.php">Logout</a>
</div>
</div>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="driven-original-imaema3zj8aggjvg.jpeg" alt="Chania">
    </div>

    <div class="item">
      <img src="playing-it-my-way-my-autobiography-original-imaegh2rsx3dz8ra.jpeg" alt="Chania">
    </div>

    <div class="item">
      <img src="steve-jobs-the-exclusive-biography-original-imaepgmzm7ketuzw.jpeg" alt="Flower">
    </div>

    <div class="item">
      <img src="target-viteee-11-yrs-solved-papers-2006-2016-10-mock-tests-6th-original-imaenar7cf9h2v49.jpeg" alt="Flower">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</body>
</html>