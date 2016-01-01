<?php

/**
 * Create EmpController for emp360
 * version 1.0
 * create by ThemeSanasang
*/

class EmpController extends BaseController {

	/**
	 * function name : home
	 * view page create Emp
	 * list name emp
	 * get
	*/
	public function home()
	{
		if ( Auth::check() )
		{
			$empall = DB::table( 'n_datageneral' )        
	         ->orderBy( 'datainfoID', 'asc')
	         ->paginate( 20 );	

	         //clear session one
	        Session::forget('empcid');
	        Session::forget('emppname');
	        Session::forget('empfname');
	        Session::forget('emplname'); 
	        Session::forget('position_nth');	        
			
		    return View::make( 'emps.home',  array( 'empall' => $empall ) );							    		 		
		}	
		else
		{
			//return login
    		return View::make( 'users.index' );	
		}				
	}

	/**
	 * function name : home_list
	 * view page Emp-list
	 * list name emp
	 * get
	*/
	public function home_list( $id )
	{
		if ( Auth::check() )
		{
			Session::put( 'position_nth', $id );

			$empall = DB::table( 'n_datageneral' )  
			 ->join( 'n_position_salary', 'n_position_salary.cid', '=', 'n_datageneral.cid' ) 
			 ->where( 'n_position_salary.level', '=', $id )  
             ->groupBy( 'n_datageneral.cid' )
	         ->orderBy( 'datainfoID', 'asc')
	         ->paginate( 20 );	

	        Session::forget('empcid');
	        Session::forget('emppname');
	        Session::forget('empfname');
	        Session::forget('emplname'); 	        
			
		    return View::make( 'emps.home',  array( 'empall' => $empall ) );							    		 		
		}	
		else
		{
			//return login
    		return View::make( 'users.index' );	
		}				
	}

	 /**
    * function name : post_search
    * search data Emp
    * post
    */
    public function post_search()
    {   
	   if ( Auth::check() )
		{			  
			$search  = Input::get( 'search' );	    		    			 

			$empall = DB::table( 'n_datageneral' )    
			 ->where( 'fname', 'like', "%$search%" )  
			 ->orWhere( 'lname', 'like', "%$search%" )
			 ->orWhere( 'cid', 'like', "%$search%" )
			 ->orWhere( 'mobile', 'like', "%$search%" )			   
	         ->orderBy( 'datainfoID', 'asc')
	         ->paginate( 10 );			    
	     
			//view page create
		    return View::make( 'emps.home',  array( 'empall' => $empall ) );	
		}	
		else
		{
			//return login
    		return View::make( 'users.index' );	
		}	
    }

	 /**
    * function name : _get_emp
    * get data Emp from id
    * 
    */
    private function _get_empdata( $id )
    {
	    $emp_data = DB::table( 'n_datageneral' )	       
	        ->where( 'cid', '=', $id )
	        ->first();
	    return $emp_data;  
	}  

