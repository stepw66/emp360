<?php

class Emp extends Eloquent {

  protected $table  = "n_datageneral";

  protected $fillable = array( 'numlocation', 'panem', 'fname', 'lname', 'birthday', 'cid', 'address', 'tmbpart', 'amppart', 'chwpart', 'zipcode', 'tel', 'mobile', 'email', 'picture', 'lastupdate', 'status' );


  public static $rules = array(
    'numlocation' => '',
    'panem' => '',  
    'fname' => 'required',
    'lname' => 'required',
    'birthday' => 'required',
    'cid' => 'required',
    'address' => '',
    'tmbpart' => '',
    'amppart' => '',
    'chwpart' => '',
    'zipcode' => '',
    'tel' => '',
    'mobile' => '',
    'email' => '',
    'picture' => '',
    'lastupdate' => '',
    'status' => ''
  );
  
  public static $messages = array(
    'fname.required' => '** กรุณากรอกชื่อ **',
    'lname.required' => '** กรุณากรอกนามสกุล **',
    'birthday.required' => '** กรุณากรอกวันเกิด **',
    'cid.required' => '** กรุณากรอกรหัสบัตรประชาชน **'      
  ); 

}
