<?php

class Position extends Eloquent {

  protected $table  = "n_position";

  protected $fillable = array('positionName');

  public static $rules = array(
    'positionName' => 'required'   
  );
  
  public static $messages = array(
    'positionName.required' => '** กรุณากรอกชื่อตำแหน่ง**'  
  ); 

}

?>