	/**
	 * function name : create
	 * view page create Emp
	 * add data to select option
	 * add create 1,2,3,4
	 * get
	*/
    public function create( $id=null )
    {       	
    	if ( Auth::check() )
    	{  	  
    		$this->pname     = DB::table( 'n_pname' )->get();
    		$p 				 = DB::table( 'n_position' )->get();
    		$d 				 = DB::table( 'n_location_work' )->get();
    		$lt              = DB::table( 'n_leave_type' )->get();		            

	        if( !empty($id) )
	        {	        	
	        	$emp = $this->_get_empdata( $id );     
		    	return View::make( 'emps.create', 
		    		   array( 
		    		   		'emp' 				=> $emp,
		    		   		'pname' 			=> $this->pname,
		    		   		'position' 			=> $p,
		    		   		'location' 			=> $d,
		    		   		'leave_type' 		=> $lt		    		   		  
		    		   ) );
	        }
	        else
	        {	        	
		    	//view page create
		        return View::make( 'emps.create',	        
		        array(
		            'pname' 	=> $this->pname,
		            'position' 	=> $p,
		    		'location' 	=> $d,
		    		'leave_type' => $lt   
		        ));
	        }	       
    	}
    	else
    	{
    		//return login
    		return View::make( 'users.index' );	
    	} 	
    }


    
    /**
	 * function name : post_new_emp
	 * reciep data post form create
	 * create new Emp
	 * post
	*/
    public function post_new_emp()
    {   
    	$date_birthday =  explode( "-", Input::get( 'birthday' ) );	   	

    	//get Emp details
	    $numlocation  	= Input::get( 'numlocation' );	
	    $pname  		= Input::get( 'pname' );
	    $fname  		= Input::get( 'fname' );
	    $lname  		= Input::get( 'lname' );

	    if( Input::get( 'birthday' ) != '' ){
	    	$birthday  		= ($date_birthday[2]-543).'-'.$date_birthday[1].'-'.$date_birthday[0];
		}
		
	    $cid  			= Input::get( 'cid' );
	    $address 		= Input::get( 'address' );
	    $tmbpart  		= Input::get( 'tmbpart' );
	    $amppart  		= Input::get( 'amppart' );
	    $chwpart  		= Input::get( 'chwpart' );
	    $zipcode  		= Input::get( 'zipcode' );
	    $tel  			= Input::get( 'tel' );
	    $mobile  		= Input::get( 'mobile' );
	    $email  		= Input::get( 'email' );
	    $picture  		= Input::file('picture');
	    $dt 			= new DateTime();
	    $lastupdate  	=  $dt->format('Y-m-d H:i:s');
        $status         = Input::get( 'status_work' );
	  
        $validator = Validator::make( Input::all(),  Emp::$rules, Emp::$messages );
		
	    //check if the form is valid
	    if ( $validator->fails() )
	    {			
	        $messages = $validator->messages();			
			return Redirect::to( 'admin/emps/create' )->withErrors( $validator );
	    }
	    else
	    {	
	    	if( !empty($picture) )
	    	{
	    		$destinationPath = 'uploads/'. $cid;
				$filename = Input::file('picture')->getClientOriginalName();		
				$uploadSuccess = Input::file('picture')->move($destinationPath, $filename);
	    	}
	    	else
	    	{
	    		$filename = '';
	    	}	    		    	

			$emp = DB::insert( 'insert into n_datageneral ( numlocation, pname, fname, lname, birthday, cid, address, tmbpart, amppart, chwpart, zipcode, tel, mobile, email, picture, lastupdate, status  ) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', 
				  array( $numlocation,
				  		$pname,
				  		$fname,
				  		$lname,
				  		$birthday,
				  		$cid,
				  		$address,
				  		$tmbpart,
				  		$amppart,
				  		$chwpart,
				  		$zipcode,
				  		$tel,
				  		$mobile,
				  		$email,
				  		$filename,
				  		$lastupdate,
                        $status
				  ) );

            if( $emp )
            {            	
            	Session::put( 'empcid', $cid );	           
	            Session::put( 'emppname', $pname );
	            Session::put( 'empfname', $fname );	
	            Session::put( 'emplname', $lname );			                   

				return Redirect::to( 'admin/emps/create/'.$cid );  				       	           	
            }
            else
            {           	
                return Redirect::to( 'admin/emps' )->with( 'error_message', 'ไม่สามารถเพิ่มข้อมูลได้ กรุณาแจ้งผู้ดูแลระบบ' );   
	        }
        }
    }

    /**
	 * function name : edit
	 * reciep data post form edit
	 * create new Emp
	 * get
	*/
    public function edit( $id )
    {
    	if ( Auth::check() )
    	{  	  
    		$this->pname     = DB::table( 'n_pname' )->get();	       	        	
        	$emp 			 = $this->_get_empdata( $id );  
        	$p 				 = DB::table( 'n_position' )->get();
    		$d 				 = DB::table( 'n_location_work' )->get();
    		$lt              = DB::table( 'n_leave_type' )->get();

        	$datawork   = DB::table( 'n_datawork' )->where( 'cid', $id )->get();	
        	$datastudy  = DB::table( 'n_datastudy' )->where( 'cid', $id )->get();
        	$datasalary = DB::table( 'n_position_salary' )
				         ->join( 'n_position', 'n_position_salary.position_id', '=', 'n_position.position_id' )
				         ->join( 'n_location_work', 'n_position_salary.location_id', '=', 'n_location_work.location_id' )
				         ->where( 'n_position_salary.cid', '=', $id )->get();	
			$dataleave = DB::table( 'n_dataleave' )
				         ->join( 'n_leave_type', 'n_dataleave.leave_type_id', '=', 'n_leave_type.leave_type_id' )				       
				         ->where( 'n_dataleave.cid', '=', $id )->get();


	    	return View::make( 'emps.create', 
	    		   array( 
	    		   		'emp' 			=> $emp,
	    		   		'pname' 		=> $this->pname,
	    		   		'position' 		=> $p,
		    			'location' 		=> $d, 
		    			'leave_type'    => $lt, 
	    		   		'datawork'		=> $datawork,
	    		   		'datastudy'		=> $datastudy,
	    		   		'datasalary' 	=> $datasalary,
	    		   		'dataleave'     => $dataleave
	    			) );             
    	}
    	else
    	{
    		//return login
    		return View::make( 'users.index' );	
    	}  	
    }

