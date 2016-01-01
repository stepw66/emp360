<?php

/**
 * Create PositionController for emp360
 * version 1.0
 * create by ThemeSanasang
*/

class PositionController extends BaseController {
	

	public function home()
	{
		if ( Auth::check() )
		{
			$positionall = DB::table( 'n_position' )        
	         ->orderBy( 'position_id', 'asc')
	         ->paginate( 10 );	

			//view page create
		    return View::make( 'positions.home',  array( 'positionall' => $positionall ) );			    		 		
		}	
		else
		{
			//return login
    		return View::make( 'users.index' );	
		}				
	}

	
	/**
	 * function name : create
	 * view page create Position
	 * 
	 * get
	*/
    public function create()
    {
    	if ( Auth::check() )
    	{  		
	    	//view page create
	        return View::make( 'positions.create' );
    	}
    	else
    	{
    		//return login
    		return View::make( 'users.index' );	
    	}  	
    }

    /**
	 * function name : post_new_position
	 * reciep data post form create
	 * create new Position
	 * post
	*/
    public function post_new_position()
    {
    	//get Position details
	    $positionName  = Input::get( 'positionName' );	  
	  
        $validator = Validator::make( Input::all(),  Position::$rules, Position::$messages );
			  	    
	    //check if the form is valid
	    if ( $validator->fails() )
	    {			
	        $messages = $validator->messages();			
			return Redirect::to( 'admin/positions/create' )->withErrors( $validator );
	    }
	    else
	    {	    		    	         
			$position = DB::insert( 'insert into n_position (positionName) values (?)', array( $positionName ) );

            if( $position )
            {
            	return Redirect::to( 'admin/positions' )->with( 'success_message', 'เพิ่มตำแหน่งเรียบร้อยแล้ว' );    
            }
            else
            {
                return Redirect::to( 'admin/positions' )->with( 'error_message', 'ไม่สามารถเพิ่มข้อมูลตำแหน่งได้ กรุณาแจ้งผู้ดูแลระบบ' );   
	        }
        }
    }

    /**
    * function name : post_search
    * search data Position
    * post
    */
    public function post_search()
    {   
	   if ( Auth::check() )
		{			  
			$search  = Input::get( 'search' );	    		    			 

			$positionall = DB::table( 'n_position' )    
			 ->where( 'positionName', 'like', "%$search%" )    
	         ->orderBy( 'position_id', 'asc')
	         ->paginate( 10 );			    
	     
			//view page create
		    return View::make( 'positions.home',  array( 'positionall' => $positionall ) );	
		}	
		else
		{
			//return login
    		return View::make( 'users.index' );	
		}	
    }


    /**
    * function name : edit
    * edit data Position
    * get
    */
    public function edit( $id ) 
    {
    	if ( Auth::check() )
    	{
    		$position = $this->_get_positiondata( $id );     

		    return View::make( 'positions.edit', array( 'position' => $position ) );
    	}
    	else
    	{
    		return View::make( 'users.index' );	
    	}      
    }

    /**
    * function name : post_edit_position
    * edit data Position
    * post
    */
    public function post_edit_position( $id )
    { 	
    	//get user details
	    $positionName  = Input::get( 'positionName' );
	
	    $validator = Validator::make( Input::all(), Position::$rules, Position::$messages );
	    //check if the form is valid
	    if ( $validator->fails() )
	    {		
	        $messages = $validator->messages();			
			return Redirect::to( 'admin/positions/edit/'.$id )->withErrors( $validator );
	    }
	    else
	    {	 	        
            $position_data = array(
                'positionName' => $positionName	            	           
            );

	        //update user details
	        $result = DB::table( 'n_position' )->where( 'position_id', '=', $id )->update( $position_data );	        
	        if( $result )
	        {
	        	return Redirect::to( 'admin/positions' )->with( 'success_message', 'แก้ไขข้อมูลเรียบร้อยแล้ว' ); 
	        }
	        else
	        {
	        	return Redirect::to( 'admin/positions' )->with( 'error_message', 'ไม่สามารถแก้ไขข้อมูลได้ กรุณาแจ้งผู้ดูแลระบบ' ); 
	        }	       
	    }
    }

    /**
    * function name : _get_userdata
    * get data Position from id
    * 
    */
    private function _get_positiondata( $id ){
	    $position_data = DB::table( 'n_position' )	       
	        ->where( 'position_id', '=', $id )
	        ->first();
	    return $position_data;  
	}  

	 /**
    * function name : delete
    * edit data Position
    * get
    */
    public function delete( $id ) 
    {
    	if ( Auth::check() )
    	{    		
            $result = Position::where( 'position_id', $id )->delete();

		   if( $result )
	        {
	        	return Redirect::to( 'admin/positions' )->with( 'success_message', 'ลบข้อมูลเรียบร้อยแล้ว' ); 
	        }
	        else
	        {
	        	return Redirect::to( 'admin/positions' )->with( 'error_message', 'ไม่สามารถลบข้อมูลได้ กรุณาแจ้งผู้ดูแลระบบ' ); 
	        }	   
    	}
    	else
    	{
    		return View::make( 'users.index' );	
    	}      
    }

}
