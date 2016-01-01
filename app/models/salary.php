<?php

class Salary extends Eloquent {

  protected $table  = "n_position_salary";
    
   protected $fillable = array( 'salaryID', 'cid', 'positiondate', 'position_id', 'level', 'location_id', 'salary', 'comment' );
  
}
