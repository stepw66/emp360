@extends('layouts.sidebar')
@section('content')

<h4 class="tm-article-subtitle">
<ul class="uk-breadcrumb">
    <li><a href="{{ URL::to('admin/departments') }}">ข้อมูลแผนก</a></li>   
    <li><span>แก้ไขข้อมูลแผนก</span></li> 
    <li class="uk-active"><span>{{ $department->departmentName }}</span></li>
</ul>
</h4>

<?php
	$url = 'admin/departments/edit/'.$department->department_id;
?>
{{ Form::open( array( 'url' => $url, 'class' => 'uk-form uk-form-horizontal uk-width-medium-1-1' ) ) }}
<fieldset>
<div class="g-header-from uk-text-danger">แก้ไขข้อมูล</div>  
	{{ Form::token() }}		

    <div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'departmentName', 'ชื่อแผนก', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">
			{{ Form::text( 'departmentName', $department->departmentName, array( 'placeholder' => 'ชื่อแผนก', 'class' => 'uk-width-1-1' ) ) }}
			@if ($errors->has('departmentName')) <p class="g-text-error uk-text-danger">{{ $errors->first('departmentName') }}</p> @endif
		</div>
	</div>
	<hr />
	<div class="uk-form-row uk-text-center">
		{{ Form::submit( 'บันทึก', array( 'class'=>'uk-button uk-button-primary' ) ) }}
		<a class="uk-button uk-button-success" href="{{ URL::to('admin/departments') }}">กลับหน้าหลัก</a>
	</div>

 	<hr />	 
    </fieldset>
  {{ Form::close() }}
	
@stop
