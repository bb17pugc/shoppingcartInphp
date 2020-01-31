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

            function Total()
            {     
                $Total = 0;
                   for($i=0;$i<count($this->Items);$i++)
                    {
                       $Total = $Total + $this->Items[$i]['Quantity']* $this->Items[$i]['Price'];
                    }
                    return $Total;
            }
            function AddItems($Name , $ID , $Price, $Catagory,$Picture)
            { 
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
                                  <table cellspacing="0" cellpadding="10" >
                                      <tr id="calrow">
                                          <th colspan="6" style="background-color: gray;border-radius:5px 5px 0px 0px " >
                                              <div>
                                                  <label style="color: white;float: right" > TOTAL : <?php print $this->Total(); ?></label>
                                              </div>
                                        </th>
                                       </tr>
                                       <tr style="color: white">
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                            Price
                                        </th>
                                        <th>
                                            Catagory
                                        </th>
                                        <th>
                                            Picture
                                        </th>
                                        <th>
                                            Quantity
                                        </th>
                                        <th>
                                            Sub_Total
                                        </th>
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
                                        <td>
                                            <?php
                                                   print $this->Items[$i]['Quantity']*$this->Items[$i]['Price'];
                                                   
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
          table-layout: fixed;
      }
      table
      {
          background-color: white;
          width: 100%;
          text-align: center;
          border-radius: 5px;
          font-family: sans-serif;
      }
      th
      {
          background-color: gray;
      }
      #calrow th
      {
          background-color: lightskyblue;
      }
      td , th
      {
          border-bottom: solid 1px gray;
          
      }
</style>       