<?php

class Datawork extends Eloquent {

  protected $table  = "n_datawork";
    
  protected $fillable = array( 'workID', 'cid', 'numlocation', 'appointed_date', 'working_period', 'retirecd_date', 'position', 'current_salary', 'location' );
  
}
