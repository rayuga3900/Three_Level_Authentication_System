<?php 

session_start();

require('conn.php');

?>
<html>
<link rel="stylesheet" type="text/css" href="./css/forgotpswdpage.css">
<script>
var k=document.getElementById('un');
k.addEventListener('keypress',function(event) { 
                                                if(event.key=='Enter') 
                                                {
                                                 event.preventDefault();
                                                 document.getElementById('autosubmit').click;
                                                }
                                              }
                   );  
</script>
</head>
<body>
<form id='myfrom'action=""method='post'>
Username:<input type="text" id='un' name='un' ><br>
Security Question:<input type='text' name='ques' id='ques' readonly> 
<br>

Answer:<input type="text" name='ans'><br>
<br>
<button name='save'value='1'>save</button>
<button name='autosubmit' id='autosubmit' style='display:none;'>autosubmit</button>
</body>


</html>
<?php

  if(isset($_POST['save'])&&$_POST['un']==null)
{
    echo "<label id='l1'>please provide username</label>";
}



if(isset($_POST['un'])&&$_POST['un']!='')
{$un=$_POST['un'];
echo "<script>document.getElementById('un').value='$un'</script>";
$res=mysqli_query($con,"SELECT * FROM user_details1 where username='$un'") or die("<br>query unsuccessful for select");
      if(mysqli_num_rows($res)>0)
  {
    while($row=mysqli_fetch_assoc($res))
   {
   $q=$row['ques'];
if(isset($_POST['save'])&&$_POST['save']!=''&&$_POST['ans']==""&&isset($_POST['un'])
&&$_POST['un']!=""&&$_POST['ques']!=''&&isset($_POST['ques']))
{
    echo "<label id='l1'>please provide answer</label>";
}
echo "<Script>

/*to get question automatically when user presses enter key after writing username
var i=document.getElementById('un');
i.addEventListener('keypress',function(event) { 
                                                if(event.key=='Enter') 
                                                {
                                                 event.preventDefault();
  document.getElementById('autosubmit').click;*/
                                                 document.getElementById('ques').value='$q';
                                               /* }
                                              }
                   );  */

</script>";

   }
  }
else
{
echo "<label id='l1'>username not found</label>";

}
}
   



if(isset($_POST['ans'])&&isset($_POST['un'])
&&isset($_POST['save'])&&$_POST['ans']!=''&&$_POST['un']!='')
{ 
  
    $ans=md5(mysqli_real_escape_string($con,$_POST['ans']));
    $un=mysqli_real_escape_string($con,$_POST['un']);
  
$res=mysqli_query($con,"SELECT * FROM user_details1 where username='$un'") or die("<br>query unsuccessful for select");
if(mysqli_num_rows($res)>0)
{
    while($row=mysqli_fetch_assoc($res))
{
   $correctans=$row['ans'];
   if($ans==$correctans)
  {
$_SESSION['un1']=$un;
//echo "<Script>alert('correct');</script>";
//here write redirection code
echo "<Script>window.location.href='forgot_pswd_register.php'</script>";  
}
else{
    echo "<label id='l1'> Wrong answer</label>";
}
}
}

}
   
mysqli_close($con);

?>
