@extends('layouts.sidebar')
@section('content')

<h4 class="tm-article-subtitle">
<ul class="uk-breadcrumb">
    <li><a href="{{ URL::to('admin/leaves') }}">ข้อมูลประเภทการลา</a></li>   
    <li class="uk-active"><span>เพิ่มข้อมูลประเภทการลา</span></li>
</ul>
</h4>	
	
{{ Form::open( array( 'url' => 'admin/leaves/create', 'class' => 'uk-form uk-form-horizontal uk-width-medium-1-1' ) ) }}
<fieldset>
<div class="g-header-from uk-text-danger">เพิ่มข้อมูล</div>  
	{{ Form::token() }}		

    <div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'leave_type_name', 'ชื่อประเภทการลา', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">
			{{ Form::text( 'leave_type_name', Input::old('leave_type_name'), array( 'placeholder' => 'ชื่อประเภทการลา', 'class' => 'uk-width-1-1' ) ) }}
			@if ($errors->has('leave_type_name')) <p class="g-text-error uk-text-danger">{{ $errors->first('leave_type_name') }}</p> @endif
		</div>
	</div>
	<hr />
	<div class="uk-form-row uk-text-center">
		{{ Form::submit( 'บันทึก', array( 'class'=>'uk-button uk-button-primary' ) ) }}
		<a class="uk-button uk-button-success" href="{{ URL::to('admin/leaves') }}">กลับหน้าหลัก</a>
	</div>

 	<hr />	 
    </fieldset>
  {{ Form::close() }}
	
@stop
