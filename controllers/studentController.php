<?php 


//include_once("../student.php") ;
include_once("controller.php") ;

//this is a trial to implement the controller .I didn't figure out a way to make it clean as the model as to only create an empty class when using it  (I didn't look at laravel implementation we want to challenge ourselves here) , contributions are welcome!

class studentController extends controller

{
    
    public static function index(){
        
       $model = controller::illuminate(get_called_class());
        return json_encode($model::all());
    }
    
    
     static function show($id){
        
         $model = controller::illuminate(get_called_class());
        $output = new $model($id);
        return $output ;
    }
    
    public static function create ($args=null){
         $model = controller::illuminate(get_called_class());
         
        $model::create ($args) ;
        
    }
    
    public static function update ($id ,$args=null){
     $model = controller::illuminate(get_called_class());
   $updated = new $model($id);
       $updated->model =(object)$args ;
        $update->$model->id=$id ;
            
    }
    
   
    private static function illuminate ($caller){
        
        $model= substr($caller,0,-10);
        controller::autoload($model);
        return $model ;
        
    }
    private static function autoload($model){
        
         spl_autoload_register(function ($model) {include "../".$model . '.php';});
    }  
    
    
}


//index();


