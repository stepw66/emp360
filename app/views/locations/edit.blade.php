@extends('layouts.sidebar')
@section('content')

<h4 class="tm-article-subtitle">
<ul class="uk-breadcrumb">
    <li><a href="{{ URL::to('admin/locations') }}">ข้อมูลสถานที่ทำงาน</a></li>   
    <li><span>แก้ไขข้อมูลสถานที่ทำงาน</span></li> 
    <li class="uk-active"><span>{{ $location->locationName }}</span></li>
</ul>
</h4>

<?php
	$url = 'admin/locations/edit/'.$location->location_id;
?>
{{ Form::open( array( 'url' => $url, 'class' => 'uk-form uk-form-horizontal uk-width-medium-1-1' ) ) }}
<fieldset>
<div class="g-header-from uk-text-danger">แก้ไขข้อมูล</div>  
	{{ Form::token() }}		
    <div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'locationName', 'ชื่อสถานที่ทำงาน', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">
			{{ Form::text( 'locationName', $location->locationName, array( 'placeholder' => 'ชื่อสถานที่ทำงาน', 'class' => 'uk-width-1-1' ) ) }}
			@if ($errors->has('locationName')) <p class="g-text-error uk-text-danger">{{ $errors->first('locationName') }}</p> @endif
		</div>
	</div>
	<hr />
	<div class="uk-form-row uk-text-center">
		{{ Form::submit( 'บันทึก', array( 'class'=>'uk-button uk-button-primary' ) ) }}
		<a class="uk-button uk-button-success" href="{{ URL::to('admin/locations') }}">กลับหน้าหลัก</a>
	</div>

 	<hr />	 
    </fieldset>
  {{ Form::close() }}
	
@stop
