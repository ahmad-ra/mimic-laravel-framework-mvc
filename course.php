<?php 

include_once("model.php");

class course extends model 
{
    
    
    
}


$dd=course::all("","name");
$dd2=new course(1);
var_dump(json_encode($dd2));