    /**
	 * function name : post_edit_emp
	 * reciep data post form edit
	 * create new Emp
	 * post
	*/
    public function post_edit_emp( $id )
    {    
    	$date_birthday =  explode( "-",Input::get( 'birthday' ) );

    	//get Emp details
	    $numlocation  	= Input::get( 'numlocation' );	
	    $pname  		= Input::get( 'pname' );
	    $fname  		= Input::get( 'fname' );
	    $lname  		= Input::get( 'lname' );
	    $birthday  		= ($date_birthday[2]-543).'-'.$date_birthday[1].'-'.$date_birthday[0];
	    $cid  			= Input::get( 'cid' );
	    $address 		= Input::get( 'address' );
	    $tmbpart  		= Input::get( 'tmbpart' );
	    $amppart  		= Input::get( 'amppart' );
	    $chwpart  		= Input::get( 'chwpart' );
	    $zipcode  		= Input::get( 'zipcode' );
	    $tel  			= Input::get( 'tel' );
	    $mobile  		= Input::get( 'mobile' );
	    $email  		= Input::get( 'email' );
	    $picture  		= Input::file('picture');
	    $dt 			= new DateTime();
	    $lastupdate  	=  $dt->format( 'Y-m-d H:i:s' );
	    $nameimghid  	=  Input::get( 'nameimghid' );
        $status         = Input::get( 'status_work' );
	  
        $validator = Validator::make( Input::all(),  Emp::$rules, Emp::$messages );
		
	    //check if the form is valid
	    if ( $validator->fails() )
	    {			
	        $messages = $validator->messages();			
			return Redirect::to( 'admin/emps/create/'.$id )->withErrors( $validator );
	    }
	    else
	    {	
	    	if( !empty($picture) )
	    	{
	    		$destinationPath = 'uploads/'. $cid;
				$filename = Input::file('picture')->getClientOriginalName();		
				$uploadSuccess = Input::file('picture')->move($destinationPath, $filename);
	    	}
	    	else
	    	{
	    		if( $nameimghid != '' )
	    		{
	    			$filename = $nameimghid;
	    		}
	    		else
	    		{
	    			$filename = '';
	    		}
	    	}	

	    	$emp_data = array(
	                'numlocation' 	 => $numlocation,		           		            
		            'pname' 		 => $pname,
		            'fname' 		 => $fname,
		            'lname' 		 => $lname,
		            'birthday'		 => $birthday,	
		            'cid' 		 	 => $cid,		           		            
		            'address' 		 => $address,
		            'tmbpart' 		 => $tmbpart,
		            'amppart' 		 => $amppart,
		            'chwpart'		 => $chwpart,
		            'zipcode' 		 => $zipcode,		           		            
		            'tel' 		 	 => $tel,
		            'mobile' 		 => $mobile,
		            'email' 		 => $email,
		            'picture'		 => $filename,
		            'lastupdate'	 => $lastupdate,
                    'status'	     => $status	
	            );  

	    	

	        $result = DB::table( 'n_datageneral' )->where( 'cid', '=', $id )->update( $emp_data );	       		    				

            if( $result )
            {            	
            	Session::put( 'empcid', $cid );	           
	            Session::put( 'emppname', $pname );
	            Session::put( 'empfname', $fname );	
	            Session::put( 'emplname', $lname );		            

            	return Redirect::to( 'admin/emps/create/'.$cid );   
            }
            else
            {           	
                return Redirect::to( 'admin/emps' )->with( 'error_message', 'ไม่สามารถแก้ไขข้อมูลได้ กรุณาแจ้งผู้ดูแลระบบ' );   
	        }
        }
    }

