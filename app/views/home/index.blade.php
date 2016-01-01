@extends('layouts.sidebar')
@section('content')
	<div class="uk-grid">
		<div class="uk-width-medium-1-4">
			<div class="uk-panel uk-panel-box uk-panel-header uk-animation-fade g-background-addemp uk-margin-top">
				<p class="uk-text-muted tm-uppercase uk-margin-bottom-remove">ตำแหน่ง</p>
				<h4 class="uk-panel-title uk-text-truncate uk-margin-top-remove uk-text-success">
					<a href="{{ URL::to( 'admin/emps/position/ลูกจ้างชั่วคราว' ) }}">ลูกจ้างชั่วคราว</a>
				</h4>
				<h5 class="uk-text-truncate uk-margin-bottom-remove">
					<div class="uk-clearfix uk-text-warning">
						<div class="uk-float-left">จำนวน</div> 
						<span class="uk-float-right g-badge-price uk-text-warning"> {{ $sum4->a }} คน</span>
					</div>
				</h5>
			</div>
		</div>
		<div class="uk-width-medium-1-4">
			<div class="uk-panel uk-panel-box uk-panel-header uk-animation-fade g-background-addemp uk-margin-top">
				<p class="uk-text-muted tm-uppercase uk-margin-bottom-remove">ตำแหน่ง</p>
				<h4 class="uk-panel-title uk-text-truncate uk-margin-top-remove uk-text-success">
					<a href="{{ URL::to( 'admin/emps/position/พกส.(ปฏิบัติงาน)' ) }}">พกส.(ปฏิบัติงาน)</a>
				</h4>
				<h5 class="uk-text-truncate uk-margin-bottom-remove">
					<div class="uk-clearfix uk-text-warning">
						<div class="uk-float-left">จำนวน</div> 
						<span class="uk-float-right g-badge-price uk-text-warning"> {{ $sum1->a }} คน</span>
					</div>
				</h5>
			</div>
		</div>
		<div class="uk-width-medium-1-4">
			<div class="uk-panel uk-panel-box uk-panel-header uk-animation-fade g-background-addemp uk-margin-top">
				<p class="uk-text-muted tm-uppercase uk-margin-bottom-remove">ตำแหน่ง</p>
				<h4 class="uk-panel-title uk-text-truncate uk-margin-top-remove uk-text-success">
					<a href="{{ URL::to( 'admin/emps/position/ลูกจ้างประจำ' ) }}">ลูกจ้างประจำ</a>
				</h4>
				<h5 class="uk-text-truncate uk-margin-bottom-remove">
					<div class="uk-clearfix uk-text-warning">
						<div class="uk-float-left">จำนวน</div> 
						<span class="uk-float-right g-badge-price uk-text-warning"> {{ $sum2->a }} คน</span>
					</div>
				</h5>
			</div>
		</div>
		<div class="uk-width-medium-1-4">
			<div class="uk-panel uk-panel-box uk-panel-header uk-animation-fade g-background-addemp uk-margin-top">
				<p class="uk-text-muted tm-uppercase uk-margin-bottom-remove">ตำแหน่ง</p>
				<h4 class="uk-panel-title uk-text-truncate uk-margin-top-remove uk-text-success">
					<a href="{{ URL::to( 'admin/emps/position/ข้าราชการ' ) }}">ข้าราชการ</a>
				</h4>
				<h5 class="uk-text-truncate uk-margin-bottom-remove">
					<div class="uk-clearfix uk-text-warning">
						<div class="uk-float-left">จำนวน</div> 
						<span class="uk-float-right g-badge-price uk-text-warning"> {{ $sum3->a }} คน</span>
					</div>
				</h5>
			</div>
		</div>
	</div>

	<div class="uk-margin-top uk-margin-bottom">
		<div class="uk-panel uk-panel-header uk-animation-fade">
			<h3 class="uk-panel-title"><i class="uk-icon-h-square uk-icon-small"></i> ระบบจัดการข้อมูลพนักงาน ( <span class="uk-text-success">EMP360</span> <span class="uk-text-danger">SYSTEMS.</span> )</h3>
			<ul class="uk-list">
			    <li>- เก็บข้อมูลทั่วไป ข้อมูลที่อยู่ ข้อมูลที่ติดต่อ</li>
			    <li>- เก็บข้อมูลประวัติการทำงาน</li>
			    <li>- เก็บข้อมูลประวัติการศึกษา</li>
			    <li>- เก็บข้อมูลตำแหน่งและเงินเดือน</li>
			    <li>- เก็บข้อมูลประวัติการลา</li>
			</ul>
		</div>
	</div>

@stop