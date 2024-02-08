
<?php
session_start();
require('conn.php');
//header('content-type:image/jpeg');
//ini_set('memory_limit','300M');
?>


<html>
<head><meta name="viewport"content="width=device-width,initial-scale=0.5,maximum-scale=1"/>

<style>
body {
    background-image: url('./croppedimages/wallpaperflare.com_wallpaper.jpg');
    background-repeat: no-repeat;
    background-size: cover;
}

p {
    position: relative;
    top: 310px;
}


b {
    position: relative;
    left: 60px;
    top: 220px;
}

form {
    background: white;
    padding: 20px;
    border: 2px double red;
    display: flex;
    flex-direction: column;
    align-content: center;
    text-align: center;
    position: relative;
    top: 70px;
    left: 300px;
    height: 200px;
    width: 300px;
}

div {
    position: relative;
    top: 350px;
    left: 500px;
}

#save {
    position: relative;
    top: 30px;
    width: 330px;
    left: -15px;
    font-size: 20px;
    border-radius: 10px;
    background: blue;
    color: white;
}

button {
    font-size: 20px;
    border-radius: 10px;
    background: blue;
    color: white;
    position: relative;
    top: 550px;
    width: 300px;
}

#reset {
    font-size: 20px;
    border-radius: 10px;
    background: blue;
    color: white;
    position: relative;
    top: 290px;
    width: 80px;
}

button:hover,
#reset:hover,
#save:hover {
    background: linear-gradient(90deg, black, #2196f3);
}

header {
    color: white;
    position: relative;
    top: 20px;
    left: 300px;
    font-size: 24px;
}
#l1
{
position:fixed;
top:280px;
left:420px;
}
</style>
<script>

function re(val)
{
event.preventDefault();//if you remove this the value will disappear automatically
   document.getElementById("num").value=num.value+val;

}

</script>
</head>

<body>
<header>log in</header>
<form action=""method='post'enctype='multipart/form-data' autocomplete='new-password'>

<!--for username and password-->
Username:<input type="text" name='un'placeholder='enter name'value="<?php if(isset($_POST['un'])) echo$_POST['un'];?>"><br>
password:<input type='password' name='psw'placeholder='enter password'
value="<?php if(isset($_POST['psw'])) echo$_POST['psw'];?>"
autocomplete='new-password' ><br>
<a href ='forgot_password.php'name='forget'>forgot password</a>
<br>
<button id='save'value=1 name='save'>remember me</button>

<label id='l1'></label>

<!--for image  
<p >select an image</p>
<img src='images/img_placeholder.png'id='profiledisplay' onclick='triggerclick()' >


<input type='file'name='img'id='img' style='display:none;'accept='image/jpeg'onchange='displayimage(this)' ">
-->
</form>
</body>
</html>

<?php

if(isset($_POST['forget'])&&$_POST['forget']!='')
{
 echo "<script>alert('working');</script>";
   $_SESSION['unlog']=$un;//username from login
}
if(empty($_POST['un'])&&isset($_POST['save']))
{
echo "<label id='l1'>please enter username</label>";
}

if(isset($_POST['un'])&&$_POST['un']!=''&&$_POST['psw']==''&&isset($_POST['save']))
{
echo "<label id='l1'>please enter password</label>";
}


if(isset($_POST['un'])&&isset($_POST['psw'])&&$_POST['un']!=''
&&$_POST['psw']!=''&&isset($_POST['save']))
 {  
 
   $del=mysqli_query($con,"delete from user_details1 where img_pswd IS NULL"); 
   $un=mysqli_real_escape_string($con,$_POST['un']);
      $psw=mysqli_real_escape_string($con,$_POST['psw']);
   /*   $img=$_FILES['img']['name'];    
      $col=$_POST['col'];
 */

$res=mysqli_query($con,"select * from user_details1 where username='$un'");// or die("user not found");

if(mysqli_num_rows($res)>0)
{  
   while($row=mysqli_fetch_assoc($res))
  {  
      
   // $v=dirname(__FILE__); 


    if(md5($psw)==$row['password'])//&&md5($col)==$row['color_pswd']&&$im1==$im2
    { 
        $_SESSION['unlog']=$un;
 
  

        echo "<script>window.location.href='login_color.php'</script>";
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
mysqli_close($con);
}
?>



<!--/* if($psw!=$row['password']&&$col==$row['color_pswd']&&$im1==$im2)
 {
 echo "<label id='l1'>password didnt match</label>";
}
 if($psw==$row['password']&&$col!=$row['color_pswd']&&$im1==$im2)
 {
 echo "<label id='l1'>color didnt match</label>";
}
 if($psw==$row['password']&&$col==$row['color_pswd']&&$im1!=$im2)
 {
 echo "<label id='l1'>image didnt match</label>";
}*/-->

