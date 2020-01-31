<?php

      $MySqli = new mysqli( "localhost" , "root" , "1234567" ,"shoppingcart" );
                if($MySqli === false)
                {
                    die("could not connect");
                }   

?>