    /**
	 * function name : post_new_work
	 * reciep data post form 
	 * create new datawork
	 * post
	*/
    public function post_new_work()
    {
    	//data form ajax
    	$inputData = Input::get('formData');
	    parse_str($inputData, $formFields);  

	    $appointed_date = explode( "-", $formFields['appointed_date'] );
	    $retirecd_date  = explode( "-", $formFields['retirecd_date'] );

	    $Data = array(
	      'cid'      		=> $formFields['cidwork'],	
	      'numlocation'		=> $formFields['numlocation'],
	      'appointed_date'	=> ($appointed_date[2]-543).'-'.$appointed_date[1].'-'.$appointed_date[0],  
	      'working_period'	=> $formFields['working_period'],
	      'retirecd_date'	=> ($retirecd_date[2]-543).'-'.$retirecd_date[1].'-'.$retirecd_date[0],
	      'position'		=> $formFields['position'],
	      'current_salary'	=> $formFields['current_salary'],
	      'location'		=> $formFields['location']  
	    );
	 
	    $rules = array(
        'working_period'    =>  'required',
        'position'     		=>  'required',
        'current_salary' 	=>  'required'
	    );

	    $messages = array(
	    'working_period.required' => '** กรุณากรอกเวลารวมทำงาน **' , 
	    'position.required' => '** กรุณากรอกตำแหน่งงาน **',  
	    'current_salary.required' => '** กรุณากรอกเงินเดือนล่าสุด **'  
	    ); 

	    $validator = Validator::make( $Data, $rules, $messages );
		
	    //check if the form is valid
	    if ( $validator->fails() )
	    {			
	       return Response::json(array(
            'fail' => true,
            'errors' => $validator->getMessageBag()->toArray()
           ));
	    }
	    else
	    {
	    	$emp = DB::insert( 'insert into n_datawork ( cid, numlocation, appointed_date, working_period, retirecd_date, position, current_salary, location ) values (?,?,?,?,?,?,?,?)', 
				  array( 
				  	    $Data['cid'],
				  	    $Data['numlocation'],
				  		$Data['appointed_date'],
				  		$Data['working_period'],
				  		$Data['retirecd_date'],
				  		$Data['position'],
				  		$Data['current_salary'],
				  		$Data['location']				  						  		
				  ) );

	    	if( $emp )
	    	{	 

		    	$datawork = DB::table('n_datawork')->where('cid', $Data['cid'])->get();				

				$w = '<table  class="uk-table uk-table-hover uk-table-striped uk-table-condensed" >';
				$w .= '<thead>';
				$w .= '<tr>';
				$w .= ' <th>ลำดับ</th> <th>เลข จ.</th> <th>วันที่บรรจุ</th> <th>วันออกงาน</th> <th>รวมเวลาปฎิบัติงาน</th> <th>ตำแหน่ง</th> <th>เงินเดือน</th> <th>สถานที่ทำงาน</th> <th>ลบ</th>';
				$w .= '</tr>';
				$w .= '</thead>';
				$w .= '<tbody>';
				$wi=0;
				foreach ($datawork as $dw) {
					$wi++;
					$w .= '<tr>';
					$w .= '<td>'.$wi.'</td>';	
					$w .= '<td>'.$dw->numlocation.'</td>';								
					$w .= '<td>'.date("d-m", strtotime($dw->appointed_date)).'-'.(date("Y", strtotime($dw->appointed_date))+543).'</td>';
					$w .= '<td>'. (($dw->retirecd_date == '0000-00-00') ? '-':date("d-m", strtotime($dw->retirecd_date)).'-'.(date("Y", strtotime($dw->retirecd_date))+543))  .'</td>';
					$w .= '<td>'.$dw->working_period.'</td>';
					$w .= '<td>'.$dw->position.'</td>';
					$w .= '<td>'.$dw->current_salary.'</td>';
					$w .= '<td>'.$dw->location.'</td>';
                    $w .= '<td>'.'<a href="del_datawork/'.$dw->workID.'/'.$dw->cid.'" title="ลบ" ><i class="uk-icon-trash-o"></i></a>'.'</td>';
					$w .= '</tr>';
				}				
				$w .= '</tbody>';
				$w .= '</table>';


	    		return Response::json(array(
		          'success' => true,
		          'msg' 	=> 'เพิ่มข้อมูลเรียบร้อยแล้ว'	,
		          'w' 	=> $w	         
		        ));
	    	}
	    	else
	    	{
	    		return Response::json(array(
		          'success' => false,
		          'msg' => 'ไม่สามารถบันทึกข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบ'		         
		        ));
	    	}

	    }  	
    }

