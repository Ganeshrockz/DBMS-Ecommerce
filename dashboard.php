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
    <link rel="stylesheet">
    <head>
    <title>Dashboard | Ecommerce</title>
    </head>
    <style>
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
    z-index: 1;
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
    </style>
    <body>
<div class="topnav" id="myTopnav">
  <a href="#home">Home</a>
  <a href="#news">News</a>
  <a href="#contact">Contact</a>
  <a href="#about">About</a>
  <div class="dropdown">
<button class="drpbutton" style="font-family: Palatino Linotype;">Hi <?php echo "<strong>".$_SESSION["currentuser"]."</strong>"?></button>
<div class="dropcontent">
    <a href="#">Account</a>
    <a href='#'>Cart</a>
    <a href='#'>Reviews</a>
    <a href="initial.php">Logout</a>
    </div>
</div>
</div>
</body>
</html>
