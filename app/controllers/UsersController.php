<?php

/**
 * Create UsersController for emp360
 * version 1.0
 * create by ThemeSanasang
*/

class UsersController extends BaseController {
	


	public function home()
	{
		if ( Auth::check() )
		{
			$userall = DB::table( 'users' )
	         ->join( 'n_position', 'users.position', '=', 'n_position.position_id' )
	         ->join( 'n_useractive', 'users.active', '=', 'n_useractive.activeID' )
	         ->orderBy( 'users.id', 'asc')
	         ->paginate( 10 );	


			//view page create
		    return View::make( 'users.home',  array( 'userall' => $userall ) );			    		 
			
		}	
		else
		{
			//return login
    		return View::make( 'users.index' );	
		}				
	}

	

	/**
	 * function name : create
	 * view page create user
	 * add data to select option
	 * get
	*/
    public function create()
    {
    	if ( Auth::check() )
    	{
    		//get data to select
	    	$this->pname     = DB::table( 'n_pname' )->get();
	    	$this->position  = DB::table( 'n_position' )->get();
	    	$this->active    = DB::table( 'n_useractive' )->get();   	

	    	//view page create
	        return View::make('users.create', 
	        array(
	            'pname'     => $this->pname, 
	            'position'  => $this->position,
	            'active'    => $this->active            
	        ));
    	}
    	else
    	{
    		//return login
    		return View::make( 'users.index' );	
    	}  	
    }

    /**
	 * function name : post_new_user
	 * reciep data post form create
	 * create new user
	 * post
	*/
    public function post_new_user()
    {
    	//get user details
	    $username  		= Input::get( 'username' );
	    $password 		= Input::get( 'password' );
	    $pname  		= Input::get( 'pname' );
	    $fname 			= Input::get( 'fname' );
	    $lname      	= Input::get( 'lname' );
	    $cid      	= Input::get( 'cid' );
	    $position   	= Input::get( 'position' );
	    $active  		= Input::get( 'active' );
	    $remember_token = Input::get( '_token' );
			  
	    $validator = Validator::make( Input::all(), User::$rules, User::$messages );
	    //check if the form is valid
	    if ( $validator->fails() )
	    {			
	        $messages = $validator->messages();			
			return Redirect::to( 'admin/users/create' )->withErrors( $validator );
	    }
	    else
	    {
	    	$password = Hash::make( $password ); //hash the password

	    	$user_data = array(
	            'username' 		 => $username,
	            'password' 		 => $password,
	            'pname' 		 => $pname,
	            'fname' 		 => $fname,
	            'lname' 		 => $lname,
	            'cid' 		 	 => $cid,
	            'position' 		 => $position,
	            'active'		 => $active,
	            'remember_token' => $remember_token 
            );
           
	    	//create new user
            $users = User::create( $user_data );
            if( $users )
            {
            	return Redirect::to( 'admin/users' )->with( 'success_message', 'เพิ่มผู้ใช้งานเรียบร้อยแล้ว' );    
            }
            else
            {
                return Redirect::to( 'admin/users' )->with( 'error_message', 'ไม่สามารถเพิ่มข้อมูลผู้ใช้งานได้ กรุณาแจ้งผู้ดูแลระบบ' );   
	        }
        }
    }

    /**
    * function name : post_search
    * search data users
    * post
    */
    public function post_search()
    {   		  
	   if ( Auth::check() )
		{
			$search  = Input::get( 'search' );	    		    

			$userall = DB::table( 'users' )
	         ->join( 'n_position', 'users.position', '=', 'n_position.position_id' )
	         ->join( 'n_useractive', 'users.active', '=', 'n_useractive.activeID' )
	         ->where( 'users.username', 'like', "%$search%" )
	         ->orWhere( 'users.fname', 'like', "%$search%" )
	         ->orWhere( 'users.lname', 'like', "%$search%" )
	         ->orWhere( 'n_useractive.activeName', 'like', "%$search%" )
	         ->orderBy( 'users.id', 'asc')
	         ->paginate( 10 );	 		    
	     
			//view page create
		    return View::make( 'users.home',  array( 'userall' => $userall ) );	
		}	
		else
		{
			//return login
    		return View::make( 'users.index' );	
		}	
    }


    /**
    * function name : edit
    * edit data users
    * get
    */
    public function edit( $id ) 
    {
    	if ( Auth::check() )
    	{
    		$user = $this->_get_userdata( $id );
	        $this->pname     = DB::table( 'n_pname' )->get();
	    	$this->position  = DB::table( 'n_position' )->get();
	    	$this->active    = DB::table( 'n_useractive' )->get();

		    return View::make(
		        'users.edit', 
		        array(
		            'user'      => $user,	          
		            'position'  => $this->position,
		            'active'    => $this->active              
		            )
		    );
    	}
    	else
    	{
    		return View::make( 'users.index' );	
    	}      
    }

