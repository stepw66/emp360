$(document).ready(function() {
 
	//-------------- add work ----------------//
	$("#btnSubmitwork").click(function(){
		
			var $form = $( '#form-addwork' ), data = $form.serialize(), url = $form.attr( "action" );

		    var posting = $.post( url, { formData: data } );

		    posting.done(function( data ) {
				    if( data.fail ) 
				    {
				    	$('#current_salary_error').fadeIn(); //show  form
				    	$('#working_period_error').fadeIn();
				    	$('#position_error').fadeIn();
				        $.each(data.errors, function( index, value ) {
					        var errorDiv = '#'+index+'_error';
					        $( errorDiv ).addClass( 'required' );
					        $( errorDiv ).empty().append( value );
				        });				                 
				    } 
				    if( data.success == true ) 
				    {
				    	$('#current_salary_error').fadeOut(); //hiding form
				    	$('#working_period_error').fadeOut();
				    	$('#position_error').fadeOut();

				    	$("#form-addwork").get(0).reset();

				    	$('#datawork').html(data.w);				    				       
				    }
				    if( data.success == false )
				    {
				    	alert( data.msg );	
				    }
			  }); //done
			
	});

	//-------------- add study ----------------//
	$("#btnSubmitstudy").click(function(){
		
			var $form = $( '#form-addstudy' ), data = $form.serialize(), url = $form.attr( "action" );

		    var posting = $.post( url, { formData: data } );

		    posting.done(function( data ) {
				    if( data.fail ) 
				    {
				    	$('#degree_error').fadeIn(); //show  form
				    	$('#branch_error').fadeIn();
				    	$('#institution_error').fadeIn();
				        $.each(data.errors, function( index, value ) {
					        var errorDiv = '#'+index+'_error';
					        $( errorDiv ).addClass( 'required' );
					        $( errorDiv ).empty().append( value );
				        });				                 
				    } 
				    if( data.success == true ) 
				    {
				    	$('#degree_error').fadeOut(); //hiding form
				    	$('#branch_error').fadeOut();
				    	$('#institution_error').fadeOut();

				    	$("#form-addstudy").get(0).reset();

				    	$('#datastudy').html(data.s);				    				       
				    }
				    if( data.success == false )
				    {
				    	alert( data.msg );	
				    }
			  }); //done
			
	});

	//-------------- add salary ----------------//
	$("#btnSubmitsalary").click(function(){
		
			var $form = $( '#form-addsalary' ), data = $form.serialize(), url = $form.attr( "action" );

		    var posting = $.post( url, { formData: data } );

		    posting.done(function( data ) {
				    if( data.fail ) 
				    {
				    	$('#positiondate_error').fadeIn(); //show  form
				    	$('#salary_error').fadeIn();
				    	
				        $.each(data.errors, function( index, value ) {
					        var errorDiv = '#'+index+'_error';
					        $( errorDiv ).addClass( 'required' );
					        $( errorDiv ).empty().append( value );
				        });				                 
				    } 
				    if( data.success == true ) 
				    {
				    	$('#positiondate_error').fadeOut(); //hiding form
				    	$('#salary_error').fadeOut();				    	

				    	$("#form-addsalary").get(0).reset();

				    	$('#datasalary').html(data.r);			    				       
				    }
				    if( data.success == false )
				    {
				    	alert( data.msg );	
				    }
			  }); //done
			
	});

	//-------------- add leave ----------------//
	$("#btnSubmitleave").click(function(){
		
			var $form = $( '#form-addleave' ), data = $form.serialize(), url = $form.attr( "action" );

		    var posting = $.post( url, { formData: data } );

		    posting.done(function( data ) {
				    if( data.fail ) 
				    {
				    	$('#dateRequest_error').fadeIn(); //show  form
				    	$('#leaveDetail_error').fadeIn();
				    	$('#startdate_error').fadeIn();
				    	$('#totalleave_error').fadeIn();
				    	$('#enddate_error').fadeIn();
				    	
				        $.each(data.errors, function( index, value ) {
					        var errorDiv = '#'+index+'_error';
					        $( errorDiv ).addClass( 'required' );
					        $( errorDiv ).empty().append( value );
				        });				                 
				    } 
				    if( data.success == true ) 
				    {
				    	$('#dateRequest_error').fadeOut(); //hiding form
				    	$('#leaveDetail_error').fadeOut();	
				    	$('#startdate_error').fadeOut();
				    	$('#totalleave_error').fadeOut();
				    	$('#enddate_error').fadeOut();			    	

				    	$("#form-addleave").get(0).reset();

				    	$('#dataleave').html(data.l);			    				       
				    }
				    if( data.success == false )
				    {
				    	alert( data.msg );	
				    }
			  }); //done
			
	});


	


});