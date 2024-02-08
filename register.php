<html>
<head><meta name="viewport"content="width=device-width,initial-scale=1"/>
<style>
body
{
background-image:url('./croppedimages/wallpaperflare.com_wallpaper.jpg');
background-repeat:no-repeat;
background-size: cover; /* Added to cover the entire page */
    margin: 0;
}
form
{
padding:20px;
border:2px double red;
display:flex;
flex-direction:column;
align-content:center;
text-align:center;
position:fixed;
top:100px;
left:500px;
height:400px;
width:210px;
background:white;
}
#l1
{
position:fixed;
top:470px;
left:530px;
width:200px;
font-size:20px;
}
div
{
position:fixed;
top:350px;
left:500px;

}
button
{
font-size:20px;
border-radius:10px;
background:blue;
color:white;
}
button:hover
{
 
background:linear-gradient(90deg,black,#2196f3);
}

@media only screen and (max-width: 600px) {
            /* Adjustments for mobile devices */
body
{
background-image:url('./croppedimages/wallpaperflare.com_wallpaper.jpg');
background-repeat:no-repeat;
}
form
{
padding:20px;
border:2px double red;
display:flex;
flex-direction:column;
align-content:center;
text-align:center;
position:fixed;
top:100px;
left:25px;
height:480px;
width:200px;
background:white;
}
#l1
{
position:fixed;
top:510px;
left:30px;
width:250px;
font-size:20px;
}
div
{
position:fixed;
top:350px;
left:500px;

}
button
{
font-size:20px;
border-radius:10px;
background:blue;
color:white;
}
button:hover
{
 
background:linear-gradient(90deg,black,#2196f3);
}


}
</style>
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
Username:<input type="text" name='un'value="<?php if(isset($_POST['un'])) echo$_POST['un'];?>"><br>
password:<input type='password' name='psw'id='equi'autocomplete=off> 
<br>
confirm password:<input type='password' name='cpsw'id='equi'><br>
In case you forget your password<br>
Security Questions:
<select name='ques'>
<option value='whats your favourite color?'>whats your favourite color?</option>
<option value='whats the name of the city where you where born?'>whats the name of the city where you where born?</option>
<option value='whats the name of the first school you attended?'>whats the name of the first school you attended?</option>
</select><br>
Answer:
<input type='text'name='ans'><br>
<button name='save'>save</button>
<label id='l1'></label>
</form>
<div>
<?php
session_start();
require('conn.php');
if(isset($_POST['save'])&&$_POST['psw']==""&&$_POST['un']!="")
{
    echo "<label id='l1'>please provide password</label>";
}


if(isset($_POST['save']) && isset($_POST['psw']) && strlen($_POST['psw']) < 6 && $_POST['psw'] != ''&&$_POST['cpsw']!=''&&isset($_POST['cpsw'])) {
        echo "<label id='l1'>Password should have a minimum length of 6 characters</label>";
    }
  if(isset($_POST['save'])&&$_POST['un']==null)
{
    echo "<label id='l1'>please provide username</label>";
}
  if(isset($_POST['save'])&&isset($_POST['psw'])&&isset($_POST['cpsw'])
&&$_POST['psw']!=$_POST['cpsw']&&$_POST['psw']!=''&& strlen($_POST['psw']) > 6 )
{
    echo "<label id='l1'>password didn't match</label>";
}
if(isset($_POST['psw'])&&strlen($_POST['psw'])>=6&&$_POST['psw']==$_POST['cpsw']&&isset($_POST['cpsw'])&&isset($_POST['un'])
&&isset($_POST['ans'])&&$_POST['ans']!=''&&isset($_POST['save'])&&$_POST['psw']!=null&&
$_POST['cpsw']!=''&&$_POST['un']!=''&&isset($_POST['ques'])&&$_POST['ques']!='')
 { 
   
      

  
  /*$psw=$_POST['psw'];
  $cpsw=$_POST['cpsw'];
  $un=$_POST['un'];*/
 $psw=md5(mysqli_real_escape_string($con,$_POST['psw']));

    $cpsw=md5(mysqli_real_escape_string($con,$_POST['cpsw']));
    $un=mysqli_real_escape_string($con,$_POST['un']);
   $ques=mysqli_real_escape_string($con,$_POST['ques']);
$ans=md5(mysqli_real_escape_string($con,$_POST['ans']));
$res=mysqli_query($con,"SELECT * FROM user_details1 where username='$un'") or die("<br>query unsuccessful for select");

if(mysqli_num_rows($res)>0)
{    echo "<label id='l1'>username already taken</label>";
exit();
         }

else{
 mysqli_query($con,"INSERT INTO user_details1 (username,password,color_pswd,img_pswd,timestamp,ques,ans)VALUES ('$un','$psw',NULL,NULL,NULL,'$ques','$ans')") or die("<br>query unsuccessful for insert");
}
   




mysqli_close($con);

if(isset($_POST['save'])&&isset($psw)&&isset($cpsw)&&isset($un)
&&$psw==$cpsw&&!empty($psw)&&!empty($cpsw))
{
 $_SESSION['un']=$un;
$_SESSION['psw']=$psw;
header("location:color_password.php");
}}
?>
</div>

</body>
</html>









<?php
/*
$con=mysqli_connect("localhost","root","","project");
if(!$con)
{
die('could not connect'.mysql_error());
}
echo "connected successfully <br>";

//for showing default databases
$res=mysqli_query($con,"SELECT DATABASE()");
$row=mysqli_fetch_row($res);
printf("default database:".$row[0]);

//for showing different databases which current user can access
$set=mysqli_query($con,"SHOW DATABASES;");
$m=array();
while($db=mysqli_fetch_row($set))
{
$m[]=$db[0];
}
echo implode("<br>",$m);

//for displaying information entered by user
$res=mysqli_query($con,"SELECT * FROM user_details") or die("<br>query unsuccessful");
if(mysqli_num_rows($res)>0)
{
while($row=mysqli_fetch_assoc($res)){
echo "<br>username:".$row['username']."<br>";
echo $row['password'];
}

mysqli_close($con);


//$request variable used

if($_SERVER['REQUEST_METHOD']=='POST')
{
$name=htmlspecialchars($_REQUEST['un']);
if(empty($name))
{
    echo 'name is empty';
}
else
{
 echo "name:".$name;
}}*/
?>