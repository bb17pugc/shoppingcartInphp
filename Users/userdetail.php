<?php
ob_start();
    require ("../HeadersAndFooters/header.php");
    require '../Errors.php';
    $row;
    $qrySelect = "SELECT * FROM USERS WHERE ID='".$_GET['userid']."';";
    $result=$MySqli->query($qrySelect);
    if($result->num_rows > 0)
    {        
        $row = $result->fetch_assoc();        
    }?><div>
            <h1 class="text-center"  >
                Edit your details
            </h1>        
        </div>
            <hr />                                  
            <form class="full-width" style="text-align: center;"  method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" >                   
                <div style="display: inline-block;border-radius: 5px;max-width: 20%;max-height:20%;box-shadow: 0 4px 8px 0 lightskyblue, 0 6px 20px 0px lightskyblue;" >
                    <img src="<?php print "../Uploads/".$row['Picture'];?>" id="imagePreview"  style="max-width:80%;max-height:20%;margin-top: 10%" width="600" height="150"> 
                    <div id="pictureupload" style="padding: 10px 0px 10px 0px " >
                      <label id="piclable" style="background-color: black;color:lightskyblue;cursor: pointer" onclick="CheckFile()" >
                          <p id="picname" style="margin:0px" > upload picture </p>
                       <input type='file' id="fileUpload" name='file' style="display: none" accept=".png,.jpg,.jpeg,.gif,.tif" onchange="ShowImagePreview(this,document.getElementById('imagePreview'))" />                 
                      </label>
                   </div>
                </div>
                <br>
                <div style="display: inline-block;width: 100%;padding: 10px">
                    <input type="hidden" value="<?php echo $row['ID'] ?>" name ="id" />
                <input value="<?php echo $row['FirstName'] ?>" type="text" name="FirstName" class="form-control" placeholder="write your name here" required />
                <br />
                
                <input value="<?php echo $row['Email'] ?>" type="email" name="Email" class="form-control" placeholder="write your email here" required />
                <br />
              
                <input value="<?php echo $row['Password'] ?>" type="text" name="Password" class="form-control" placeholder="write your email here" required />
                <br />
           
                <input value="<?php echo $row['Password'] ?>" type="text" name="ConfirmPassword" class="form-control" placeholder="write your email here" required />
                
                <br />
                </div>
                
                <div style="display: inline-block;width: 100%;padding: 10px" >
                    <input class="form-control" type="submit" />                   
                </div>
            </form><?php
 if ($_SERVER["REQUEST_METHOD"] == "POST")
 {            
               
               $id=$Name = $Email = $Password = $ConfirmPassword = $Picture = "";
               $obj = new Errors();
                         $id = $_POST['id'];
                         $Name = $_POST['FirstName'];
                         $Email = $_POST['Email'];
                         $Password = $_POST['Password'];
                         $ConfirmPassword = $_POST['ConfirmPassword'];
                         $Picture = $_FILES['file']['name'];                          
             if($obj->CheckErrors( $Name , $Email , $Password , $ConfirmPassword , $Picture ))
             {
                   // checking if the user is registered already
                       $CheckUserQuery = "SELECT FirstName FROM USERS WHERE Email = '".$Email."'";
                       $result =  $MySqli->query($CheckUserQuery);
                       if($result->num_rows > 0)
                       {
                           //$Errors['DuplicateUser'] ="User exists already";
                           //ShowError();
                           die();
                       }

                //setting up user picture--start
                    $Picture = $_FILES['file']['name'];
                    $PictureFolder = "../Uploads/";
                    $FullPath = $PictureFolder.basename($Picture);
                    //get the extension of picture that must be jpg , jpeg , png ;
                    $PictureExtension = strtolower(pathinfo($FullPath , PATHINFO_EXTENSION));
                    // creatting valid extenstion for picture
                    $Extensions = array("jpg" , "jped" , "png");
                //setting up user picture--end
                    
                    if(in_array($PictureExtension, $Extensions))
                    {
                               
                               $sqlquery = "update users set FirstName  = '".$Name."' , Email = '".$Email."' , Password = '".$Password."' , Picture = '".$Picture."' where ID='".$id."'";
                               if($MySqli->query($sqlquery) === true)
                               {
                                   
                                   move_uploaded_file($_FILES['file']['tmp_name'] , $PictureFolder.$Picture);                      
                                   $qryRetUserName = "SELECT * FROM USERS WHERE Email = '".$Email."' ";
                                   $result =$MySqli->query($qryRetUserName);
                                   if($result->num_rows > 0)
                                   {
                                        $row = $result->fetch_assoc();                         
                                        $_SESSION["CurrentUser"] = $row;
                                        header('location:http://localhost/ShoppingCart/WebView/home.php');
                                   }
                               }
                    }
             }
}
?>
    <?php 
               include("../HeadersAndFooters/footer.php");
    ?>
            <style>
             
              input
              {
                  margin-top: 10px;
                  margin-bottom: 10px;
              }
               input[type="submit"]
              {
                  margin-top: 20px;
              }
        </style>
<script>
    function CheckFile()
    {
        $("#fileUpload").bind('change', function () {         
            //this.files[0].size gets the size of your file.           
        $("#picname").html(this.files[0].name);
        });
    }

    function ShowImagePreview(imageUploader, previewImage) {
        if (imageUploader.files && imageUploader.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(previewImage).attr('src', e.target.result);
            }
            reader.readAsDataURL(imageUploader.files[0]);
        }
    }
   
</script>
