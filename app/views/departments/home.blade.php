@extends('layouts.sidebar')
@section('content')
<h4 class="tm-article-subtitle">ข้อมูลแผนก</h4>
<?php 
	$success_message = Session::get('success_message');
	$error_message = Session::get('error_message');
?>
@if(!empty($success_message))
	<div class="uk-alert uk-alert-success"><a href="" class="uk-alert-close uk-close"></a>{{ $success_message }}</div>
@endif
 @if(!empty($error_message))
	<div class="uk-alert uk-alert-danger"><a href="" class="uk-alert-close uk-close"></a>{{ $error_message }}</div>
@endif
<div class="uk-grid">
	<div class="uk-width-medium-1-2">
		<a data-uk-tooltip="{pos:'right'}" data-uk-tooltip title="เพิ่มข้อมูลแผนก" class="uk-button uk-button-success" href="{{ URL::to('admin/departments/create') }}"><i class="uk-icon-plus"></i></a>
	</div>
	<div class="uk-width-medium-1-2">
		<div class="uk-navbar-flip" data-uk-tooltip title="ค้นหาข้อมูล">			
			{{ Form::open( array( 'url' => 'admin/departments/search' , 'class' => 'uk-search uk-hidden-small', 'data-uk-search' => '' ) ) }}				
				<input class="uk-search-field" type="search" id="search" name="search" placeholder="ค้นหา..." autocomplete="off">
				<button class="uk-search-close" type="reset"></button>
				<div class="uk-dropdown uk-dropdown-search"></div>
			{{ Form::close() }}
		</div>
	</div>
</div>
<div class="uk-overflow-container">
	<table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
	<thead>
		<tr>
		<th>ลำดับ</th>
		<th>ชื่อแผนก</th>				
		<th></th>	
		<th></th>	
		</tr>
	</thead>
	<tbody>
		@foreach( $departmentall as $a )
		<tr class="uk-table-middle">			
        	<td width="50">{{ $a->department_id }}</td>
        	<td>{{ $a->departmentName }}</td>								
			<td width="30"><a data-uk-tooltip title="แก้ไขข้อมูล" class="uk-button uk-button-primary" href="{{ URL::to('admin/departments/edit') }}/{{ $a->department_id }}"><i class="uk-icon-edit"></i></a></td>	
			<td width="30"><a data-uk-tooltip title="ลบข้อมูล" class="uk-button uk-button-danger" onclick="if(!confirm('ต้องการลบข้อมูลหรือไม่?')){return false;};" href="{{ URL::to('admin/departments/delete') }}/{{ $a->department_id }}"><i class="uk-icon-trash-o"></i></a></td>					   
		</tr>	
		@endforeach		
	</tbody>
	</table>
</div>


<?php echo $departmentall->links(); ?>
	
@stop