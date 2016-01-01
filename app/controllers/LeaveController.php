<?php

/**
 * Create LeaveController for emp360
 * version 1.0
 * create by ThemeSanasang
*/

class LeaveController extends BaseController {
	

	public function home()
	{
		if ( Auth::check() )
		{
			$leaveall = DB::table( 'n_leave_type' )        
	         ->orderBy( 'leave_type_id', 'asc')
	         ->paginate( 10 );	

			//view page create
		    return View::make( 'leaves.home',  array( 'leaveall' => $leaveall ) );			    		 		
		}	
		else
		{
			//return login
    		return View::make( 'users.index' );	
		}				
	}

	
	/**
	 * function name : create
	 * view page create Leave
	 * 
	 * get
	*/
    public function create()
    {
    	if ( Auth::check() )
    	{  		
	    	//view page create
	        return View::make( 'leaves.create' );
    	}
    	else
    	{
    		//return login
    		return View::make( 'users.index' );	
    	}  	
    }

    /**
	 * function name : post_new_leave
	 * reciep data post form create
	 * create new Leave
	 * post
	*/
    public function post_new_leave()
    {
    	//get Position details
	    $leave_type_name  = Input::get( 'leave_type_name' );	  
	  
        $validator = Validator::make( Input::all(),  Leave::$rules, Leave::$messages );
			  	    
	    //check if the form is valid
	    if ( $validator->fails() )
	    {			
	        $messages = $validator->messages();			
			return Redirect::to( 'admin/leaves/create' )->withErrors( $validator );
	    }
	    else
	    {	    		    	         
			$leave = DB::insert( 'insert into n_leave_type (leave_type_name) values (?)', array( $leave_type_name ) );

            if( $leave )
            {
            	return Redirect::to( 'admin/leaves' )->with( 'success_message', 'เพิ่มประเภทการลาเรียบร้อยแล้ว' );    
            }
            else
            {
                return Redirect::to( 'admin/leaves' )->with( 'error_message', 'ไม่สามารถเพิ่มข้อมูลประเภทการลาได้ กรุณาแจ้งผู้ดูแลระบบ' );   
	        }
        }
    }

    /**
    * function name : post_search
    * search data Leave
    * post
    */
    public function post_search()
    {   
	   if ( Auth::check() )
		{			  
			$search  = Input::get( 'search' );	    		    			 

			$leaveall = DB::table( 'n_leave_type' )    
			 ->where( 'leave_type_name', 'like', "%$search%" )    
	         ->orderBy( 'leave_type_id', 'asc')
	         ->paginate( 10 );			    
	     
			//view page create
		    return View::make( 'leaves.home',  array( 'leaveall' => $leaveall ) );	
		}	
		else
		{
			//return login
    		return View::make( 'users.index' );	
		}	
    }


    /**
    * function name : edit
    * edit data Leave
    * get
    */
    public function edit( $id ) 
    {
    	if ( Auth::check() )
    	{
    		$leave = $this->_get_leavedata( $id );     

		    return View::make( 'leaves.edit', array( 'leave' => $leave ) );
    	}
    	else
    	{
    		return View::make( 'users.index' );	
    	}      
    }

    /**
    * function name : post_edit_leave
    * edit data Leave
    * post
    */
    public function post_edit_leave( $id )
    { 	
    	//get user details
	    $leave_type_name  = Input::get( 'leave_type_name' );
	
	    $validator = Validator::make( Input::all(), Leave::$rules, Leave::$messages );
	    //check if the form is valid
	    if ( $validator->fails() )
	    {		
	        $messages = $validator->messages();			
			return Redirect::to( 'admin/leaves/edit/'.$id )->withErrors( $validator );
	    }
	    else
	    {	 	        
            $leave_data = array(
                'leave_type_name' => $leave_type_name	            	           
            );

	        //update leave details
	        $result = DB::table( 'n_leave_type' )->where( 'leave_type_id', '=', $id )->update( $leave_data );	        
	        if( $result )
	        {
	        	return Redirect::to( 'admin/leaves' )->with( 'success_message', 'แก้ไขข้อมูลเรียบร้อยแล้ว' ); 
	        }
	        else
	        {
	        	return Redirect::to( 'admin/leaves' )->with( 'error_message', 'ไม่สามารถแก้ไขข้อมูลได้ กรุณาแจ้งผู้ดูแลระบบ' ); 
	        }	       
	    }
    }

    /**
    * function name : _get_leavedata
    * get data Leave from id
    * 
    */
    private function _get_leavedata( $id ){
	    $leave_data = DB::table( 'n_leave_type' )	       
	        ->where( 'leave_type_id', '=', $id )
	        ->first();
	    return $leave_data;  
	}  

	 /**
    * function name : delete
    * edit data Leave
    * get
    */
    public function delete( $id ) 
    {
    	if ( Auth::check() )
    	{    		
            $result = Leave::where( 'leave_type_id', $id )->delete();

		   if( $result )
	        {
	        	return Redirect::to( 'admin/leaves' )->with( 'success_message', 'ลบข้อมูลเรียบร้อยแล้ว' ); 
	        }
	        else
	        {
	        	return Redirect::to( 'admin/leaves' )->with( 'error_message', 'ไม่สามารถลบข้อมูลได้ กรุณาแจ้งผู้ดูแลระบบ' ); 
	        }	   
    	}
    	else
    	{
    		return View::make( 'users.index' );	
    	}      
    }

}
