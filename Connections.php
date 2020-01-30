<?php

      $MySqli = new mysqli( "localhost:8111" , "root" , "1234567" ,"shoppingcart" );
                if($MySqli === false)
                {
                    die("could not connect");
                }   

?>