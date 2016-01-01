<?php

class Department extends Eloquent {

  protected $table  = "n_department";

  protected $fillable = array('departmentName');

  public static $rules = array(
    'departmentName' => 'required'   
  );
  
  public static $messages = array(
    'departmentName.required' => '** กรุณากรอกชื่อแผนก **'  
  ); 

}
