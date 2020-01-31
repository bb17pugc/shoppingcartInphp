<?php
        require '../HeadersAndFooters/header.php';       
        $qrySelect = "SELECT * FROM PRODUCTS";
        $result=$MySqli->query($qrySelect);
        $Picture = "../Uploads/";
     
?>