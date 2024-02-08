<?php

session_start();
require('conn.php');


?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./css/img_authenticate.css">
<script>
let d=document.getElementById('d1'); 
d.firstChild.src='<?php echo $new1[0];?>';
//$(".read-only").keydown(function(e){ e.preventDefault();
//});

</script>
</head>
<script>

function re(val)
{
event.preventDefault();//if you remove this the value will disappear automatically
   document.getElementById("num").value=num.value+val;

}
function stop()
{
 var k=document.getElementById('num').value;
 if(k=='')
{
alert("please set password");
 return false;
}
}
/*.submit(function() {
return false;
});*/
function triggerclick(e)
{
document.querySelector('#img').click();
}
function displayimage(e)
{

   if(e.files[0]) 
   {
   var reader=new FileReader();
   reader.onload=function(e)
            { 
              document.querySelector('#profiledisplay').setAttribute('src',e.target.result);
             }
         reader.readAsDataURL(e.files[0]);
    }
      

}
</script>
<body>
<form id='myform' method='post'enctype='multipart/form-data'>
<div style='position:relative;
   top:40px;left:120px;height:330px;width:330px;border:2px inset silver;'>
<img src='croppedimages/img_placeholder.png'id='profiledisplay' onclick='triggerclick()' >
</div>
<input type='file'name='img'id='img' style='display:none;'accept='image/jpeg'onchange='displayimage(this)'>
<button name='crop'value=1 id='crop'>crop image</button>
<input type='password' name='num'id='num'readonly size=20>
<button name='save' id='save'value=1 onclick='return stop()'>save</button>
<label id='l1' ></label>
<button type='button'name='reset' id='reset'value=1 onclick=' document.getElementById("num").value=null' >reset</button>
    <div id='d1'></div>
     <div id='d2'></div>
   <div id='d3'></div>
    <div id='d4'></div>
     <div id='d5'></div>
 <div id='d6'></div>
    <div id='d7'></div>
     <div id='d8'></div>
     <div id='d9'></div>
</form>
   
</body>
</html>
<?php

echo 'hello';
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


/*if(isset($_POST['save'])&&$_FILES['img']['size']==0&&$_POST['save']=='')
{ echo 'select';
    echo "<label id='l1'>please select an image</label>";
    
}*/

if(isset($_FILES['img'])&&isset($_POST['crop'])&&$_FILES['img']['size']==0)
{
echo "<label id='l1'>please select an image</label>";
}

if(isset($_FILES['img'])&&isset($_POST['crop'])&&$_FILES['img']['size']!=0) //&&isset($_FILES['img'])&&$_POST['crop']!=''&&$_FILES['img']['size']!=0
{

  $img=$_FILES['img']['name'];
//echo "<script>alert('condition is working');</script>";
/*echo "<script>alert('$img');</script>";
echo 'jello da';
echo 'hello inside conditi0pn';
echo "<script>alert('condition is working');</script>";*/

$temp=$_FILES['img']['tmp_name'];

//echo "<script>alert('$img');</script>";
$baseDirectory = __DIR__;
$target = $baseDirectory . '/useruploadedimages/' . $img;
if(move_uploaded_file($_FILES['img']['tmp_name'],$target))
{
$msg="file uploaded";
$css_class="alert-success";
echo $msg;
}
else
{
$msg= "error uploading files";
$css_class="alert-danger";
echo $msg;
}
//echo $_FILES['img']['tmp_name'];
//echo "<script>alert('$target');</script>";


}
if($_POST['num']==''&&isset($_POST['save']))
{
//echo "<script> document.getElementById('myform').submit(false);</script>";
//echo "<label id='l1'>please select password</label>";
}
global $currtime;
 $currtime=time();
if(isset($_POST['save'])&&isset($_POST['num'])&&$_POST['num']!='')//&&isset($_SESSION['un']))
{ 
$ipsw=md5($_POST['num']);

   
mysqli_query($con,"update user_details1 set img_pswd='$ipsw' where username='$un'") or die("<br>query unsuccessful for insert");





if(isset($_SESSION['un1']))
{
echo '<script>window.location.href=" success_msg.php";</script>';
}
// echo '<script>alert("working");</script>';
    //echo "<script> alert('registered successfully');   </script>";
 echo '<script>window.location.href="success_msg.php";</script>';
 mysqli_close($con);
}



