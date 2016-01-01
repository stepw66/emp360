<?php

/**
 * Create DepartmentController for emp360
 * version 1.0
 * create by ThemeSanasang
*/

class DepartmentController extends BaseController {
	

	public function home()
	{
		if ( Auth::check() )
		{
			$departmentall = DB::table( 'n_department' )        
	         ->orderBy( 'department_id', 'asc')
	         ->paginate( 10 );	

			//view page create
		    return View::make( 'departments.home',  array( 'departmentall' => $departmentall ) );			    		 
			
		}	
		else
		{
			//return login
    		return View::make( 'users.index' );	
		}				
	}

	
	/**
	 * function name : create
	 * view page create Department
	 * add data to select option
	 * get
	*/
    public function create()
    {
    	if ( Auth::check() )
    	{  		
	    	//view page create
	        return View::make( 'departments.create' );
    	}
    	else
    	{
    		//return login
    		return View::make( 'users.index' );	
    	}  	
    }

    /**
	 * function name : post_new_department
	 * reciep data post form create
	 * create new Department
	 * post
	*/
    public function post_new_department()
    {
    	//get Department details
	    $departmentName  = Input::get( 'departmentName' );	  
	  
        $validator = Validator::make( Input::all(),  Department::$rules, Department::$messages );
			  	    
	    //check if the form is valid
	    if ( $validator->fails() )
	    {			
	        $messages = $validator->messages();			
			return Redirect::to( 'admin/departments/create' )->withErrors( $validator );
	    }
	    else
	    {	    		    	         
			$department = DB::insert('insert into n_department (departmentName) values (?)', array($departmentName));

            if( $department )
            {
            	return Redirect::to( 'admin/departments' )->with( 'success_message', 'เพิ่มแผนกเรียบร้อยแล้ว' );    
            }
            else
            {
                return Redirect::to( 'admin/departments' )->with( 'error_message', 'ไม่สามารถเพิ่มข้อมูลแผนกได้ กรุณาแจ้งผู้ดูแลระบบ' );   
	        }
        }
    }

    /**
    * function name : post_search
    * search data Department
    * post
    */
    public function post_search()
    {   
	   if ( Auth::check() )
		{			  
			$search  = Input::get( 'search' );	    		    			 

			$departmentall = DB::table( 'n_department' )    
			 ->where( 'departmentName', 'like', "%$search%" )    
	         ->orderBy( 'department_id', 'asc')
	         ->paginate( 10 );			    
	     
			//view page create
		    return View::make( 'departments.home',  array( 'departmentall' => $departmentall ) );	
		}	
		else
		{
			//return login
    		return View::make( 'users.index' );	
		}	
    }


    /**
    * function name : edit
    * edit data Department
    * get
    */
    public function edit( $id ) 
    {
    	if ( Auth::check() )
    	{
    		$department = $this->_get_departmentdata( $id );     

		    return View::make( 'departments.edit', array( 'department' => $department ) );
    	}
    	else
    	{
    		return View::make( 'users.index' );	
    	}      
    }

    /**
    * function name : post_edit_Department
    * edit data Department
    * post
    */
    public function post_edit_department( $id )
    { 	
    	//get user details
	    $departmentName  = Input::get( 'departmentName' );
	
	    $validator = Validator::make( Input::all(), Department::$rules, Department::$messages );
	    //check if the form is valid
	    if ( $validator->fails() )
	    {		
	        $messages = $validator->messages();			
			return Redirect::to( 'admin/departments/edit/'.$id )->withErrors( $validator );
	    }
	    else
	    {	 	        
            $department_data = array(
                'departmentName' => $departmentName	            	           
            );

	        //update user details
	        $result = DB::table( 'n_department' )->where( 'department_id', '=', $id )->update( $department_data );	        
	        if( $result )
	        {
	        	return Redirect::to( 'admin/departments' )->with( 'success_message', 'แก้ไขข้อมูลเรียบร้อยแล้ว' ); 
	        }
	        else
	        {
	        	return Redirect::to( 'admin/departments' )->with( 'error_message', 'ไม่สามารถแก้ไขข้อมูลได้ กรุณาแจ้งผู้ดูแลระบบ' ); 
	        }	       
	    }
    }

