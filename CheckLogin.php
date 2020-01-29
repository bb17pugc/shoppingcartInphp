<?php
     if(!isset($_SESSION["CurrentUser"]))
     {         
        header('location:http://localhost/ShoppingCart/users/signup.php', false);   
     }
  
?>
