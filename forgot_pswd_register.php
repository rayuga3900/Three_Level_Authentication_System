<?php
session_start();
require('conn.php');
if(isset($_SESSION))

{
       
   
     if(isset($_SESSION['unlog']))
          
    {
                
	   $un=$_SESSION['unlog'];
           
    }
    
else if(isset($_SESSION['un1']))
{
 $un=$_SESSION['un1'];
  
}
   else
       
 {
        
echo '<script>window.location.href="index.html";</script>';

        }

}
 
?>

<html>
<head><link rel="stylesheet" type="text/css" href="./css/forgotpswdpage.css">
<script>
function redir()
{
event.preventDefault();
window.location="color_password.php";
}

</script>
</head>
<body>
<form action=""method='post'>
Username:<input type="text" name='un'value="<?php if(isset($un)) echo$un;?>" readonly><br>
password:<input type='password' name='psw'id='equi'autocomplete=off> 
<br>
confirm password:<input type='password' name='cpsw'id='equi'><br>
<button name='save'>save</button>

</body>

</html>
<?php

if(isset($_POST['save'])&&$_POST['psw']==""&&$_POST['un']!="")
{
    echo "<label id='l1'>please provide password</label>";
}
 if(isset($_POST['save'])&&isset($_POST['psw'])&&isset($_POST['cpsw'])
&&$_POST['psw']!=$_POST['cpsw']&&$_POST['psw']!='')
{
    echo "<label id='l1'>password didn't match</label>";
}

if(isset($_POST['save']) && isset($_POST['psw']) && strlen($_POST['psw']) < 6 && $_POST['psw'] != ''&&$_POST['cpsw']!=''&&isset($_POST['cpsw'])) {
        echo "<label id='l1'>Password should have a minimum length of 6 characters</label>";
    }
if(isset($_POST['psw'])&&strlen($_POST['psw'])>=6&&isset($_POST['cpsw'])&&isset($_POST['un'])
&&isset($_POST['save'])&&$_POST['psw']!=null&&$_POST['cpsw']!=''
&&$_POST['un']!=''&&$_POST['psw']==$_POST['cpsw'])
 { 
   
   

  /*$psw=$_POST['psw'];
  $cpsw=$_POST['cpsw'];
  $un=$_POST['un'];*/
 $psw=md5(mysqli_real_escape_string($con,$_POST['psw']));

    $cpsw=md5(mysqli_real_escape_string($con,$_POST['cpsw']));
    $un=mysqli_real_escape_string($con,$_POST['un']);
 
$res=mysqli_query($con,"SELECT * FROM user_details1 where username='$un'") or die("<br>query unsuccessful for select");

mysqli_query($con,"update user_details1 set password=NULL ,color_pswd=NULL ,img_pswd=NULL where username='$un'") or die("<br>query unsuccessful for insert");

mysqli_query($con,"update user_details1 set password='$psw' where username='$un'") or die("<br>query unsuccessful for insert");

echo "<script>window.location.href='color_password.php';</script>";
mysqli_close($con);
}
?>