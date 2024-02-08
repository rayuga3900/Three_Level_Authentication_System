
<html>
<head><meta name="viewport"content="width=device-width,initial-scale=1"/>
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
<form action=''method='post'>

<button id='red' value='#ff0000' onclick='re(this.value)'>

</button>

<button id='blue'value='#0000ff' onclick="re(this.value)">
</button>

<button id='green' value='#00ff00' onclick='re(this.value)'>
</button>
<b>pattern</b>
<input type="password" id='num' value='' size=50 name='col' multiple readonly>
<button name='save'id='save'>save</button>
<button name='reset'id='reset'>reset</button>
<label id='l1'></label>
</form>
</body>

</html>
<?php
  session_start();
 require('conn.php');

if(isset($_SESSION['un']))
{

$un=$_SESSION['un'];

}
else if(isset($_SESSION['un1']))
{
$un=$_SESSION['un1'];
}
else
{
echo "not set sesssion";
 echo '<script>window.location.href="index.html";</script>';
}
if(isset($_POST['save'])&&$_POST['col']=='')
{
    
echo "<label id='l1'>please select color combination</label>";
}

if(isset($_POST['save'])&&isset($_POST['col'])&&$_POST['col']!='')
 { 
    $col=md5($_POST['col']);
 


mysqli_query($con,"update user_details1 set color_pswd='$col' where username='$un'") or die("<br>query unsuccessful for insert");
if(isset($_POST['save'])&&isset($col))
{ 
 
         echo "<script>window.location.href='img_authenticate.php'</script>";
}
 mysqli_close($con);
}

?>

