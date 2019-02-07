<?php 

//include_once("controllers/studentController.php");
include_once("student.php");    
$args =["name"=>"trythis" ];

$t=(object)$args;

foreach($t as $a =>$v){
    
    
//    /var_dump ($a);
}
$a =new student (4);
echo $a->delete();
//echo student::deleteStatic(null,2);
//var_dump ($a);
//echo studentController::index() ;