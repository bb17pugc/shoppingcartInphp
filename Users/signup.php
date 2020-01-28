
         <?php 
               require ("../HeadersAndFooters/header.php");
               require '../Errors.php';

               if(isset($_SESSION['CurrentUser']))
               {
                               exit(header('location:http://localhost/ShoppingCart/WebView/home.php', false));                                    
               }
         ?>  
        <div>
            <h1 class="text-center"  >
                Register here
            </h1>        
        </div>
            <hr />                                  
            <form class="full-width" style="display: flex;flex-flow: row wrap;" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" >
                <div style="width:70%">
                    <input type="text" name="FirstName" class="form-control" placeholder="write your name here" />
                <br />
                <input type="email" name="Email" class="form-control" placeholder="write your email here" />
                <br />
                <input type="password" name="Password" class="form-control" placeholder="write password"   />
                <br />
                <input type="password" name="ConfirmPassword" class="form-control" placeholder="confirm your password"  />
                <br />                    
                </div>
                
                
                <div style="border-radius: 5px;margin-right: 10%;max-width: 20%;max-height:20%;box-shadow: 0 4px 8px 0 lightskyblue, 0 6px 20px 0px lightskyblue;" >
                    <img id="imagePreview" style="max-width:80%;max-height:20%;margin-top: 10%" width="600" height="150"> 
                    <div id="pictureupload" style="padding: 10px 0px 10px 0px " >
                      <label id="piclable" style="background-color: black;color:lightskyblue;cursor: pointer" onclick="CheckFile()" >
                          <p id="picname" style="margin:0px" > upload picture </p>
                       <input type='file' id="fileUpload" name='file' style="display: none" accept=".png,.jpg,.jpeg,.gif,.tif" onchange="ShowImagePreview(this,document.getElementById('imagePreview'))" />                 
                      </label>
                   </div>
                </div>
                
                
                
                <div style="width: 100%" >
                    <input class="form-control" type="submit" />                   
                </div>
             </form>                    
<div style="resize: both;">
<?php
 if ($_SERVER["REQUEST_METHOD"] == "POST")
{   
  $Name = $Email = $Password = $ConfirmPassword = $Picture = "";
               $obj = new Errors();
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
                           $Errors['DuplicateUser'] ="User exists already";
                           ShowError();
                           die();
                           print "hi";
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
                               $sqlquery = "INSERT INTO USERS( ID , FirstName , Email , Password , Picture ) VALUES (0 ,'".$Name."' , '".$Email."' , '".$Password."' , '".$Picture."') ";    
                               if($MySqli->query($sqlquery) === true)
                               {
                                   move_uploaded_file($_FILES['file']['tmp_name'] , $PictureFolder.$Picture);                      
                                   $qryRetUserName = "SELECT * FROM USERS WHERE Email = '".$Email."' ";
                                   $result =$MySqli->query($qryRetUserName);
                                   if($result->num_rows > 0)
                                   {
                                        $row = $result->fetch_assoc();                         
                                        $_SESSION["CurrentUser"] = $row;  
                                        exit(header('location:../products/products.php', false));                                    
                                        
                                   }

                               }
                    }

             }

}

?>
 </div>
                    
         <?php 
               include("../HeadersAndFooters/footer.php");
         ?>  
        </div>
    </body>
</html>

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
