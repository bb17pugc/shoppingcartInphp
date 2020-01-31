<?php
        require '../HeadersAndFooters/header.php';
        if(isset($_SESSION['shopping_status']))
        {
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
            
            function AddItems($Name , $ID , $Price, $Catagory,$Picture)
            {
                $lenth = count($this->Items);
                $this->Items[$lenth]['ID'] = $ID; 
                $this->Items[$lenth]['Name'] = $Name; 
                $this->Items[$lenth]['Price'] = $Price; 
                $this->Items[$lenth]['Catagory'] = $Catagory; 
                $this->Items[$lenth]['Picture'] = $Picture; 
                ?>
                    <div style="padding: 10px" >
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
                                    </tr>
                                  
                   <?php
                for($i=$lenth;$i>0;$i--)
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

        }
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