    /**
    * function name : _get_userdata
    * get data Department from id
    * 
    */
    private function _get_departmentdata( $id ){
	    $department_data = DB::table( 'n_department' )	       
	        ->where( 'department_id', '=', $id )
	        ->first();
	    return $department_data;  
	}  

	 /**
    * function name : delete
    * edit data Department
    * get
    */
    public function delete( $id ) 
    {
    	if ( Auth::check() )
    	{    		
            $result = Department::where( 'department_id', $id )->delete();

		   if( $result )
	        {
	        	return Redirect::to( 'admin/departments' )->with( 'success_message', 'ลบข้อมูลเรียบร้อยแล้ว' ); 
	        }
	        else
	        {
	        	return Redirect::to( 'admin/departments' )->with( 'error_message', 'ไม่สามารถลบข้อมูลได้ กรุณาแจ้งผู้ดูแลระบบ' ); 
	        }	   
    	}
    	else
    	{
    		return View::make( 'users.index' );	
    	}      
    }
	
	 /**
    * function name : header_dep
    * view header_dep
    * get
    */
	public function header_dep()
	{
		if ( Auth::check() )
		{						 
			$department = DB::table('n_department')->get(array( DB::raw('departmentName as value') ) );  		

			foreach ($department as $k2 => $v2) {		       
				$return_department[] = $v2;    
		    }
			
			$dataUser = DB::table('n_datageneral')->get(array( DB::raw('CONCAT(pname,"",fname, " ", lname) as value') ) );  		

			foreach ($dataUser as $k2 => $v2) {		       
				$return_dataUser[] = $v2;    
		    }	
			
			$header_data = DB::Select( 'select * from n_department_header order by departmentName' );	

			//view page create
		    return View::make( 'header_dep.home_header',  array( 'departmentall' => $return_department, 'dataUser' => $return_dataUser, 'header_data' => $header_data  ) );			
		}	
		else
		{
			//return login
    		return View::make( 'users.index' );	
		}				
	}
	
	 /**
    * function name : header_dep_create
    * create header department
    * get
    */
	public function header_dep_create()
	{
		//get Department details
	    $dep_Name  = Input::get( 'dep_Name' );	
		$header_Name  = Input::get( 'header_Name' );	
		
		if( $dep_Name != '' && $header_Name != '' )
		{
			$cid = DB::table( 'n_datageneral' )	       
						->where( DB::raw('CONCAT(pname,"",fname, " ", lname)'), '=', $header_Name )
						->first();
									         		    	         
			$header = DB::insert('insert into n_department_header (departmentName, cid, header_name) values (?, ?, ?)', array($dep_Name, $cid->cid, $header_Name));
			
			$department = DB::table('n_department')->get(array( DB::raw('departmentName as value') ) );  		

			foreach ($department as $k2 => $v2) {		       
				$return_department[] = $v2;    
		    }
			
			$dataUser = DB::table('n_datageneral')->get(array( DB::raw('CONCAT(pname,"",fname, " ", lname) as value') ) );  		

			foreach ($dataUser as $k2 => $v2) {		       
				$return_dataUser[] = $v2;    
		    }	  
			
			$header_data = DB::Select( 'select * from n_department_header order by departmentName' );    

			//view page create
		    return View::make( 'header_dep.home_header',  array( 'departmentall' => $return_department, 'dataUser' => $return_dataUser, 'header_data' => $header_data ) );	
		}
		else
		{
			return Redirect::to( 'admin/header_dep' );   
		}      
	}
	
	public function header_dep_delete( $cid )
	{		
		$result =  DB::table('n_department_header')->where('cid', '=', $cid )->delete();
		
		return Redirect::to( 'admin/header_dep' );
	}


}