error_reporting(E_ALL);
ini_set('display_errors', '1');
// Set maximum post size to 25 megabytes (including file uploads)
ini_set('post_max_size', '40M');



function splitimg($imgname,$username,$currtime)
{ //$filename='community shadow.jpg';

$baseDirectory= __DIR__;
  $filename= $baseDirectory . '/useruploadedimages/' .$imgname;
echo $filename;
  //$newfilename='a1.jpg';
  $new="./croppedimages/$username";  
   
/*the $new variable in the code represents the base directory 
    where the dynamically cropped images will be stored. It acts as
     a prefix for the filenames of the individual cropped images.
     The loop then appends the loop variable $i to this base
      directory to generate unique filenames for each of the
       9 cropped images ($new1[0], $new1[1], ..., $new1[8]).
        This ensures that each cropped image has a distinct
         filename associated with the user. */
         

   //$new1=array();
 
  
  // Delete previous images for the current username if this function executed again
    echo "Deleting previous images for $username...\n"; // Debug statement
    $previousImages = glob("$new*.jpg");

    foreach ($previousImages as $file) {
        unlink($file);
    }
   
   
   // echo "current time".$currtime."previous timestamp".$prevtime;


  //$newfilename='a1.jpg';
  
   
   
    //$new1=array();
require('conn.php');
    for($i=0;$i<9;$i++)
    {
        $new1[$i]="$new$i". $currtime.".jpg";//time is uttlized to use latest image which was prevented due to browser caching
mysqli_query($con,"update user_details1 set timestamp='$currtime' where username='$username'") or die("<br>query unsuccessful for insert");
        // echo $new1[$i];

    }

 
	/* for displaying file names created after cropping
        foreach($new1 as $x=>$val){
	echo $x."=>".$val;
	echo "<br>";}*/
 

	//getting image size
	$imgsize=getimagesize($filename);
	$w=$imgsize[0];
	$h=$imgsize[1];


	//creating canvas to copy all cropped image
	$canvas=imagecreatetruecolor($w+50,$h+50);



	$currentimage=imagecreatefromjpeg($filename);



	$i=0;
   	for($x=0;$x<=2*($w/3);$x=$x+$w/3)
 	{   
    	  $m=20;$n=20;//gap betweem cropped parts or splitted images
      
        	 for($y=0;$y<=2*($h/3);$y=$y+$h/3)
     	 {
	
    		//echo "x=".$x ."y=".$y."   ";
    		 
              $a=array('x'=>$x,'y'=>$y,'width'=>$w/3,'height'=>$h/3);

    		 $icr=imagecrop($currentimage,$a);
  
             imagejpeg($icr,$new1[$i]);
        	$i++;
    
      		//$newimage=imagecreatefromjpeg($newfilename);
  

    
    
       		$w2=imagesx($icr);
      		$h2=imagesy($icr);
     
     		//imagecopy($canvas,$icr,$x,$y,0+$m,0+$n,$w2,$h2);
        // imagecopy($canvas,$newimage,$x,$y,0+$m,0+$n,$w2,$h2);
     // imagejpeg($canvas,$newfilename);  
		//echo 'new1'.$new1[0];
        

    }//for y closing
         echo "<br>";
    }//for x closing
 mysqli_close($con);

  return $new1;
}//splitimg()




if(isset($_POST['crop'])&&isset($_FILES['img'])&&$_FILES['img']['size']!=0&&isset($un))
{  //document.write('$k[0]');
 $imgname=$_FILES['img']['name'];

    $k=splitimg($imgname,$un,$currtime);
  

 
    if (isset($k)) {
        echo "<script>";
        for ($i = 0; $i < count($k); $i++) {
            echo "var img_$i = document.createElement('img');
                  img_$i.setAttribute('onclick', 're($i)');
                  img_$i.src = '$k[$i]';
                  document.getElementById('d' + ($i+1)).appendChild(img_$i);";
        }
        echo "</script>";
    }
   }

?>