    /**
	 * function name : post_new_study
	 * reciep data post form 
	 * create new datastudy
	 * post
	*/
    public function post_new_study()
    {
    	//data form ajax
    	$inputData = Input::get('formData');
	    parse_str($inputData, $formFields);  
	    $Data = array(
	      'cid'      		=> $formFields['cidstudy'],	
	      'degree'			=> $formFields['degree'],  
	      'branch'			=> $formFields['branch'],
	      'year'			=> $formFields['year'],
	      'institution'		=> $formFields['institution']	     
	    );
	 
	    $rules = array(
        'degree'   		 =>  'required',
        'branch'     	 =>  'required',
        'institution' 	 =>  'required'
	    );

	    $messages = array(
	    'degree.required' 		=> '** กรุณากรอกวุติการศึกษา**' , 
	    'branch.required'		=> '** กรุณากรอกสาขาที่จบ**',  
	    'institution.required'  => '** กรุณากรอกสถาบัน **'  
	    ); 

	    $validator = Validator::make( $Data, $rules, $messages );
		
	    //check if the form is valid
	    if ( $validator->fails() )
	    {			
	       return Response::json(array(
            'fail' => true,
            'errors' => $validator->getMessageBag()->toArray()
           ));
	    }
	    else
	    {
	    	$emp = DB::insert( 'insert into n_datastudy ( cid, degree, branch, year, institution ) values (?,?,?,?,?)', 
				  array( 
				  	    $Data['cid'],
				  		$Data['degree'],
				  		$Data['branch'],
				  		$Data['year'],
				  		$Data['institution']				  				  						  		
				  ) );

	    	if( $emp )
	    	{	 

		    	$datastudy = DB::table('n_datastudy')->where('cid', $Data['cid'])->get();				

				$s = '<table  class="uk-table uk-table-hover uk-table-striped uk-table-condensed" >';
				$s .= '<thead>';
				$s .= '<tr>';
				$s .= ' <th>ลำดับ</th> <th>วุฒิการศึกษา</th> <th>สาขา</th> <th>ปีที่จบ</th> <th>สถาบัน</th> <th>ลบ</th>';
				$s .= '</tr>';
				$s .= '</thead>';
				$s .= '<tbody>';
				$si=0;
				foreach ($datastudy as $dw) {
					$si++;
					$s .= '<tr>';
					$s .= '<td>'.$si.'</td>';									
					$s .= '<td>'.$dw->degree.'</td>';
					$s .= '<td>'.$dw->branch.'</td>';
					$s .= '<td>'.$dw->year.'</td>';
					$s .= '<td>'.$dw->institution.'</td>';	
                    $s .= '<td>'.'<a href="del_datastudy/'.$dw->studyID.'/'.$dw->cid.'" title="ลบ" ><i class="uk-icon-trash-o"></i></a>'.'</td>';
					$s .= '</tr>';
				}				
				$s .= '</tbody>';
				$s .= '</table>';


	    		return Response::json(array(
		          'success' => true,
		          'msg' 	=> 'เพิ่มข้อมูลเรียบร้อยแล้ว'	,
		          's' 	=> $s	         
		        ));
	    	}
	    	else
	    	{
	    		return Response::json(array(
		          'success' => false,
		          'msg' => 'ไม่สามารถบันทึกข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบ'		         
		        ));
	    	}

	    }
	}

