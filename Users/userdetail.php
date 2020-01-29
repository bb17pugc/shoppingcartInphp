<?php
    require ("../HeadersAndFooters/header.php");
    require '../Errors.php';
    $row;
    $qrySelect = "SELECT * FROM USERS WHERE ID='".$_GET['userid']."';";
    $result=$MySqli->query($qrySelect);
    if($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
        print $row['FirstName'];
    }
?>
 <div>
            <h1 class="text-center"  >
                Edit your details
            </h1>        
        </div>
            <hr />                                  
            <form class="full-width" style="text-align: center;"  method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">                   
                <div style="display: inline-block;border-radius: 5px;max-width: 20%;max-height:20%;box-shadow: 0 4px 8px 0 lightskyblue, 0 6px 20px 0px lightskyblue;" >
                    <img id="imagePreview"  style="max-width:80%;max-height:20%;margin-top: 10%" width="600" height="150"> 
                    <div id="pictureupload" style="padding: 10px 0px 10px 0px " >
                      <label id="piclable" style="background-color: black;color:lightskyblue;cursor: pointer" onclick="CheckFile()" >
                          <p id="picname" style="margin:0px" > upload picture </p>
                       <input type='file' id="fileUpload" name='file' style="display: none" accept=".png,.jpg,.jpeg,.gif,.tif" onchange="ShowImagePreview(this,document.getElementById('imagePreview'))" />                 
                      </label>
                   </div>
                </div>
                <br>
                <div style="display: inline-block;width: 100%;padding: 10px">
                    <input value="<?php echo $row['FirstName'] ?>" type="text" name="FirstName" class="form-control" placeholder="write your name here" required />
                <br />
                <input value="<?php echo $row['Email'] ?>" type="email" name="Email" class="form-control" placeholder="write your email here" required />
                <br />
                </div>
                
                <div style="width: 100%" >
                    <input class="form-control" type="submit" />                   
                </div>
             </form>