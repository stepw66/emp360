@extends('layouts.sidebar')
@section('content')

<h4 class="tm-article-subtitle">
<ul class="uk-breadcrumb">
    <li><a href="{{ URL::to('admin/emps') }}">ข้อมูลพนักงาน</a></li>   
    <li><span>รายละเอียด</span></li> 
    <li class="uk-active"><span>{{ $emp->pname }} {{ $emp->fname }} {{ $emp->lname }}</span></li>
</ul>
</h4>

<div class="uk-panel uk-panel-box uk-panel-box-primary">
	<span class="uk-float-right"><a data-uk-tooltip title="แก้ไขข้อมูล" class="uk-button uk-button-success" href="{{ URL::to('admin/emps/edit') }}/{{ $emp->cid }}"><i class="uk-icon-edit"></i></a></span>
	<div class="uk-text-center">
		<?php $urlimg = 'uploads/'.$emp->cid.'/'.$emp->picture; ?>
		{{ HTML::image($urlimg, '', array('class' => 'uk-border-circle', 'height' => '100', 'width' => '100' ) ); }}
	</div>
	<ul class="uk-list uk-list-line">
        <li>สถานะการทำงานปัจจุบัน : <?php echo ($emp->status == 0)?'ทำงานอยู่':'ไม่ได้ทำงาน'; ?></li>
		<li>เลข จ : <?php  echo ($emp->numlocation == '')?'-':$emp->numlocation; ?></li>
		<li>ชื่อ : {{ $emp->pname }} {{ $emp->fname }} {{ $emp->lname }}</li>
		<li>เกิดวันที่ (ว-ด-ป) : <?php echo date("d-m", strtotime($emp->birthday)).'-'.(date("Y", strtotime($emp->birthday))+543); ?></li>
		<li>รหัสบัตรประชาชน : {{ $emp->cid }}</li>
		<li>ที่อยู่ : บ้านเลขที่ {{ $emp->address }}	{{ $emp->tmbpart }}	 {{ $emp->amppart }} {{ $emp->chwpart }} รหัสไปรษณีย์ {{ $emp->zipcode }}</li>
		<li>เบอร์โทรบ้าน : <?php  echo ($emp->tel == '')?'-':$emp->tel; ?></li>
		<li>เบอร์มือถือ : <?php  echo ($emp->mobile == '')?'-':$emp->mobile; ?></li>
		<li>อีเมล์ : <?php  echo ($emp->email == '')?'-':$emp->email; ?></li>
	</ul>
</div>

<br />

<?php
	if( count($datawork) == 0){
		echo '<div class="uk-text-muted">ประวัติการทำงาน -</div>';
	}
	else
	{	
?>
<div class="uk-panel uk-panel-box uk-panel-box-primary">
<div class="uk-overflow-container">
<table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
    <caption>ประวัติการทำงาน</caption>  
    <thead>
        <tr>
        	<th></th>
        	<th>เลข จ.</th>
            <th>วันที่เริ่ม</th>
            <th>วันที่ออก</th>
            <th>ระยะเวลารวม</th>
            <th>ตำแหน่ง</th>
            <th>เงินเดือนล่าสุด</th>
            <th>สถานที่ทำงาน</th>
        </tr>
    </thead>  
    <tbody>
        <?php
        	$wi=0;
        	$w='';
			foreach ($datawork as $dw) {
				$wi++;
				$w .= '<tr>';
				$w .= '<td>'.$wi.'</td>';
				$w .= '<td>'.$dw->numlocation.'</td>';									
				$w .= '<td>'.date("d-m", strtotime($dw->appointed_date)).'-'.(date("Y", strtotime($dw->appointed_date))+543).'</td>';
				$w .= '<td>'. (($dw->retirecd_date == '0000-00-00') ? '-':date("d-m", strtotime($dw->retirecd_date)).'-'.(date("Y", strtotime($dw->retirecd_date))+543))  .'</td>';
				$w .= '<td>'.$dw->working_period.'</td>';
				$w .= '<td>'.$dw->position.'</td>';
				$w .= '<td>'.$dw->current_salary.'</td>';
				$w .= '<td>'.$dw->location.'</td>';
				$w .= '</tr>';
			}	
			echo $w;			
        ?>
    </tbody>
</table>
</div>
</div>
<?php } ?>

<br />

