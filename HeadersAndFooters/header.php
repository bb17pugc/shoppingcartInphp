<?php
    session_start();    
    require_once '../Connections.php';
?>

<html>
    <head>     
        <script src="../js/ajax.js" type="text/javascript"></script>
        <script src="../js/jquery.js" type="text/javascript"></script>
        <link href="../style.css" rel="stylesheet" type="text/css"/>
        <link href="../fontawesome/css/all.css" rel="stylesheet" type="text/css"/>
        <link href="../fontawesome/css/solid.min.css" rel="stylesheet" type="text/css"/>
        <link href="../fontawesome/css/solid.css" rel="stylesheet" type="text/css"/>
        <link href="../fontawesome/css/fontawesome.css" rel="stylesheet" type="text/css"/>
        <link href="../fontawesome/css/brands.css" rel="stylesheet" type="text/css"/>
        <link href="../fontawesome/css/v4-shims.css" rel="stylesheet" type="text/css"/>
        <link href="../fontawesome/css/solid.css" rel="stylesheet" type="text/css"/>
     </head>
     <body style="height: fit-content" >
    <div style="width: 100%;font-family: sans-serif;padding-bottom: 0px;height: fit-content;background-color: lightskyblue;padding-top: 0px" >            
       <h1 style="color:white;margin-top: 0px" > E-Commerce Site </h1>
    <div style="margin-top: 10%;display: flex;" >
     <?php
           require_once '../Menu/menu.php';
       ?>    
    </div>
   
   </div>
   <div style="width: 100%;" >
