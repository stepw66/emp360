<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

  protected $table  = "users";
  protected $hidden = ['password'];


  protected $fillable = array('username', 'password', 'pname', 'fname', 'lname', 'cid', 'position', 'active', 'lastlogin', 'remember_token');

  public static $rules = array(
    'username' => 'required',
    'password' => 'required',
    'pname' => '',
    'fname' => 'required',
    'lname' => 'required',
    'cid' => 'required',
    'position' => '',
    'active' => '',
    'remember_token' => ''
  );

   public static $messages = array(
    'username.required' => '** กรุณากรอกชื่อผู้ใช้ **',
    'password.required' => '** กรุณากรอกรหัสผ่าน **',
    'fname.required' => '** กรุณากรอกชื่อ **',
    'lname.required' => '** กรุณากรอกนามสกุล **',  
    'cid.required' => '** กรุณากรอกรหัสบัตรประชาชน **'  
  ); 
  
  public function getAuthIdentifier()
  {
    return $this->getKey();
  }
  
  public function getAuthPassword()
  {
    return $this->password;
  } 
  
  public function getRememberToken()
  {
    return $this->remember_token;
  }
  
  public function setRememberToken($value)
  {
    $this->remember_token = $value;
  }
  
  public function getRememberTokenName()
  {
    return "remember_token";
  }
  
  public function getReminderEmail()
  {
    return $this->email;
  }



  


}
