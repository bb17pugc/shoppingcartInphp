<?php
       session_start();
       session_destroy(); 
       header( "location:http://localhost/ShoppingCart/users/login.php" , false);
?>
