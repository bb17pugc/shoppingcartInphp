<?php
      class Errors
      {
          private $Errors = array();
          private $Name;
          private $Email;
          private $Password;
          private $ConfirmPassword;
          private $Picture;          
                   
          
          function CheckErrors( $FirstName , $Email , $Password , $ConfirmPassword  , $Picture) 
          {                   
                    if(empty($FirstName) && $FirstName!==null )
                    {
                        $this->Errors['required'] = "Name is required";        
                    }
                    else if($FirstName!==null)
                    { 
                        $regEx = "/^[A-Za-z]+$/";
                        if(!preg_match($regEx, $FirstName))
                        {           
                            $this->Errors['invalidname'] = "Invalid name write the correct name with 7 characters max";        
                        }
                    }
                    if(empty($Email && $Email!==null))
                    {
                        $this->Errors['email'] = "Email is required";          
                    }
                     else if($Email!==null)
                    { 
                         //^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$ 
                        $regEx = "/^([A-Za-z0-9\_\.\-]+)@([a-zA-Z\_\.\-]+)\.([a-zA-Z]{2,5})$/";
                        if(!preg_match($regEx, $Email))
                        {           
                            $this->Errors['invalidemail'] = "Invalid email write the correct email";        
                        }
                    }
                    if(empty($Password && $Password!==null ))
                    {
                        $this->Errors['password'] = "Password is required";            
                    }
                    if(empty($ConfirmPassword) && $ConfirmPassword!==null )
                    {
                        $this->Errors['confirm_password'] = "Confirm password is required";          
                    }
                    else if($Password != $ConfirmPassword && $ConfirmPassword!==null)
                    {
                        $this->Errors['confirm_password'] = "Password and Confirm password are not matched";
                    }
                    if(empty($Picture) && $Picture!==null )
                    {
                        $this->Errors['PictureRequired'] = "Picture is required";            
                    }
                
                
                if(Errors::ShowErrors())
                {
                    return true;
                }
                
           }
           function ShowErrors()
           {
               if(count($this->Errors) > 0)
               {
                   ?>
                           <div style="width:100% ; text-align: center" >        
                            <ul style="list-style-type: none;width: 50%;display: inline-block;text-align:left" >                
                             <?php              
                            foreach($this->Errors as $error)
                              {
                                  echo "<li style='padding : 8px 0px 8px 5px ;border:solid red 0.8px;border-radius:5px;color:red;width:100%;font-size:20px;margin:10px 0px 0px 0px'>"."* ".$error."</li>";
                              }
                              $this->Errors = "";
                              ?>
                            </ul>
                           </div>    
                        <?php
               }
               else 
               {
                   return true; 
               }
           }
      }

?>