	 /**
	 * function name : post_new_salary
	 * reciep data post form 
	 * create new datasalary
	 * post
	*/
    public function post_new_salary()
    {
    	//data form ajax
    	$inputData = Input::get('formData');
	    parse_str($inputData, $formFields);  

	    $positiondate = explode( "-", $formFields['positiondate'] );

	    $Data = array(
	      'cid'      		=> $formFields['cidsalary'],	
	      'positiondate'	=> ($positiondate[2]-543).'-'.$positiondate[1].'-'.$positiondate[0],  
	      'position_id'		=> $formFields['position_id'],
	      'level'			=> $formFields['level'],
	      'location_id'		=> $formFields['location_id'],
	      'salary'			=> $formFields['salary'],
	      'comment'			=> $formFields['comment']	     
	    );
	 
	    $rules = array(
	        'positiondate'   =>  'required',      
	        'salary' 		 =>  'required'       
	    );

	    $messages = array(
		    'positiondate.required' => '** กรุณากรอกวันที่บรรจุ**' , 
		    'salary.required'		=> '** กรุณากรอกเงินเดือน**'  	    
	    ); 

	    $validator = Validator::make( $Data, $rules, $messages );
		
	    //check if the form is valid
	    if ( $validator->fails() )
	    {			
	       return Response::json(array(
            'fail' => true,
            'errors' => $validator->getMessageBag()->toArray()
           ));
	    }
	    else
	    {
	    	$emp = DB::insert( 'insert into n_position_salary ( cid, positiondate, position_id, level, location_id, salary, comment ) values (?,?,?,?,?,?,?)', 
				  array( 
				  	    $Data['cid'],
				  		$Data['positiondate'],
				  		$Data['position_id'],
				  		$Data['level'],
				  		$Data['location_id'],
				  		$Data['salary'],
				  		$Data['comment']				  				  						  		
				  ) );

	    	if( $emp )
	    	{	 		    
		    	$datasalary = DB::table( 'n_position_salary' )
				         ->join( 'n_position', 'n_position_salary.position_id', '=', 'n_position.position_id' )
				         ->join( 'n_location_work', 'n_position_salary.location_id', '=', 'n_location_work.location_id' )
				         ->where( 'n_position_salary.cid', '=', $Data['cid'] )->get();			

				$r = '<table  class="uk-table uk-table-hover uk-table-striped uk-table-condensed" >';
				$r .= '<thead>';
				$r .= '<tr>';
				$r .= ' <th>ลำดับ</th> <th>วันที่บรรจุ</th> <th>ตำแหน่ง</th> <th>สถานะ</th> <th>สถานที่ทำงาน</th> <th>เงินเดือน</th> <th>หมายเหตุ</th> <th>ลบ</th>';
				$r .= '</tr>';
				$r .= '</thead>';
				$r .= '<tbody>';
				$ri=0;
				foreach ($datasalary as $dw) {
					$ri++;
					$r .= '<tr>';
					$r .= '<td>'.$ri.'</td>';									
					$r .= '<td>'.date("d-m", strtotime($dw->positiondate)).'-'.(date("Y", strtotime($dw->positiondate))+543).'</td>';
					$r .= '<td>'.$dw->position_id.'</td>';
					$r .= '<td>'.$dw->level.'</td>';
					$r .= '<td>'.$dw->locationName.'</td>';	
					$r .= '<td>'.$dw->salary.'</td>';
					$r .= '<td>'.$dw->comment.'</td>';	
                    $r .= '<td>'.'<a href="del_datasalary/'.$dw->salaryID.'/'.$dw->cid.'" title="ลบ" ><i class="uk-icon-trash-o"></i></a>'.'</td>';
					$r .= '</tr>';
				}				
				$r .= '</tbody>';
				$r .= '</table>';

	    		return Response::json(array(
		          'success' => true,
		          'msg' 	=> 'เพิ่มข้อมูลเรียบร้อยแล้ว'	,
		          'r' 	=> $r	         
		        ));
	    	}
	    	else
	    	{
	    		return Response::json(array(
		          'success' => false,
		          'msg' => 'ไม่สามารถบันทึกข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบ'		         
		        ));
	    	}

	    }
	}


