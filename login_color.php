<?php
session_start();
require('conn.php');
//header('content-type:image/jpeg');
//ini_set('memory_limit','300M');
?>

<html>
<head><meta name="viewport"content="width=device-width,initial-scale=1,maximum-scale=1"/>
<link rel="stylesheet" type="text/css" href="./css/colorpage.css">

<script>

function re(val)
{
event.preventDefault();//if you remove this the value will disappear automatically
   document.getElementById("num").value=num.value+val;

}
</script>
</head>
<body>
<form action=""method='post'enctype='multipart/form-data' autocomplete='off'>
<header>log in</header>
<!--for color -->
<button id='red' value='#ff0000' onclick='re(this.value)'>

</button>

<button id='blue'value='#0000ff' onclick="re(this.value)">
</button>

<button id='green' value='#00ff00' onclick='re(this.value)'>
</button>
<b>pattern</b>
<button id='save'value=1 name='save'>remember me</button>
<button id='reset'onclick="document.getElementById('num').value='';">reset</button>
<input type="password" id='num' value=''  size=60 name='col'
value="<?php if(isset($_POST['col'])&&$_POST['col']!='') echo $_POST['col'];?>"
multiple readonly>
</form></body></html>
<?php
if(isset($_SESSION['unlog']))//username from login
{

$un=$_SESSION['unlog'];
}
else {
   
echo "not set session";
 echo '<script>window.location.href="index.html";</script>';
}
if(isset($_POST['col'])&&$_POST['col']==''&&isset($_POST['save'])&&$_POST['save']!='')
{
echo "<label id='l1'>please select color combination</label>";
}
if(isset($_POST['col'])&&$_POST['col']!=''&&isset($_POST['save']))
 {  
$col=$_POST['col'];


   
  // $un=mysqli_real_escape_string($con,$_POST['un']);
    //  $psw=mysqli_real_escape_string($con,$_POST['psw']);
   /*   $img=$_FILES['img']['name'];    
      $col=$_POST['col'];
 */

$res=mysqli_query($con,"select * from user_details1 where username='$un'");// or die("user not found");

if(mysqli_num_rows($res)>0)
{  
   while($row=mysqli_fetch_assoc($res))
  {  
      
   //   echo dirname(__FILE__); //storage/ssd2/093/20690093/public_html
    $v=dirname(__FILE__); 
//$im1=file_get_contents($_FILES['img']['tmp_name']);//current image selected by user
/*$c=$row['color_pswd'];
$i=$row['img_pswd'];
$p=$row['password'];*/
//echo $row['color_pswd'],$row['img_pswd'],$row['password'];

   //  $im2=file_get_contents($v.'/images/'.$row['img_pswd']);//stored image 
//echo $im2;
//echo $im1;

    if(md5($col)==$row['color_pswd'])//&&md5($col)==$row['color_pswd']&&$im1==$im2
    { 
        
echo "<script>  setTimeout( function () {window.location.href='login_img.php'; },500);</script>
 ";   
      
       // echo "<script>window.location.href='login_img.php'</script>";
    }
   
   else
    {
      echo "<label id='l1'>invalid credentials</label>";
     }
  }  //while
}
  
mysqli_close($con);
}
?>