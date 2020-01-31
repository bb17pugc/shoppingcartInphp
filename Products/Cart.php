<?php
        require '../HeadersAndFooters/header.php';
        
        $qrySelect = "SELECT * FROM PRODUCTS WHERE ID = '".$_GET['productid']."'";
            $result=$MySqli->query($qrySelect);
            $row = $result->fetch_assoc();
            $_GET['productid']="";
            $Picture = "../Uploads/";
            unset($_SESSION['shopping_status']);
        
        //creating class to store the cart items
        $ID=$Name=$Price=$Catagory=$Picture="";
        $ID = $row['ID'];        
        $Name = $row['Name'];
        $Price = $row['Price'];
        $Catagory = $row['Catagory'];
        $Picture = $row['Picture'];
         function GetCart() 
        {
            $obj = new CartItems();
            if(isset($_SESSION["Cart"]))
            {
               $obj = $_SESSION["Cart"];
            }
            else
            {
                $_SESSION["Cart"] = $obj;
            }
            return $obj;
        }
        class CartItems
        {
            public $Items = array();
            
            function IsAddedd($ID)
            {
                    for($i=0;$i<count($this->Items);$i++)
                    {
                       if($this->Items[$i]['ID'] == $ID)
                        {
                           $this->Items[$i]['Quantity']++;
                            return true;
                        }
                    }
                    return false;
            }


            function AddItems($Name , $ID , $Price, $Catagory,$Picture)
            { 
                //$this->clearAll();
                $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
                if(!$pageWasRefreshed ) 
                {
                    if(!$this->IsAddedd($ID))
                    {
                        $lenth = count($this->Items);   
                        $this->Items[$lenth]['ID'] = $ID; 
                        $this->Items[$lenth]['Name'] = $Name; 
                        $this->Items[$lenth]['Price'] = $Price; 
                        $this->Items[$lenth]['Catagory'] = $Catagory; 
                        $this->Items[$lenth]['Picture'] = $Picture; 
                        $this->Items[$lenth]['Quantity'] = '1'; 

                    }
                 }
                ?>
                    <div style="padding: 10px;background-color: lightskyblue" >
                                  <table cellspacing="0" >
                                    <tr>
                                        <td>
                                            Name
                                        </td>
                                        <td>
                                            Price
                                        </td>
                                        <td>
                                            Catagory
                                        </td>
                                        <td>
                                            Picture
                                        </td>
                                        <td>
                                            Quantity
                                        </td>
                                    </tr>
                                  
                   <?php
                for($i=count($this->Items)-1;$i>=0;$i--)
                {  
                    ?>

                              <tr>
                                        <td>
                                              <?php
                                                   print  $i." ".$this->Items[$i]['Name'];
                                              ?>
                                        </td>
                                        <td>
                                            <?php
                                                   print $this->Items[$i]['Catagory'];
                                              ?>
                                        </td>
                                        <td>
                                            <?php
                                                   print $this->Items[$i]['Price'];
                                              ?>
                                        </td>
                                        <td>
                                            <?php
                                                   print $this->Items[$i]['Picture'];
                                              ?>
                                        </td>
                                        <td>
                                            <?php
                                                   print $this->Items[$i]['Quantity'];
                                              ?>
                                        </td>
                                    </tr>
                    <?php          
                }
                ?>
                        </table>
        
                    </div>    
                <?php
               
            }
            function clearAll()
            {
                $this->Items = array();
            }
        }        
       
        $obj = GetCart();
        $obj->AddItems($Name , $ID, $Price, $Catagory, $Picture);        

        
        ?>
 <?php 
               include("../HeadersAndFooters/footer.php");
 ?>  
<style>
      table , tr,td
      {
          border:solid 1px gray;
          table-layout: fixed;
      }
      table
      {
          width: 100%;
      }
</style>       