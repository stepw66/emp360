<?php

class Leave extends Eloquent {

  protected $table  = "n_leave_type";

  protected $fillable = array('leave_type_name');

  public static $rules = array(
    'leave_type_name' => 'required'   
  );
  
  public static $messages = array(
    'leave_type_name.required' => '** กรุณากรอกประเภทการลา **'  
  ); 

}


?>