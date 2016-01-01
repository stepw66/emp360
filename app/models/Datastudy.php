<?php

class Datastudy extends Eloquent {

  protected $table  = "n_datastudy";
    
  protected $fillable = array( 'studyID', 'cid', 'degree', 'branch', 'year', 'institution' );
  
}
