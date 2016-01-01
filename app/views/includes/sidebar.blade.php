
<?php
	$urlcheck =  explode("/", Request::path());
	$activeurl = $urlcheck[0].'/'.$urlcheck[1];
?>

<ul class="uk-nav uk-nav-side uk-nav-parent-icon uk-width-medium-1-1" data-uk-nav="{multiple:true}">
	<li class="{{$activeurl == 'admin/home' ? 'uk-active' : '';}}" >
		<a href="{{ URL::to('admin/home') }}"><i class="uk-icon-home"></i> หน้าหลัก</a>
	</li>	
	<li class="uk-parent {{$activeurl == 'admin/emps' ? 'uk-active' : '';}} ">
		<a href="#"><i class="uk-icon-user"></i> จัดการข้อมูลพนักงาน</a>		
		<ul class="uk-nav-sub">
			<li>
				<a href="{{ URL::to('admin/emps') }}">ข้อมูลพนักงาน</a>				
			</li>			
		</ul>		
	</li>
	<li class="uk-parent  {{$activeurl == 'admin/users' ? 'uk-active' : '';}} {{$activeurl == 'admin/departments' ? 'uk-active' : '';}} {{$activeurl == 'admin/positions' ? 'uk-active' : '';}} {{$activeurl == 'admin/leaves' ? 'uk-active' : '';}} {{$activeurl == 'admin/locations' ? 'uk-active' : '';}} {{$activeurl == 'admin/header_dep' ? 'uk-active' : '';}} " >
		<a href="#"> <i class="uk-icon-cog"></i> จัดการข้อมูลพื้นฐาน</a>		
		<ul class="uk-nav-sub">
			<?php
			if( Session::get('username') == 'admin' ){
			?>
			<li>
				<a href="{{ URL::to('admin/users') }}">ข้อมูลผู้ใช้งานระบบ</a>
			</li>
			<?php } ?>

			<li>
				<a href="{{ URL::to('admin/departments') }}">ข้อมูลแผนก</a>
			</li>
			<li>
				<a href="{{ URL::to('admin/header_dep') }}">ข้อมูลหัวหน้าแผนก</a>
			</li>
			<li>
				<a href="{{ URL::to('admin/positions') }}">ข้อมูลตำแหน่ง</a>
			</li>
			<li>
				<a href="{{ URL::to('admin/locations') }}">ข้อมูลสถานที่ทำงาน</a>
			</li>
			<li>
				<a href="{{ URL::to('admin/leaves') }}">ข้อมูลประเภทการลา</a>
			</li>
		</ul>		
	</li>
	<li class="uk-parent {{$activeurl == 'admin/reports' ? 'uk-active' : '';}} ">
		<a href="#"><i class="uk-icon-file-text"></i> รายงานระบบ</a>		
		<ul class="uk-nav-sub">
			<li>
				#
			</li>			
		</ul>		
	</li>

</ul>



