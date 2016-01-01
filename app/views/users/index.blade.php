@extends('layouts.login')
@section('content')
		
	{{ Form::open( array( 'url' => 'login', 'class' => 'uk-form uk-form-stacked uk-width-medium-1-1' ) ) }}
		
		<fieldset>
		<div class="g-header-login uk-hidden-small">เข้าสู่ระบบ : ระบบจัดการข้อมูลพนักงาน</div>
		{{ Form::token() }}	
		<!-- if there are login errors, show them here -->
	
		@if ( $errors->has('username') )
			<div class="uk-alert uk-alert-danger"> <a href="" class="uk-alert-close uk-close"></a>{{ $errors->first('username') }}</div>
		@endif
		@if ( $errors->has('password') )
			<div class="uk-alert uk-alert-danger"> <a href="" class="uk-alert-close uk-close"></a>{{ $errors->first('password') }}</div>
		@endif
		<?php 		
			$error_message = Session::get('error_message');
	    ?>
		@if(!empty($error_message))
	    	<div class="uk-alert uk-alert-danger"> <a href="" class="uk-alert-close uk-close"></a> {{ $error_message }} </div>
	    @endif
					   

		<div class="uk-form-row uk-width-1-1">
			{{ Form::label( 'username', 'ชื่อผู้ใช้', array( 'class' => 'uk-form-label' ) ) }}
			{{ Form::text( 'username', Input::old('username'), array( 'placeholder' => 'ชื่อผู้ใช้', 'class' => 'uk-width-1-1' ) ) }}
		</div>

		<div class="uk-form-row uk-width-1-1">
			{{ Form::label('password', 'รหัสผ่าน', array( 'class' => 'uk-form-label' ) ) }}
			{{ Form::password( 'password', array('class'=>'uk-width-1-1','placeholder'=>'รหัสผ่าน') ) }}
		</div>

		<div class="uk-form-row">{{ Form::submit( 'เข้าสู่ระบบ!', array( 'class'=>'uk-button uk-button-primary' ) ) }}</div>

		</fieldset>
	{{ Form::close() }}
	
@stop
