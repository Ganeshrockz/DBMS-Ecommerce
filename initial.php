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
$_SESSION["currentuser"]=" ";
if(isset($_POST['ssubmit']))
{
    $usname=$_POST['susername'];
    $pass=$_POST['spassword'];
    $fname=$_POST['sfirstname'];
    $lname=$_POST['slastname'];
    $gen=$_POST['sgender'];
    $dob=$_POST['sdateofbirth'];
    $add=$_POST['saddress'];
    $city=$_POST['scity'];
    $state=$_POST['sstate'];
    $zip=$_POST['szipcode'];
    $phone=$_POST['sphonenumber'];
    $email=$_POST['semailid'];
    $que1="SELECT * FROM customer where username='$usname'";
    $rec=mysqli_query($con,$que1);
    if(!$rec)
    {
        echo "Error";
    }
    else if(mysqli_num_rows($rec)>0)
    {
        $msg="Username Already Exists....Choose a different one";
        echo "<script type='text/javascript'>alert('$msg');</script>";
        mysqli_free_result($rec);
    }
    else
    {
    $query="INSERT INTO customer VALUES('$usname','$pass','$fname','$lname','$gen','$dob','$add','$city','$state','$zip','$phone','$email')";
    $record=mysqli_query($con,$query);
    if(!$record)
    {
        echo "Error";
        echo "here";
    }

    else
    {
        require_once("C:\php\PHPMailer-PHPMailer-adb0197\class.phpmailer.php");
    $mail=new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPDebug=1;
    $mail->SMTPAuth=true;
    $mail->SMTPSecure='ssl';
    $mail->Host="smtp.gmail.com";
    $mail->Port=465;
    $mail->isHTML(true);
    $mail->Username="ganesh890370@gmail.com";
    $mail->Password="9486428529";
    $mail->SetFrom("ganesh890370@gmail.com");
    $mail->Subject="TestMail";
    $mail->Body="Hi you have registered";
    $mail->AddAddress($email);
    if(!$mail->Send())
        echo "Error".$mail->ErrorInfo;
    $msg1="Successfully Registered";
    echo "<script type='text/javascript'>alert('$msg1');</script>";
    header("refresh=1;Location: initial.php");
    }
    }
}
else if(isset($_POST['submit']))
{

    $name=$_POST['uname'];
    $pass=$_POST['psw'];
$sql="SELECT * FROM customer WHERE username LIKE '$name' AND password='$pass'";
$rec=mysqli_query($con,$sql);
if(mysqli_num_rows($rec)<=0 || !$rec)
{
  
  $message = "Invalid username or password";
  echo "<script type='text/javascript'>alert('$message');</script>";
  mysqli_free_result($rec);
 header("refresh=1;Location: initial.php");
}
else
{
    $_SESSION["currentuser"]=$_POST['uname'];
    header("Location: dashboard.php");
}
}
?>
<!DOCTYPE html>
<html>
<style>
/* Full-width input fields */
input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

/* Set a style for all buttons */
button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

/* Extra styles for the cancel button */
.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}
.cancelbtn1 {
    width: auto;
    padding: 14px 20px;
    background-color: #f44336;
}
/* Center the image and position the close button */
.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
    position: relative;
}

img.avatar {
    width: 20%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    width: 50%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
    position: absolute;
    right: 25px;
    top: 0;
    color: #000;
    font-size: 35px;
    font-weight: bold;
}
.cancelbtn1,.signupbtn {
    float: left;
    width: 50%;
}
.close:hover,
.close:focus {
    color: red;
    cursor: pointer;
}
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}
/* Add Zoom Animation */
.animate {
    -webkit-animation: animatezoom 1s;
    animation: animatezoom 1s
}

@-webkit-keyframes animatezoom {
    from {-webkit-transform: scale(0)} 
    to {-webkit-transform: scale(1)}
}
    
@keyframes animatezoom {
    from {transform: scale(0)} 
    to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
</style>
<body>
<div class='bor'>
<center>
<h2>Ecommerce</h2>
</center>
<center>
<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>
<button onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Sign Up</button>
</center>
</div>
<div id="id01" class="modal">
  
  <form class="modal-content animate" action="initial.php" method="post">
    <div class="imgcontainer">
     <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="loginimage.jpg" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <label><b>Username</b></label>
      <input type="text" placeholder="Enter UserName" name="uname" required>

      <label><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>
        
      <button type="submit" id="submit" name="submit">Login</button>
      <input type="checkbox" checked="checked"> Remember me
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw"><a href="#">Forgot password?</a></span>
    </div>
  </form>
</div>
<div id="id02" class="modal">
  <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
  <form class="modal-content animate" action="initial.php" method="post">
    <div class="container">
      <label><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="susername" required>
      <label><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="spassword" required>
            <label><b>FirstName</b></label>
      <input type="text" placeholder="Enter FirstName" name="sfirstname" required>
            <label><b>Lastname</b></label>
      <input type="text" placeholder="Enter Lastname" name="slastname" required>
            <label><b>Gender</b></label>
      <input type="text" placeholder="Enter Gender" name="sgender" required>
            <label><b>Date of Birth</b></label><br>
      <input type="date" placeholder="Enter DOB" name="sdateofbirth" required><br>
            <label><b>Address</b></label>
      <input type="text" placeholder="Enter Address" name="saddress" required>
            <label><b>City</b></label>
      <input type="text" placeholder="Enter City" name="scity" required>
            <label><b>State</b></label>
      <input type="text" placeholder="Enter State" name="sstate" required>
            <label><b>Zip</b></label><br>
      <input type="number" placeholder="Enter ZipCode" name="szipcode" required><br>
            <label><b>PhoneNumber</b></label><br>
      <input type="number" placeholder="Enter Phonenumber" name="sphonenumber" required><br>
            <label><b>Email-Id</b></label>
      <input type="text" placeholder="Enter EmailId" name="semailid" required>
      <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn1">Cancel</button>
        <button type="submit" name="ssubmit" id="ssubmit" class="signupbtn">Sign Up</button>
      </div>
    </div>
  </form>
</div>

<script>
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
var modal1 = document.getElementById('id02');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal1) {
        modal1.style.display = "none";
    }
}
</script>

</body>
</html>
