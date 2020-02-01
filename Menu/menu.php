<div class="bg-color" style="display: flex;width: 100%;justify-content: space-between">
    <div class="bg-color"> 
  <?php 
        if(isset($_SESSION["CurrentUser"]))
        {
            ?>
                    <ul class="navigation-menu" style="display: flex;align-items: center" >
                        <li>
                            <a  href="../WebView/home.php" id="home" > home</a>
                        </li>
                        <li>
                            <a href="../Products/products.php" id="products">Products</a>    
                        </li>
                        <li>
                                <a>About</a>
                        </li>
                        <li>
                                <a>Contact Us</a>
                        </li>
                        <li class="bg-color" style="justify-content: center;flex-direction: row;align-items: center">
                            <?php
                                    if(substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1) == "products.php")
                                    {
                                        ?>
                            <div>
                                <select>
                                                <option>
                                                        item1
                                                </option>
                                                <option>
                                                        item1
                                                </option>
                                                <option>
                                                        item1
                                                </option>
                                        </select>
                            
                            </div>
                            <?php
                                    }
                                ?>
                             
                        </li>

                      </ul>
         <?php
        }
        else
        {
             ?>
                        <p style="color: white;padding-left: 10px">
                            login to visit the website
                        </p>
             <?php
        }
       
  ?>  
</div>
<div style="background-color: gray;float: right">
    <ul class="navigation-menu">    
        <?php                 
                if(isset($_SESSION["CurrentUser"]))
                {
                    ?>
                                <?php 
                                        $userdata = $_SESSION['CurrentUser'];
                                        $Picture = "../Uploads/".$userdata['Picture'];
                                        ?>
                                            <li>
                                                <a href="../Users/userdetail.php?userid=<?php echo $userdata['ID']; ?>" style="padding: 0px 5px 0px 5px  " >
                                                        <img src=' <?php echo $Picture ?> ' width="45" height="51" style="vertical-align: middle;border-radius: 40px"  />                                     
                                                              <?php
                                                                    echo $userdata['Email'];
                                                                ?>    
                                                </a>    
                                            </li>                                      
                        <li>
                                <a href="../Users/logout.php" >logout</a>                
                        </li>                        
                    <?php
                }
                else 
                {
                    ?>
                         
                        <li>
                            <a href="../Users/signup.php" id="signup" > sign up </a>
                        </li>
                        <li>
                            <a href="../Users/login.php" id="login" >login</a>    
                        </li>

                  <?php
                }    
        ?>    
  </ul>
</div>
</div>
<style>
      select
      {
          width: 300px;
          padding:10px;
         
      }
      select option
      {
          padding: 40px;
      }
</style>
<script type="text/javascript" >    
    $(document).ready(function()
{
       $(function()
       {
            var pathname =  window.location.pathname.split('/').pop();  
            var name = pathname.split(".")[0];      
            $("#"+name).css("background-color" , "lightskyblue");
           
       });
});
    
</script>
