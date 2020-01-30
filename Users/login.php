<?php 
     require'../HeadersAndFooters/header.php';
     require '../Errors.php';
                if(isset($_SESSION['CurrentUser']))
               {
                               exit(header('location:http://localhost/ShoppingCart/WebView/home.php', false));                                    
               }
               
               function returnback()
               {
                 return  htmlspecialchars($_SERVER['PHP_SELF']);
               }
?>

        <div>
            <h1 class="text-center"  >
                Login here
            </h1>        
        </div>
      <hr />                                  
      <form class="full-width" style="display: flex;flex-flow: row wrap;" method="post" action="<?php returnback(); ?>" >
                <div style="width:100%">
                <input type="email" name="Email" class="form-control" placeholder="write your email here" />
                <br />
                <input type="password" name="Password" class="form-control" placeholder="write password"   />
                </div>
                <div style="width: 100%" >
                <br />
                <br />               
                    <input class="form-control" type="submit" />                   
                </div>
             </form>
      
      <?php 
            //starting php code
            if( $_SERVER["REQUEST_METHOD"] == "POST" )
            {
                
                $Email = $Password = "";
                $Email = $_POST["Email"];
                $Password = $_POST["Password"];
                $obj = new Errors();
                if($obj->CheckErrors( null ,$Email, $Password , null , null))
                {
                    $qrySelect = "SELECT * FROM USERS WHERE Email = '".$Email."' && Password = '".$Password."' ";
                    $result = $MySqli->query($qrySelect);
                    if($result->num_rows > 0)
                    {
                        $CurrentUser = $result->fetch_assoc();
                        $_SESSION["CurrentUser"] = $CurrentUser;
                        header('location:http://localhost/ShoppingCart/WebView/home.php', false);
                    }
                    
                }
            }
     ?>
      
      