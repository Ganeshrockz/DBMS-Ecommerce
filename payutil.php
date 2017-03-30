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
   $book=$_SESSION["bookname"];
    $price=$_SESSION["bookquantity"];
if(isset($_POST['buy']))
{
    $user=$_POST['name'];
    $add=$_POST['address'];
    $city=$_POST['city'];
    $state=$_POST['state'];
    $zip=$_POST['zip'];
    $sql1="SELECT * from customer where username like $user";
    $que1=mysqli_query($con,$sql1);
    $rec=mysqli_fetch_assoc($que1);
    $email=$rec['emailid'];
   $sql="INSERT INTO ordertab (book11,price,name,address,city,state,zip) VALUES ('$book',$price,'$user','$add','$city','$state','$zip')";
    $que=mysqli_query($con,$sql);
    if(!$que)
    {
        echo "error";
    }
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
    $mail->Subject="Payment Successful";
    $mail->Body="Your Payment is Successful and your book is $book";
    $mail->AddAddress($email);
    if(!$mail->Send())
        echo "Error".$mail->ErrorInfo;
    $sql2="SELECT * FROM ordertab where orderid=(select max(orderid) from ordertab)";
    $query=mysqli_query($con,$sql2);
    $reco=mysqli_fetch_assoc($query);
    $od=$reco['orderid'];
    $sql4="SELECT DATEADD(day,10,date1) from ordertab where orderid=$od";
    $query2=mysqli_query($con,$sql4);
    $rr=mysqli_fetch_assoc($query2);
    $dd=$rr['DATEADD(day,10,date1)'];
    $sql3="UPDATE shipment set date1=$rr where orderid=$od";
    $query1=mysqli_query($con,$sql3);
}
header("Location: dashboard.php");
?>