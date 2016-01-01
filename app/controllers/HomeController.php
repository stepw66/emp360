<?php

class HomeController extends BaseController {
	
	public function index()
	{
		if ( Auth::check() )
		{
			$sum1 = Salary::select(DB::raw('count(distinct cid) as a'))
				  ->where('level' ,'=', 'พกส.(ปฏิบัติงาน)')                 
				  ->first();
			$sum2 = Salary::select(DB::raw('count(distinct cid) as a'))
				  ->where('level' ,'=', 'ลูกจ้างประจำ')                 
				  ->first();
			$sum3 = Salary::select(DB::raw('count(distinct cid) as a'))
				  ->where('level' ,'=', 'ข้าราชการ')              
				  ->first();
			$sum4 = Salary::select(DB::raw('count(distinct cid) as a'))
				  ->where('level' ,'=', 'ลูกจ้างชั่วคราว')               
				  ->first();
		     
		    return View::make( 'home.index',  array( 'sum1' => $sum1, 'sum2' => $sum2, 'sum3' => $sum3, 'sum4' => $sum4 ) ); 
	    }	
		else
		{
			//return login
    		return View::make( 'users.index' );	
		}	    		
	}

	
}
