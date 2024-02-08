<?php

session_start();


//$timestamp=0;
require('conn.php');

?>
<html>
<head>

<link rel="stylesheet" type="text/css" href="./css/login_img.css">
</head>
<script>
function re(val)
{

event.preventDefault();//if you remove this the value will disappear automatically
   document.getElementById("num").value=num.value+val;

}


</script>
<body>
<form method='post'enctype='multipart/form-data'>

<header>log in</header>
<input type='password' name='num'id='num'readonly size=20>
<button name='save' id='save'value=1>save</button>
<button type='button'name='reset' id='reset'value=1 onclick=' document.getElementById("num").value=null' >reset</button>

</form>
    
</body>
</html>
<?php



if(isset($_SESSION['unlog']))//username from login
{

$un=$_SESSION['unlog'];

}
else  {
   
echo "not set sesssion";
    echo '<script>window.location.href="index.html";</script>';
}
$i=array(0,1,2,3,4,5,6,7,8);
//"$baseDirectory/$username[0-9]_*.jpg");

 $timestamp=null;

    $res=mysqli_query($con,"select * from user_details1 where username='$un'"); //or die("user not found");
      
if(mysqli_num_rows($res)>0)
{ 
   while($row=mysqli_fetch_assoc($res))
  {  

$timestamp=$row['timestamp']; 
  }}

 //echo "<script>alert('$timestamp');</script>";
//echo "<br> image name: " . $un . $i[0] .$timestamp . ".jpg";//this is how image is stored here ex username with any digits between [0-9] and timestamp.jpg

echo "
    <div id='d1'><img src='./croppedimages/$un$i[0]$timestamp.jpg'onclick='re(0)'></div>
          
    <div id='d2'><img src='./croppedimages/$un$i[1]$timestamp.jpg'onclick='re(1)'></div>

    <div id='d3'><img src='./croppedimages/$un$i[2]$timestamp.jpg'onclick='re(2)'></div>
     <div id='d4'><img src='./croppedimages/$un$i[3]$timestamp.jpg'onclick='re(3)'> </div>
     <div id='d5'><img src='./croppedimages/$un$i[4]$timestamp.jpg'onclick='re(4)'></div>
     <div id='d6'><img src='./croppedimages/$un$i[5]$timestamp.jpg'onclick='re(5)'></div>
    <div id='d7'><img src='./croppedimages/$un$i[6]$timestamp.jpg'onclick='re(6)'></div>
     <div id='d8'><img src='./croppedimages/$un$i[7]$timestamp.jpg'onclick='re(7)'></div>
     <div id='d9'><img src='./croppedimages/$un$i[8]$timestamp.jpg'onclick='re(8)'></div>

";

if(isset($un))echo './croppedimages/'.$un.'0.jpg';

    if(isset($_POST['num'])&&$_POST['num']!='')
    {
       // echo "<script>alert('$ipsw');</script>";
    }
   
if(isset($_POST['num'])&&$_POST['num']!=''&&isset($_POST['save']))
{
$ipsw=md5($_POST['num']);

//mysqli_query($con,"update user_details1 set img_pswd='$ipsw'  where username='$un'") or die("<br>query unsuccessful for insert");

$res=mysqli_query($con,"select * from user_details1 where username='$un'");// or die("user not found");
 
// echo "<script>alert(<br>data: '$data');</script>";
if(mysqli_num_rows($res)>0)
{  
   while($row=mysqli_fetch_assoc($res))
  {  
    

    if($ipsw==$row['img_pswd'])//&&md5($col)==$row['color_pswd']&&$im1==$im2
    { 
        
          
echo "<script>    
     
   window.location.href='success_msg.php';</script>
 ";   
      
        //ho'</script> event.preventDefault()window.location="success_msg.html"</script>';
    }
   
   else
    {
      echo "<label id='l1'>invalid credentials</label>";
     }
  }  //while
}
  else
    {
     echo "<label id='l1'>username not found</label>";
    }
echo "<br> timestamp".$timestamp;
 mysqli_close($con);

}

/*if(isset($_POST['save'])&&isset($_POST['num'])&&$_POST['num']!='')//&&isset($_SESSION['un']))
{ 
 echo '<script>alert("working");</script>';
    //echo "<script> alert('registered successfully');   </script>";
 echo '<script>window.location.href="reg_success.php";</script>';

}
*/






?>