	 /**
	 * function name : post_new_leave
	 * reciep data post form 
	 * create new dataleave
	 * post
	*/
    public function post_new_leave()
    {
    	//data form ajax
    	$inputData = Input::get( 'formData' );
	    parse_str( $inputData, $formFields ); 

	    $dateRequest 	= explode( "-", $formFields['dateRequest'] );
	    $startdate 		= explode( "-", $formFields['startdate'] );
	    $enddate 		= explode( "-", $formFields['enddate'] );

	    $Data = array(
	      'cid'      			=> $formFields['cidleave'],	
	      'dateRequest'			=> $dateRequest,  	    
	      'leave_type_id'		=> $formFields['leave_type_id'],
	      'leaveDetail'			=> $formFields['leaveDetail'],
	      'startdate'			=> $startdate,
	      'enddate'				=> $enddate,
	      'totalleave'			=> $formFields['totalleave']	     	     
	    );
	 
	    $rules = array(
	        'dateRequest'   	=>  'required',	        
	        'leaveDetail'   	=>  'required',
	        'startdate'   		=>  'required',
	        'enddate'  	 		=>  'required',
	        'totalleave'  	 	=>  'required'	       	          
	    );

	    $messages = array(
		    'dateRequest.required' 			=> '** กรุณากรอกวันที่ขอ**' , 		   
		    'leaveDetail.required' 			=> '** กรุณากรอกรายละเอียด**' ,
		    'startdate.required' 			=> '** กรุณากรอกตั้งแต่วันที่**' ,
		    'enddate.required' 				=> '** กรุณากรอกถึงวันที่**' ,
		    'totalleave.required' 			=> '** กรุณากรอกจำนวนกี่วัน**' 		  		      
	    ); 

	    $validator = Validator::make( $Data, $rules, $messages );
		
	    //check if the form is valid
	    if ( $validator->fails() )
	    {			
	       return Response::json(array(
            'fail' => true,
            'errors' => $validator->getMessageBag()->toArray()
           ));
	    }
	    else
	    {
	    	$emp = DB::insert( 'insert into n_dataleave ( cid, dateRequest, leave_type_id, leaveDetail, startdate, enddate, totalleave ) values (?,?,?,?,?,?,?)', 
				  array( 
				  	    $Data['cid'],
				  		$Data['dateRequest'],
				  		$Data['leave_type_id'],
				  		$Data['leaveDetail'],
				  		$Data['startdate'],
				  		$Data['enddate'],
				  		$Data['totalleave']				  				  				  						  		
				  ) );

	    	if( $emp )
	    	{	 		    
		    	$dataleave = DB::table( 'n_dataleave' )
				         ->join( 'n_leave_type', 'n_dataleave.leave_type_id', '=', 'n_leave_type.leave_type_id' )				       
				         ->where( 'n_dataleave.cid', '=', $Data['cid'] )->get();			

				$l = '<table  class="uk-table uk-table-hover uk-table-striped uk-table-condensed" >';
				$l .= '<thead>';
				$l .= '<tr>';
				$l .= ' <th>ลำดับ</th> <th>วันที่ขอ</th> <th>ประเภทการลา</th> <th>รายละเอียด</th> <th>ตั้งแต่วันที่</th> <th>ถึงวันที่</th> <th>จำนวนกี่วัน</th> ';
				$l .= '</tr>';
				$l .= '</thead>';
				$l .= '<tbody>';
				$li=0;
				foreach ($dataleave as $dw) {
					$li++;
					$l .= '<tr>';
					$l .= '<td>'.$li.'</td>';									
					$l .= '<td>'.date("d-m", strtotime($dw->dateRequest)).'-'.(date("Y", strtotime($dw->dateRequest))+543).'</td>';
					$l .= '<td>'.$dw->leave_type_name.'</td>';
					$l .= '<td>'.$dw->leaveDetail.'</td>';
					$l .= '<td>'.date("d-m", strtotime($dw->startdate)).'-'.(date("Y", strtotime($dw->startdate))+543).'</td>';	
					$l .= '<td>'.date("d-m", strtotime($dw->enddate)).'-'.(date("Y", strtotime($dw->enddate))+543).'</td>';	
					$l .= '<td>'.$dw->totalleave.'</td>';						
					$l .= '</tr>';
				}				
				$l .= '</tbody>';
				$l .= '</table>';

	    		return Response::json(array(
		          'success' => true,
		          'msg' 	=> 'เพิ่มข้อมูลเรียบร้อยแล้ว'	,
		          'l' 	=> $l	         
		        ));
	    	}
	    	else
	    	{
	    		return Response::json(array(
		          'success' => false,
		          'msg' => 'ไม่สามารถบันทึกข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบ'		         
		        ));
	    	}

	    }
	}

