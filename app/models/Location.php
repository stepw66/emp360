<?php

class Location extends Eloquent {

  protected $table  = "n_location_work";

  protected $fillable = array('locationName');

  public static $rules = array(
    'locationName' => 'required'   
  );
  
  public static $messages = array(
    'locationName.required' => '** กรุณากรอกชื่อสถานที่ทำงาน**'  
  ); 

}

?>