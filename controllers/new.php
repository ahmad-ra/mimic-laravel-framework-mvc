<?php 
//this is a trial to implement the controller .I didn't figure out a way to make it clean as the model as to only create an empty class when using it  (I didn't look at laravel implementation we want to challenge ourselves here) , contributions are welcome!


class controller {
    
function __construct (){
    
        $model = controller::illuminate(get_called_class()); 
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