<?php
	if( count($datastudy) == 0){
		echo '<div class="uk-text-muted">ประวัติการศึกษา -</div>';
	}
	else
	{
?>
<div class="uk-panel uk-panel-box uk-panel-box-primary">
<div class="uk-overflow-container">
<table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
    <caption>ประวัติการศึกษา</caption>
    <thead>
        <tr>
        	<th></th>
            <th>วุฒิการศึกษา</th>
            <th>สาขา</th>
            <th>ปีที่จบ</th>
            <th>สถาบัน</th>          
        </tr>
    </thead>  
    <tbody>
        <?php
        	$si=0;
        	$s='';
			foreach ($datastudy as $dw) {
				$si++;
				$s .= '<tr>';
				$s .= '<td>'.$si.'</td>';									
				$s .= '<td>'.$dw->degree.'</td>';
				$s .= '<td>'.$dw->branch.'</td>';
				$s .= '<td>'.$dw->year.'</td>';
				$s .= '<td>'.$dw->institution.'</td>';					
				$s .= '</tr>';
			}		
			echo $s;			
        ?>
    </tbody>
</table>
</div>
</div>
<?php } ?>

<br />

<?php
	if( count($datasalary) == 0){
		echo '<div class="uk-text-muted">ประวัติตำแหน่งและเงินเดือน -</div>';
	}
	else
	{
?>
<div class="uk-panel uk-panel-box uk-panel-box-primary">
<div class="uk-overflow-container">
<table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
    <caption>ประวัติตำแหน่งและเงินเดือน</caption>
    <thead>
        <tr>
        	<th></th>
            <th>วันที่บรรจุ</th>
            <th>ตำแหน่ง</th>
            <th>สถานะ</th>
            <th>สถานที่ทำงาน</th>  
            <th>เงินเดือน</th>  
            <th>หมายเหตุ</th>      
        </tr>
    </thead>  
    <tbody>
        <?php
        	$ri=0;
        	$r='';
			foreach ($datasalary as $dw) {
				$ri++;
				$r .= '<tr>';
				$r .= '<td>'.$ri.'</td>';									
				$r .= '<td>';
				if( $dw->positiondate == '')
				{
					$r .= '-';
				}
				else
				{
					$r .= date("d-m", strtotime( $dw->positiondate )).'-'.(date("Y", strtotime( $dw->positiondate ))+543);
				}
				$r .='</td>';
				$r .= '<td>'.$dw->positionName.'</td>';
				$r .= '<td>'.$dw->level.'</td>';
				$r .= '<td>'.$dw->locationName.'</td>';	
				$r .= '<td>'.$dw->salary.'</td>';
				$r .= '<td>'.$dw->comment.'</td>';					
				$r .= '</tr>';
			}		
			echo $r;			
        ?>
    </tbody>
</table>
</div>
</div>
<?php } ?>

<br />

<?php
	if( count($dataleave) == 0){
		echo '<div class="uk-text-muted">ประวัติการลา -</div>';
	}
	else
	{
?>
<div class="uk-panel uk-panel-box uk-panel-box-primary uk-margin-bottom">
<div class="uk-overflow-container">
<table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
    <caption>ประวัติการลา</caption>
    <thead>
        <tr>
        	<th></th>
            <th>วันที่ขอ</th>
            <th>ประเภทการลา</th>
            <th>รายละเอียด</th>
            <th>ตั้งแต่วันที่</th>  
            <th>ถึงวันที่</th>    
            <th>จำนวนกี่วัน</th>    
        </tr>
    </thead>  
    <tbody>
        <?php
        	$li=0;
        	$l='';
			foreach ($dataleave as $dw) {
				$li++;
				$l .= '<tr>';
				$l .= '<td>'.$li.'</td>';									
				$l .= '<td>'.date("d-m", strtotime($dw->dateRequest)).'-'.(date("Y", strtotime($dw->dateRequest))+543).'</td>';
				$l .= '<td>'.$dw->leave_type_name.'</td>';
				$l .= '<td>'.$dw->leaveDetail.'</td>';
				$l .= '<td>'.date("d-m", strtotime($dw->startdate)).'-'.(date("Y", strtotime($dw->startdate))+543).'</td>';	
				$l .= '<td>'.date("d-m", strtotime($dw->enddate)).'-'.(date("Y", strtotime($dw->enddate))+543).'</td>';	
				$l .= '<td>'.$dw->totalleave.'</td>';						
				$l .= '</tr>';
			}		
			echo $l;			
        ?>
    </tbody>
</table>
</div>
</div>
<?php } ?>

@stop