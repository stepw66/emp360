@extends('layouts.sidebar')
@section('content')
<h4 class="tm-article-subtitle">ข้อมูลหัวหน้าแผนก</h4>



{{ Form::open( array( 'url' => 'admin/header_dep/create', 'class' => 'uk-form uk-form-horizontal uk-width-medium-1-1' ) ) }}
<fieldset>
<div class="g-header-from uk-text-danger">เพิ่มข้อมูล</div>  
	{{ Form::token() }}		

    <div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'departmentName', 'ชื่อแผนก', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">
			<div  class="g-text uk-width-1-1 uk-autocomplete uk-form" data-uk-autocomplete='{ source: <?php echo json_encode($departmentall); ?> }'>
				<input type="text" name="dep_Name" class="uk-width-1-1 uk-form-small" >
			</div>
		</div>
	</div>
	<div class="uk-form-row uk-width-1-1">
		{{ Form::label( 'headerName', 'ชื่อหัวหน้าแผนก', array( 'class' => 'uk-form-label' ) ) }}
		<div class="uk-form-controls">
			<div  class="g-text uk-width-1-1 uk-autocomplete uk-form" data-uk-autocomplete='{ source: <?php echo json_encode($dataUser); ?> }'>
				<input type="text" name="header_Name" class="uk-width-1-1 uk-form-small" >
			</div>
		</div>
	</div>
	<hr />
	<div class="uk-form-row uk-text-center">
		{{ Form::submit( 'บันทึก', array( 'class'=>'uk-button uk-button-primary' ) ) }}	
	</div>

 	<hr />	 
    </fieldset>
 {{ Form::close() }}
 
 
 <?php
	if( isset($header_data) ){
?>

<div class="uk-overflow-container">
	<table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
	<thead>
		<tr>	
		<th>ชื่อแผนก</th>				
		<th>หัวหน้าแผนก</th>	
		<th></th>	
		</tr>
	</thead>
	<tbody>
		@foreach( $header_data as $a )
		<tr class="uk-table-middle">			       	
        	<td>{{ $a->departmentName }}</td>								
			<td>{{ $a->header_name }}</td>	
			<td width="30"><a data-uk-tooltip title="ลบข้อมูล" class="uk-button uk-button-danger" onclick="if(!confirm('ต้องการลบข้อมูลหรือไม่?')){return false;};" href="{{ URL::to('admin/header_dep/delete') }}/{{ $a->cid }}"><i class="uk-icon-trash-o"></i></a></td>					   
		</tr>	
		@endforeach		
	</tbody>
	</table>
</div>
		
<?php
	}
 ?>

	
@stop