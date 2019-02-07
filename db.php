<?php

class DB 
    
{
    
    protected static $con ;
    
 public static function connect (){
  if(DB::$con != NULL) return ;
     
     
DB::$con = mysqli_connect("localhost","root","","talta1");

     if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

}
  
    
  
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
} ;






    
    
  