	 /**
    * function name : view
    * edit data Emp
    * get
    */
	public function view( $id )
	{

		$emp 		= $this->_get_empdata( $id );         	
    	$datawork   = DB::table( 'n_datawork' )->where( 'cid', $id )->get();	
    	$datastudy  = DB::table( 'n_datastudy' )->where( 'cid', $id )->get();
    	$datasalary = DB::table( 'n_position_salary' )
				         ->join( 'n_position', 'n_position_salary.position_id', '=', 'n_position.position_id' )
				         ->join( 'n_location_work', 'n_position_salary.location_id', '=', 'n_location_work.location_id' )
				         ->where( 'n_position_salary.cid', '=', $id )->get();	
		$dataleave  = DB::table( 'n_dataleave' )
			         ->join( 'n_leave_type', 'n_dataleave.leave_type_id', '=', 'n_leave_type.leave_type_id' )				       
			         ->where( 'n_dataleave.cid', '=', $id )->get();

		return View::make( 'emps.detail', 
	    		   array( 
	    		   		'emp' 			=> $emp,	    		   		
	    		   		'datawork'		=> $datawork,
	    		   		'datastudy'		=> $datastudy,
	    		   		'datasalary' 	=> $datasalary,
	    		   		'dataleave'     => $dataleave
	    			) );  

	}

	 /**
    * function name : delete
    * edit data Emp
    * get
    */
    public function delete( $id ) 
    {
    	if ( Auth::check() )
    	{    		
            $result = Emp::where( 'cid', $id )->delete();

		   if( $result )
	        {
	        	return Redirect::to( 'admin/emps' )->with( 'success_message', 'ลบข้อมูลเรียบร้อยแล้ว' ); 
	        }
	        else
	        {
	        	return Redirect::to( 'admin/emps' )->with( 'error_message', 'ไม่สามารถลบข้อมูลได้ กรุณาแจ้งผู้ดูแลระบบ' ); 
	        }	   
    	}
    	else
    	{
    		return View::make( 'users.index' );	
    	}      
    }
    
     /**
    * function name : del_datawork
    * edit data Emp del_datawork
    * get
    */
    public function del_datawork( $id, $cid ) 
    {          
    	if ( Auth::check() )
    	{               
            $result = Datawork::where( 'workID', $id )->delete();

		   if( $result )
	        {
	        	return Redirect::to( 'admin/emps/edit/'.$cid ); 
	        }
	        else
	        {
	        	return Redirect::to( 'admin/emps/edit/'.$cid ); 
	        }	   
    	}
    	else
    	{
    		return View::make( 'users.index' );	
    	}     
    }
    
     /**
    * function name : del_datastudy
    * edit data Emp del_datastudy
    * get
    */
    public function del_datastudy( $id, $cid ) 
    {          
    	if ( Auth::check() )
    	{               
            $result = Datastudy::where( 'studyID', $id )->delete();

		   if( $result )
	        {
	        	return Redirect::to( 'admin/emps/edit/'.$cid ); 
	        }
	        else
	        {
	        	return Redirect::to( 'admin/emps/edit/'.$cid ); 
	        }	   
    	}
    	else
    	{
    		return View::make( 'users.index' );	
    	}     
    }
    
     /**
    * function name : del_datasalary
    * edit data Emp datasalary
    * get
    */
    public function del_datasalary( $id, $cid ) 
    {          
    	if ( Auth::check() )
    	{               
            $result = salary::where( 'salaryID', $id )->delete();

		   if( $result )
	        {
	        	return Redirect::to( 'admin/emps/edit/'.$cid ); 
	        }
	        else
	        {
	        	return Redirect::to( 'admin/emps/edit/'.$cid ); 
	        }	   
    	}
    	else
    	{
    		return View::make( 'users.index' );	
    	}     
    }


}
?>