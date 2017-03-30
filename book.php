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
$rec1='';
$flag1=0;
if(isset($_POST['submit']))
{
    $title=$_POST['search'];
    $sql="SELECT * FROM book WHERE name LIKE '%$title%'";
    $rec1=mysqli_query($con,$sql);
    if(mysqli_num_rows($rec1)>0)
    {
             $flag1=1;
    }
    else
    {
        $flag1=0;
    }
}
//$p = $_GET['p'];
//$_SESSION['category'] = $p;
//include("dispbook$p.php");
?>
<!DOCTYPE HTML>
<html>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <head>
    <title>Books | Ecommerce</title>
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
input[type=text] {
    width: 130px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    background-color: white;
    background-position: 10px 10px; 
    background-repeat: no-repeat;
    padding: 12px 20px 12px 40px;
    -webkit-transition: width 0.4s ease-in-out;
    transition: width 0.4s ease-in-out;
}
/* When the input field gets focus, change its width to 100% */
input[type=text]:focus {
    width: 100%;
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
#distable{
    display: none;
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
<form role='form' method='post' action='book.php'>
<input type="text" name="search" placeholder="Search.." required>
<button type="submit" class="btn btn-success" name='submit'>Submit</button>
</form>
<div class="table-responsive">
    <table class="table table-striped">
                <thead>
                    <tr>
                        <th>S.NO</th>
                        <th>ISBN</th>
                        <th>NAME</th>
                        <th>Author</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count=1;
                            if($flag1!=0)
                            {
                            while($rec=mysqli_fetch_assoc($rec1))
                            {
                                
                                echo "<tr>";
                                echo "<td><strong>".$count."</strong></td>";
                                echo "<td><strong>".$rec['isbn']."</strong></td>";
                                $isb=$rec['isbn']; 
                                echo "<td><a href='BOOKS/dispbook.php?isbn=$isb'>".$rec['name']."</a></td>";
                                $_SESSION["currentisbn"]=$isb;
                                echo "<td>".$rec['author']."</td>";
                                      echo "</tr>";
                                    
                                      $count++;
                            }
                            }
                            ?>
                            </tbody>
                            </table>
                            </div>
</body>
</html>