    /**
    * function name : post_edit_user
    * edit data users
    * post
    */
    public function post_edit_user( $id )
    {
    	//get user details
	    $username  		= Input::get( 'username' );
	    $password 		= Input::get( 'password' );
	    $pname  		= Input::get( 'pname' );
	    $fname 			= Input::get( 'fname' );
	    $lname      	= Input::get( 'lname' );
	    $cid      		= Input::get( 'cid' );
	    $position   	= Input::get( 'position' );
	    $active  		= Input::get( 'active' );
	    $remember_token = Input::get( '_token' );

	    $validator = Validator::make( Input::all(), User::$rules, User::$messages );
	    //check if the form is valid
	    if ( $validator->fails() )
	    {			
	        $messages = $validator->messages();			
			return Redirect::to( 'admin/users/edit/'.$id )->withErrors( $validator );
	    }
	    else
	    {
	    	$user = $this->_get_userdata( $id );

	    	if( !empty( $password ) )
	    	{ 
	    		if( $user->password !=  $password )
	    		{
					$password = Hash::make( $password );
	    		}	    		
	           
	            $user_data = array(
	                'username' 		 => $username,
		            'password' 		 => $password,		            
		            'fname' 		 => $fname,
		            'lname' 		 => $lname,
		            'cid' 		 	 => $cid,
		            'position' 		 => $position,
		            'active'		 => $active		           
	            );
	        }
	        else
	        { 
	            $user_data = array(
	                'username' 		 => $username,		           		            
		            'fname' 		 => $fname,
		            'lname' 		 => $lname,
		            'cid' 		 	 => $cid,
		            'position' 		 => $position,
		            'active'		 => $active		            
	            );  
	        }

	        //update user details
	        $result = DB::table( 'users' )->where( 'id', '=', $id )->update( $user_data );	        
	        if( $result )
	        {
	        	return Redirect::to( 'admin/users' )->with( 'success_message', 'แก้ไขข้อมูลเรียบร้อยแล้ว' ); 
	        }
	        else
	        {
	        	return Redirect::to( 'admin/users' )->with( 'error_message', 'ไม่สามารถแก้ไขข้อมูลได้ กรุณาแจ้งผู้ดูแลระบบ' ); 
	        }	       
	    }
    }

    /**
    * function name : _get_userdata
    * get data users from id
    * 
    */
    private function _get_userdata( $id ){
	    $user_data = DB::table( 'users' )
	        ->join( 'n_position', 'users.position', '=', 'n_position.position_id' )
	        ->join( 'n_useractive', 'users.active', '=', 'n_useractive.activeID' )
	        ->where( 'users.id', '=', $id )
	        ->first();
	    return $user_data;  
	}  

    /**
	 * function name : showLogin
	 * view page login
	 * 
	*/
	public function showLogin()
	{
		if ( Auth::check() )
        {
            // Redirect to homepage
            return Redirect::to( 'admin/home' );
        }
		return View::make( 'users.index' );		
	}

	/**
	 * function name : doLogin
	 * check login system
	 * add session data
	 * post
	*/
	public function doLogin()
	{		
		// validate the info, create rules for the inputs
		$rules = array(
			'username'    => 'required', 
			'password'    => 'required' 
		);

		$messages = array(
			'username.required'    => '*** กรุณากรอกชื่อผู้ใช้ ***', 
			'password.required'    => '*** กรุณากรอกรหัสผ่าน ***' 
		);

		$validator = Validator::make( Input::all(), $rules, $messages );
		
		// if the validator fails, redirect back to the form
		if ( $validator->fails() ) {
			return Redirect::to( '/' )->withErrors( $validator );
		}
		else 
		{
			// create our user data for the authentication
			$userdata = array(
				'username' 	=> Input::get( 'username' ),
				'password' 	=> Input::get( 'password' ),
				'active'    => 'Y'				
			);
						
			// attempt to do the login
			if ( Auth::attempt( $userdata ) ) 
			{	
				$user_id = Auth::user()->id;
				$user = DB::table( 'users' )->where( 'id', '=', $user_id )->first();
				
				//save user details into session
				Session::put( 'userid', $user->id );
	            Session::put( 'username', $user->username );
	            Session::put( 'password', $user->password );
	            Session::put( 'pname', $user->pname );
	            Session::put( 'fname', $user->fname );	
	            Session::put( 'lname', $user->lname );	
	            Session::put( 'cid', $user->cid );

				return Redirect::to( 'admin/home' );	
			}			
			else
			{	 	
				// validation not successful, send back to form					 
				return Redirect::to( '/' )->with( 'error_message', 'ชื่อผู้ใช้งานหรือหรัสผ่านผิด กรุณาลองใหม่อีกครั้ง' );  					   
			}
		}
	}

	/**
	 * function name : dologout
	 * logout system
	 * clear session data
	*/
	public function dologout()
	{
	 	Auth::logout(); //logout the current user
 		Session::flush(); //delete the session
		return Redirect::to( '/' ); // redirect the user to the login screen
	}

}
