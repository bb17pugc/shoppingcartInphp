<?php
        require '../HeadersAndFooters/header.php';
        $Catagory; 
        if(!empty($_POST['catagory']))
        {
            $Catagory = $_POST['catagory'];
            $qrySelect = "SELECT * FROM PRODUCTS WHERE Catagory = '".$Catagory."'";
        }
        else if(!empty($_GET['catagory']))
        {
            $Catagory = $_GET['catagory'];
            $qrySelect = "SELECT * FROM PRODUCTS WHERE Catagory = '".$Catagory."'";
        }
        else
        {
            $Catagory = '';
            $qrySelect = "SELECT * FROM PRODUCTS";    
        }
        $result=$MySqli->query($qrySelect);
        $Picture = "../Uploads/";
        $_SESSION['shopping_status'] = "yes";
        if($result->num_rows > 0)
        {
            ?>
                    <div style="text-align: center;max-width: 100%;border:solid 1px lightskyblue;max-height:1000px ;overflow-y: auto;display: flex;flex-wrap: wrap;padding: 10px">
            <?php
            while($row=$result->fetch_assoc())
            {
                ?>
                        <div class="col-3" >
                                    <table style="width: 100%;border:solid 1px lightskyblue;">
                                        <tr>
                                            <td style="text-align: center">
                                                <img src=" <?php echo $Picture.$row['Picture']  ?>  " width="200" height="200" >
                                            </td>
                                        </tr>
                                              <tr>
                                                <td style="justify-content: space-between;font-size:bold;display: flex;background-color: skyblue;">
                                                    <div style="width:auto;padding: 5px 0px 5px 10px">
                                                     <h2 style="color:white;border:solid 1px white;border-radius: 10px;padding: 10px 10px 10px 10px ;margin: 0px 0px 0px 0px;">                                                       
                                                     <?php 
                                                            echo $row['Name'];
                                                     ?>
                                                    </h2>
                                                    </div>
                                                    <div style="color:white;justify-content: center;display: flex;flex-direction: column">
                                                        <p style="margin: 0px 5px 0px 0px">                                                            
                                                         <?php 
                                                            echo "price.".$row['Price'];
                                                       ?>
                                                      </p>
                                                    </div>                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-right:10px" >
                                                    <div>
                                                            <p style="margin: 0;float: right;display: inline;color:black">
                                                            <?php 
                                                                    echo $row['Catagory'];
                                                                ?>
                                                            </p>

                                                            <p style="display: inline;float: right;margin:0px;background-color: white;color:lightgray">
                                                                Catagory :
                                                            </p>

                                                    </div>
                                                </td>  
                                            </tr>
                                            <tr>
                                                <td style="padding: 0px 10px 10px 0px" >
                                                    <form method="post" action="../Products/Cart.php">
                                                        <input value="<?php echo $row['ID'] ?>" > 
                                                        <input value="<?php echo $row['Catagory'] ?>" >
                                                        <input class="cart" type="submit" value="Add to Cart" />
                                                    </form>
                                                    </a>
                                                </td>  
                                            </tr>
                                        </table>
                        </div>    

                <?php
            }
            ?>
                   </div>         
            <?php
        }
    
?>
<style>
    .col-3
    {
        display: inline-block;
        flex-grow:1;
        max-width : 30%;
        min-width : 30%;
        font-family: sans-serif;
        color:white;
        padding:10px;
        text-transform: uppercase;
    }
   .col-3 .cart
    {
        text-decoration: NONE;
         border:none;float:right;padding:10px;background-color: green;color:white;cursor:pointer;
    }
    .col-3 .cart:hover
    {
        background-color: skyblue;
        border: solid 1px skyblue;
        transition: 1s;
    }
    
</style>
