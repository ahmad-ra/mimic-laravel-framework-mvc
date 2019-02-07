<?php 

include_once("db.php") ;

class model extends DB {
    

   function __construct ($id=null)
    {
   if($id) $this ->{get_called_class()} =model::constructModel(get_called_class(),$id);
    else
        $this->{get_called_class()}=null ;
    }


   static function all($keyword=null,$columnName=null){
 $model = get_called_class() ;

    DB::connect();
    
    $con = DB::$con ;
    
    if($keyword  && $columnName){
    $sql ='select id from `'.$model.'s` where `'.$columnName.'` like "%'.$keyword.'%"' ;}
    
    else $sql ='select id from `'.$model.'s`';
    
    $results = mysqli_query($con,$sql);

    while( $oneRow = mysqli_fetch_assoc($results)){

        $output[]= model::constructModel($model,$oneRow["id"]);
            //new $model($oneRow["id"]);
    
       // var_dump(json_encode($s));
    }
  
if(!isset($output)) return ('No Results!') ;
   else return $output;
    
    
}
    

  static function constructModel($model,$id){
    DB::connect();
    // model::autoload($model);
    $output = new stdclass();
  
$sql = 'select * from `'.$model.'s` where id = '.$id ;
      
        $res = mysqli_query (DB::$con ,$sql) ;
        
        if(mysqli_affected_rows(DB::$con)) {
            $arr = mysqli_fetch_assoc($res);
       // var_dump(json_encode($student));
        foreach($arr as $col => $value ){
            $output->$col =$value;
            }
            
            return $output;
    
    
}    
    
}
   
    static function create ($args){
        
        $model= get_called_class() ;
        
        $row = (object)$args ;
        
   
      return  model::save($row,$model);
      
        
        
    }
    
    static function save ($obj,$model){
        
        $sql ="INSERT INTO `".$model."s` (`id`,"  ;
        
        foreach($obj as $col =>$val ){
            
            $sql.=" `$col` ," ;
            
        }
        
        $sql =substr($sql, 0, -1);
        
        $sql2= ") VALUES (NULL," ;
            
        foreach($obj as $col =>$val ){
            
            $sql2.=' " '.$val .'" ,' ;
            
        } 
           $sql2 =substr($sql2, 0, -1);
        
        $sql = $sql.$sql2.");";
       // echo $sql;
      
         DB::connect();
        
          $res = mysqli_query (DB::$con ,$sql) ;
        
        if(mysqli_affected_rows(DB::$con)) { return 1; }
        else return 0;
        
    }
    
    static function updateStatic ($args ,$modelObj=null, $id=null ){
        
      $model= ($modelObj)?get_class($modelObj):get_called_class() ;

       $args =(object)$args ;
     
        $updated= ($modelObj)? $modelObj->$model:(model::constructmodel($model,$id)) ;
        
        foreach ($updated as $col => $val){
            
            if( isset($args->$col) ){
             if($args->$col != $val && $args->$col != NULL )
             $updated->$col = $args->$col ;}
            
            
        }
        
        $sql = " UPDATE `".$model."s` SET " ;
        
        foreach ($updated as $col =>$val){
            
            $sql .=" `$col` = ' $val ' ," ;
            
        }
        
        $sql =substr($sql, 0, -1);
        
      $sql.= "WHERE id = ".$updated->id." ;" ;
       
        
         DB::connect();
        
          $res = mysqli_query (DB::$con ,$sql) ;
        
        if(mysqli_affected_rows(DB::$con)) { return 1; }
        else return 0;
            
    
    }
   
    function update ($args){
        return model::updateStatic ($args,$this);
    }
    
      static function deleteStatic ($modelObj=null ,$id=null ){
         
         $model= ($modelObj)?get_class($modelObj):get_called_class() ;
        $id =($id)?$id :(isset($modelObj->$model->id))?$modelObj->$model->id:null ;
         if (!$id) return 0 ;
         $sql = " DELETE FROM `".$model."s` WHERE `id` =  $id  " ;
         
           DB::connect();
        
          $res = mysqli_query (DB::$con ,$sql) ;
        
        if(mysqli_affected_rows(DB::$con)) { return 1; }
        else return 0;
     }
    
     function delete (){
        
        return model::deleteStatic($this);
    }
    
    
    
    
    public static function get_calling_class() {

    //get the trace
    $trace = debug_backtrace();

    // Get the class that is asking for who awoke it
    $class = $trace[1]['class'];

    // +1 to i cos we have to account for calling this function
    for ( $i=1; $i<count( $trace ); $i++ ) {
        if ( isset( $trace[$i] ) ) // is it set?
             if ( $class != $trace[$i]['class'] ) // is it a different class
                 return $trace[$i]['class'];
    }
}
    
}








//public static function one($model,$id=null){
//    
//     model::autoload($model);
//    
//    DB::connect();
//    
//    $con = DB::$con ;
//    if($id)
//    $sql ='select id from `'.$model.'s` where id='.$id ;
//    else 
//    $sql ='select id from `'.$model.'s` ' ;
//    
//    $result = mysqli_query($con,$sql);
//
//    while( $oneRow = mysqli_fetch_assoc($result)){
//
//        $output[]= new $model($oneRow["id"]);
//    
//       // var_dump(json_encode($s));
//    }
//    
//
//    return $output;
//    
//    
//}    
    
    //var_dump(json_encode(model::all("student","ah","name")));
