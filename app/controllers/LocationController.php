<?php

/**
 * Create LocationController for emp360
 * version 1.0
 * create by ThemeSanasang
*/

class LocationController extends BaseController {
	

	public function home()
	{
		if ( Auth::check() )
		{
			$locationall = DB::table( 'n_location_work' )        
	         ->orderBy( 'location_id', 'asc')
	         ->paginate( 10 );	

			//view page create
		    return View::make( 'locations.home',  array( 'locationall' => $locationall ) );			    		 		
		}	
		else
		{
			//return login
    		return View::make( 'users.index' );	
		}				
	}

	
	/**
	 * function name : create
	 * view page create Location
	 * 
	 * get
	*/
    public function create()
    {
    	if ( Auth::check() )
    	{  		
	    	//view page create
	        return View::make( 'locations.create' );
    	}
    	else
    	{
    		//return login
    		return View::make( 'users.index' );	
    	}  	
    }

    /**
	 * function name : post_new_location
	 * reciep data post form create
	 * create new location
	 * post
	*/
    public function post_new_location()
    {
    	//get location details
	    $locationName  = Input::get( 'locationName' );	  
	  
        $validator = Validator::make( Input::all(),  Location::$rules, Location::$messages );
			  	    
	    //check if the form is valid
	    if ( $validator->fails() )
	    {			
	        $messages = $validator->messages();			
			return Redirect::to( 'admin/locations/create' )->withErrors( $validator );
	    }
	    else
	    {	    		    	         
			$location = DB::insert( 'insert into n_location_work (locationName) values (?)', array( $locationName ) );

            if( $location )
            {
            	return Redirect::to( 'admin/locations' )->with( 'success_message', 'เพิ่มข้อมูลเรียบร้อยแล้ว' );    
            }
            else
            {
                return Redirect::to( 'admin/locations' )->with( 'error_message', 'ไม่สามารถเพิ่มข้อมูลได้ กรุณาแจ้งผู้ดูแลระบบ' );   
	        }
        }
    }

    /**
    * function name : post_search
    * search data location
    * post
    */
    public function post_search()
    {   
	   if ( Auth::check() )
		{			  
			$search  = Input::get( 'search' );	    		    			 

			$locationall = DB::table( 'n_location_work' )    
			 ->where( 'locationName', 'like', "%$search%" )    
	         ->orderBy( 'location_id', 'asc')
	         ->paginate( 10 );			    
	     
			//view page create
		    return View::make( 'locations.home',  array( 'locationall' => $locationall ) );	
		}	
		else
		{
			//return login
    		return View::make( 'users.index' );	
		}	
    }


    /**
    * function name : edit
    * edit data location
    * get
    */
    public function edit( $id ) 
    {
    	if ( Auth::check() )
    	{
    		$location = $this->_get_locationdata( $id );     

		    return View::make( 'locations.edit', array( 'location' => $location ) );
    	}
    	else
    	{
    		return View::make( 'users.index' );	
    	}      
    }

    /**
    * function name : post_edit_location
    * edit data location
    * post
    */
    public function post_edit_location( $id )
    { 	
    	//get user details
	    $locationName  = Input::get( 'locationName' );
	
	    $validator = Validator::make( Input::all(), Location::$rules, Location::$messages );
	    //check if the form is valid
	    if ( $validator->fails() )
	    {		
	        $messages = $validator->messages();			
			return Redirect::to( 'admin/locations/edit/'.$id )->withErrors( $validator );
	    }
	    else
	    {	 	        
            $location_data = array(
                'locationName' => $locationName	            	           
            );

	        //update user details
	        $result = DB::table( 'n_location_work' )->where( 'location_id', '=', $id )->update( $location_data );	        
	        if( $result )
	        {
	        	return Redirect::to( 'admin/locations' )->with( 'success_message', 'แก้ไขข้อมูลเรียบร้อยแล้ว' ); 
	        }
	        else
	        {
	        	return Redirect::to( 'admin/locations' )->with( 'error_message', 'ไม่สามารถแก้ไขข้อมูลได้ กรุณาแจ้งผู้ดูแลระบบ' ); 
	        }	       
	    }
    }

    /**
    * function name : _get_locationdata
    * get data location from id
    * 
    */
    private function _get_locationdata( $id ){
	    $location_data = DB::table( 'n_location_work' )	       
	        ->where( 'location_id', '=', $id )
	        ->first();
	    return $location_data;  
	}  

	 /**
    * function name : delete
    * edit data location
    * get
    */
    public function delete( $id ) 
    {
    	if ( Auth::check() )
    	{    		
            $result = Location::where( 'location_id', $id )->delete();

		   if( $result )
	        {
	        	return Redirect::to( 'admin/locations' )->with( 'success_message', 'ลบข้อมูลเรียบร้อยแล้ว' ); 
	        }
	        else
	        {
	        	return Redirect::to( 'admin/locations' )->with( 'error_message', 'ไม่สามารถลบข้อมูลได้ กรุณาแจ้งผู้ดูแลระบบ' ); 
	        }	   
    	}
    	else
    	{
    		return View::make( 'users.index' );	
    	}      
    }

}
