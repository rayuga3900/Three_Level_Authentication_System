<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<meta name="viewport"content="width=device-width,initial-scale=1"/>
  <link rel="stylesheet" type="text/css" href="./css/success_msg.css">
</head>
<body>
   
        <?php
            session_start();

            if(isset($_SESSION['unlog'])) {
                $username=$_SESSION['unlog'];
              echo " <p>Login successful</p>
                      ";
            } elseif(isset($_SESSION['un1'])) {
                echo "    <p>Your password has been changed successfully</p>
                      ";
                      echo "<script>    
                    setTimeout(function () {
                        window.location.href = 'index.html';
                    }, 3000);
                </script>";
            } elseif(isset($_SESSION['un'])) {
                echo "   <p>Registered successfully</p>
                      ";
                      echo "<script>    
                    setTimeout(function () {
                        window.location.href = 'index.html';
                    }, 3000);
                </script>";
            } 

           session_destroy();
        ?>
  
</body>
</html>
