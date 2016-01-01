@extends( 'layouts.sidebar' )
@section( 'content' )
<h4 class="tm-article-subtitle">
<ul class="uk-breadcrumb">
    <li><a href="{{ URL::to('admin/emps') }}">ข้อมูลพนักงาน</a></li>   
	<?php
		if( isset($emp) ){			 
	?>
		 <li><span>แก้ไขข้อมูลพนักงาน</span></li>
		 <li class="uk-active"><span>{{ $emp->pname }} {{ $emp->fname }} {{ $emp->lname }}</span></li>
	<?php } else{ ?>
		 <li class="uk-active"><span>เพิ่มข้อมูลพนักงาน</span></li>
	<?php } ?>	  
</ul>
</h4>
<div class="uk-grid uk-grid-small">
	<div class="uk-width-medium-1-1">
		<div class="uk-tab-center">
		<ul class="uk-tab" data-uk-tab="{connect:'#tab-content'}">
			<li class="uk-active">
				<a href="#a">ข้อมูลทั่วไป</a>
			</li>

			<?php
			if( Session::get('empcid') || isset($emp->cid) ){
			?>
			<li class="">
			<?php } else { ?>
			<li class="uk-disabled">
			<?php } ?>				
				<a href="#b">ข้อมูลการทำงาน</a>
			</li>

			<?php
			if( Session::get('empcid') || isset($emp->cid) ){
			?>
			<li class="">
			<?php } else { ?>
			<li class="uk-disabled">
			<?php } ?>	
				<a href="#c">ข้อมูลการศึกษา</a>
			</li>

			<?php
			if( Session::get('empcid') || isset($emp->cid) ){
			?>
			<li class="">
			<?php } else { ?>
			<li class="uk-disabled">
			<?php } ?>	
				<a href="#d">ข้อมูลเงินเดือน</a>
			</li>

			<?php
			if( Session::get('empcid') || isset($emp->cid) ){
			?>
			<li class="">
			<?php } else { ?>
			<li class="uk-disabled">
			<?php } ?>	
				<a href="#e">ข้อมูลการลา</a>
			</li>
		</ul>
		</div>
	</div>
	<div class="uk-width-medium-1-1">
		<div class="">
			<ul id="tab-content" class="uk-switcher">
				<li>
					<!--  TAB 1 datageneral -->
					<?php
						if( isset($emp) ){
						   $url = 'admin/emps/edit/'.$emp->cid;
					?>
						{{ Form::open( array( 'url' => $url, 'enctype' => 'multipart/form-data', 'class' => 'uk-form uk-form-horizontal uk-width-medium-1-1' ) ) }}
					<?php } else{ ?>
						{{ Form::open( array( 'url' => 'admin/emps/create', 'enctype' => 'multipart/form-data', 'class' => 'uk-form uk-form-horizontal uk-width-medium-1-1' ) ) }}
					<?php } ?>	

					<fieldset>
                    <div class="g-header-from uk-text-danger">สถานะปัจจุบัน</div>  
                    <div class="uk-form-row uk-width-1-2">  
                        <?php
                            if( isset($emp) ){
                        ?>
                           <input type="radio" <?php if($emp->status == 0) {echo "checked='true' ";}else{echo "";}  ?> name="status_work" value="0" id="status_work0"><label for="status_work0"> : ยังทำงาน</label> 
                        <?php } else{ ?>								
                           <input type="radio" name="status_work" value="0" id="status_work0"><label for="status_work0"> : ยังทำงาน</label> 
                        <?php } ?>
                    </div>  
                     <div class="uk-form-row uk-width-1-2">  
                          <?php
                            if( isset($emp) ){
                        ?>
                          <input type="radio" <?php if($emp->status == 1) {echo "checked='true' ";}else{echo "";}  ?> name="status_work" value="1" id="status_work1"><label for="status_work1"> : ไม่ทำงาน</label> 
                        <?php } else{ ?>								
                          <input type="radio" name="status_work" value="1" id="status_work1"><label for="status_work1"> : ไม่ทำงาน</label> 
                        <?php } ?>
                     </div>
                    
                        
					<div class="g-header-from uk-text-danger">ข้อมูลทั่วไป</div>  
						{{ Form::token() }}		

						<div class="uk-form-row uk-width-1-1">
							{{ Form::label( 'numlocation', 'เลข จ', array( 'class' => 'uk-form-label' ) ) }}
							<div class="uk-form-controls">
								<?php
									if( isset($emp) ){
								?>
									{{ Form::text( 'numlocation', $emp->numlocation, array( 'placeholder' => 'เลข จ', 'class' => 'uk-width-1-1' ) ) }}
								<?php } else{ ?>								
									{{ Form::text( 'numlocation', '', array( 'placeholder' => 'เลข จ', 'class' => 'uk-width-1-1' ) ) }}
								<?php } ?>
								@if ( $errors->has('numlocation') ) <p class="g-text-error uk-text-danger">{{ $errors->first('numlocation') }}</p> @endif
							</div>
						</div>
					    <div class="uk-form-row uk-width-1-1">
							{{ Form::label( 'pname', 'คำนำหน้า', array( 'class' => 'uk-form-label' ) ) }}
							<div class="uk-form-controls">			
							    <select id="pname_user" name="pname" class="uk-width-1-3">
							  		@foreach( $pname as $a )
							        <?php
										if( isset($emp) ){
									?>	
							  			<option <?php if($emp->pname == $a->pname) {echo "selected";}else{echo "";}  ?> value="{{ $a->pname }}">{{ $a->pname }}</option>
							        <?php } else{ ?>
							        	<option value="{{ $a->pname }}">{{ $a->pname }}</option>
							        <?php } ?>
							   		@endforeach
								</select>  			
							</div>
						</div>
						<div class="uk-form-row uk-width-1-1">
							{{ Form::label( 'fname', 'ชื่อ', array( 'class' => 'uk-form-label' ) ) }}
							<div class="uk-form-controls">
								<?php
									if( isset($emp) ){
								?>
									{{ Form::text( 'fname', $emp->fname, array( 'placeholder' => 'ชื่อ', 'class' => 'uk-width-1-1' ) ) }}
								<?php } else{ ?>
									{{ Form::text( 'fname', '', array( 'placeholder' => 'ชื่อ', 'class' => 'uk-width-1-1' ) ) }}
								<?php } ?>
								@if ( $errors->has('fname') ) <p class="g-text-error uk-text-danger">{{ $errors->first('fname') }}</p> @endif
							</div>
						</div>
						<div class="uk-form-row uk-width-1-1">
							{{ Form::label( 'lname', 'นามสกุล', array( 'class' => 'uk-form-label' ) ) }}
							<div class="uk-form-controls">
								<?php
									if( isset($emp) ){
								?>
									{{ Form::text( 'lname', $emp->lname, array( 'placeholder' => 'นามสกุล', 'class' => 'uk-width-1-1' ) ) }}
								<?php } else{ ?>
									{{ Form::text( 'lname', '', array( 'placeholder' => 'นามสกุล', 'class' => 'uk-width-1-1' ) ) }}
								<?php } ?>
								@if ( $errors->has('lname') ) <p class="g-text-error uk-text-danger">{{ $errors->first('lname') }}</p> @endif
							</div>
						</div>
						<div class="uk-form-row uk-width-1-1">
							{{ Form::label( 'birthday', 'วันเกิด (ว-ด-ป)', array( 'class' => 'uk-form-label' ) ) }}
							<div class="uk-form-controls">
								<?php
									if( isset($emp) ){
										$dateall = date("d-m", strtotime($emp->birthday)).'-'.(date("Y", strtotime($emp->birthday))+543);
								?>
									{{ Form::text( 'birthday', $dateall, array( 'id' => 'birthday', 'placeholder' => '__-__-____', 'class' => 'uk-width-1-1 birthday' ) ) }}
								<?php } else{ ?>
									{{ Form::text( 'birthday', '', array( 'id' => 'birthday', 'placeholder' => '__-__-____', 'class' => 'uk-width-1-1 birthday' ) ) }}
								<?php } ?>
								@if ( $errors->has('birthday') ) <p class="g-text-error uk-text-danger">{{ $errors->first('birthday') }}</p> @endif
							</div>
						</div>
						<div class="uk-form-row uk-width-1-1">
							{{ Form::label( 'cid', 'รหัสบัตรประชาชน', array( 'class' => 'uk-form-label' ) ) }}
							<div class="uk-form-controls">
								<?php
									if( isset($emp) ){
								?>
									{{ Form::text( 'cid', $emp->cid, array( 'placeholder' => 'รหัสบัตรประชาชน', 'class' => 'uk-width-1-1' ) ) }}
								<?php } else{ ?>
									{{ Form::text( 'cid', '', array( 'placeholder' => 'รหัสบัตรประชาชน', 'class' => 'uk-width-1-1' ) ) }}
								<?php } ?>
								@if ( $errors->has('cid') ) <p class="g-text-error uk-text-danger">{{ $errors->first('cid') }}</p> @endif
							</div>
						</div>
						<div class="uk-form-row uk-width-1-1">
							{{ Form::label( 'picture', 'รูปถ่าย', array( 'class' => 'uk-form-label' ) ) }}
							<div class="uk-form-controls">			
								<?php
									if( isset($emp) ){
								?>
									{{ Form::file('picture',  array(  'placeholder' => 'รูปถ่าย', 'class' => 'uk-width-1-1' ) ) }}	
								<?php } else{ ?>				
									{{ Form::file('picture',  array(  'placeholder' => 'รูปถ่าย', 'class' => 'uk-width-1-1' ) ) }}		
								<?php } ?>
								@if ( $errors->has('picture') ) <p class="g-text-error uk-text-danger">{{ $errors->first('picture') }}</p> @endif
							</div>
						</div>
						<?php
							if( isset($emp) ){
								if( $emp->picture != '' ){
									$urlimg = 'uploads/'.$emp->cid.'/'.$emp->picture;
						?>
								<div class="uk-form-row uk-width-1-1">
									<div class="uk-form-controls">	
									    <input type="hidden" name="nameimghid" id="nameimghid" value="<?php echo $emp->picture; ?>" />
										{{ HTML::image($urlimg, '', array('class' => 'uk-border-circle', 'height' => '100', 'width' => '100' ) ); }}
									</div>
								</div>
						<?php }} ?>

					<div class="g-header-from uk-text-danger">ข้อมูลที่อยู่</div>  

						<div class="uk-grid">
							<div class="uk-width-medium-1-2">
								<div class="uk-form-row uk-width-1-1">								   
									{{ Form::label( 'address', 'บ้านเลขที่', array( 'class' => 'uk-form-label' ) ) }}
									<div class="">
										<?php
											if( isset($emp) ){
										?>
											{{ Form::text( 'address', $emp->address, array( 'placeholder' => 'บ้านเลขที่', 'class' => 'uk-width-1-1' ) ) }}
										<?php } else{ ?>
											{{ Form::text( 'address', '', array( 'placeholder' => 'บ้านเลขที่', 'class' => 'uk-width-1-1' ) ) }}
										<?php } ?>
										@if ( $errors->has('address') ) <p class="g-text-error uk-text-danger">{{ $errors->first('address') }}</p> @endif
									</div>									
								</div>
								<div class="uk-form-row uk-width-1-1">
									{{ Form::label( 'amppart', 'อำเภอ', array( 'class' => 'uk-form-label' ) ) }}
									<div class="">
										<?php
											if( isset($emp) ){
										?>
											{{ Form::text( 'amppart', $emp->amppart, array( 'placeholder' => 'อำเภอ', 'class' => 'uk-width-1-1' ) ) }}
										<?php } else{ ?>
											{{ Form::text( 'amppart', '', array( 'placeholder' => 'อำเภอ', 'class' => 'uk-width-1-1' ) ) }}
										<?php } ?>
										@if ( $errors->has('amppart') ) <p class="g-text-error uk-text-danger">{{ $errors->first('amppart') }}</p> @endif
									</div>
								</div>
								<div class="uk-form-row uk-width-1-1">
									{{ Form::label( 'zipcode', 'รหัสไปรษณีย์', array( 'class' => 'uk-form-label' ) ) }}
									<div class="">
										<?php
											if( isset($emp) ){
										?>
											{{ Form::text( 'zipcode', $emp->zipcode, array( 'placeholder' => 'รหัสไปรษณีย์', 'class' => 'uk-width-1-1' ) ) }}
										<?php } else{ ?>
											{{ Form::text( 'zipcode', '', array( 'placeholder' => 'รหัสไปรษณีย์', 'class' => 'uk-width-1-1' ) ) }}
										<?php } ?>
										@if ( $errors->has('zipcode') ) <p class="g-text-error uk-text-danger">{{ $errors->first('zipcode') }}</p> @endif
									</div>
								</div>
							</div>
							<div class="uk-width-medium-1-2">
								<div class="uk-form-row uk-width-1-1">
									{{ Form::label( 'tmbpart', 'ตำบล', array( 'class' => 'uk-form-label' ) ) }}
									<div class="">
										<?php
											if( isset($emp) ){
										?>
											{{ Form::text( 'tmbpart', $emp->tmbpart, array( 'placeholder' => 'ตำบล', 'class' => 'uk-width-1-1' ) ) }}
										<?php } else{ ?>
											{{ Form::text( 'tmbpart', '', array( 'placeholder' => 'ตำบล', 'class' => 'uk-width-1-1' ) ) }}
										<?php } ?>
										@if ( $errors->has('tmbpart') ) <p class="g-text-error uk-text-danger">{{ $errors->first('tmbpart') }}</p> @endif
									</div>
								</div>
								<div class="uk-form-row uk-width-1-1">
									{{ Form::label( 'chwpart', 'จังหวัด', array( 'class' => 'uk-form-label' ) ) }}
									<div class="">
										<?php
											if( isset($emp) ){
										?>
											{{ Form::text( 'chwpart', $emp->chwpart, array( 'placeholder' => 'จังหวัด', 'class' => 'uk-width-1-1' ) ) }}
										<?php } else{ ?>
											{{ Form::text( 'chwpart', '', array( 'placeholder' => 'จังหวัด', 'class' => 'uk-width-1-1' ) ) }}
										<?php } ?>
										@if ( $errors->has('chwpart') ) <p class="g-text-error uk-text-danger">{{ $errors->first('chwpart') }}</p> @endif
									</div>
								</div>
							</div>
						</div>
					
					<div class="g-header-from uk-text-danger">ข้อมูลติดต่อ</div>

						<div class="uk-grid">
							<div class="uk-width-medium-1-2">
								<div class="uk-form-row uk-width-1-1">								   
									{{ Form::label( 'tel', 'เบอร์บ้าน', array( 'class' => 'uk-form-label' ) ) }}
									<div class="">
										<?php
											if( isset($emp) ){
										?>
											{{ Form::text( 'tel', $emp->tel, array( 'placeholder' => 'เบอร์บ้าน', 'class' => 'uk-width-1-1' ) ) }}
										<?php } else{ ?>
											{{ Form::text( 'tel', '', array( 'placeholder' => 'เบอร์บ้าน', 'class' => 'uk-width-1-1' ) ) }}
										<?php } ?>
										@if ( $errors->has('tel') ) <p class="g-text-error uk-text-danger">{{ $errors->first('tel') }}</p> @endif
									</div>									
								</div>	
								<div class="uk-form-row uk-width-1-1">								   
									{{ Form::label( 'email', 'อีเมล์', array( 'class' => 'uk-form-label' ) ) }}
									<div class="">
										<?php
											if( isset($emp) ){
										?>
											{{ Form::text( 'email', $emp->email, array( 'placeholder' => 'อีเมล์', 'class' => 'uk-width-1-1' ) ) }}
										<?php } else{ ?>
											{{ Form::text( 'email', '', array( 'placeholder' => 'อีเมล์', 'class' => 'uk-width-1-1' ) ) }}
										<?php } ?>
										@if ( $errors->has('email') ) <p class="g-text-error uk-text-danger">{{ $errors->first('email') }}</p> @endif
									</div>									
								</div>	
							</div>
							<div class="uk-width-medium-1-2">
								<div class="uk-form-row uk-width-1-1">
									{{ Form::label( 'mobile', 'เบอร์มือถือ', array( 'class' => 'uk-form-label' ) ) }}
									<div class="">
										<?php
											if( isset($emp) ){
										?>
											{{ Form::text( 'mobile', $emp->mobile, array( 'placeholder' => 'เบอร์มือถือ', 'class' => 'uk-width-1-1' ) ) }}
										<?php } else{ ?>
											{{ Form::text( 'mobile', '', array( 'placeholder' => 'เบอร์มือถือ', 'class' => 'uk-width-1-1' ) ) }}
										<?php } ?>
										@if ( $errors->has('mobile') ) <p class="g-text-error uk-text-danger">{{ $errors->first('mobile') }}</p> @endif
									</div>
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

				</li>
				<li>
					<!--  TAB 2 data work -->
						<?php
							if( isset($emp) ){
							   $url2 = 'admin/emps/creatework/'.$emp->cid;
						?>						 
						{{ Form::open( array( 'id' => 'form-addwork', 'url' => $url2, 'class' => 'uk-form uk-form-horizontal uk-width-medium-1-1' ) ) }}
						<input type="hidden" name="cidwork" id="cidwork" value="<?php echo $emp->cid; ?>" />
						<?php 
							} 
							else
							{ 
								$url2 = 'admin/emps/creatework/'.Session::get('empcid'); 
						?>							 
							{{ Form::open( array( 'id' => 'form-addwork', 'url' => $url2, 'class' => 'uk-form uk-form-horizontal uk-width-medium-1-1' ) ) }}
							<input type="hidden" name="cidwork" id="cidwork" value="<?php echo Session::get('empcid'); ?>" />
						<?php } ?>	

						<fieldset>
						<div class="g-header-from uk-text-danger">ข้อมูลการทำงาน 
							<?php
								if( isset($emp) ){
							?>
								<span class="uk-text-primary"> <?php  echo $emp->pname.$emp->fname.' '.$emp->lname;  ?> </span> 
							<?php } else{ ?>
								<span class="uk-text-primary"> <?php echo Session::get('emppname').Session::get('empfname').' '.Session::get('emplname'); ?> </span> 
							<?php } ?>
						</div>  
							{{ Form::token() }}	
							<div class="uk-grid">
								<div class="uk-width-medium-1-2">
									<div class="uk-form-row uk-width-1-1">
										{{ Form::label( 'numlocation', 'เลข จ.', array( 'class' => 'uk-form-label' ) ) }}
										<div class="uk-form-controls">													
											{{ Form::text( 'numlocation', '', array( 'placeholder' => 'เลข จ.', 'class' => 'uk-width-1-1' ) ) }}																			
										</div>
									</div>
									<div class="uk-form-row uk-width-1-1">
										{{ Form::label( 'appointed_date', 'วันที่บรรจุ (ว-ด-ป)', array( 'class' => 'uk-form-label' ) ) }}
										<div class="uk-form-controls">													
											{{ Form::text( 'appointed_date', '', array( 'id' => "appointed_date", 'placeholder' => '__-__-____', 'class' => 'uk-width-1-1 appointed_date' ) ) }}																			
										</div>
									</div>
									<div class="uk-form-row uk-width-1-1">
										{{ Form::label( 'retirecd_date', 'วันออกงาน (ว-ด-ป)', array( 'class' => 'uk-form-label' ) ) }}
										<div class="uk-form-controls">													
											{{ Form::text( 'retirecd_date', '', array( 'id' => "retirecd_date", 'placeholder' => '__-__-____', 'class' => 'uk-width-1-1 retirecd_date' ) ) }}																			
										</div>
									</div>
									<div class="uk-form-row uk-width-1-1">
										{{ Form::label( 'current_salary', 'เงินเดือน', array( 'class' => 'uk-form-label' ) ) }}
										<div class="uk-form-controls">													
											{{ Form::text( 'current_salary', '', array( 'placeholder' => 'เงินเดือน', 'class' => 'uk-width-1-1' ) ) }}								
											<p id="current_salary_error" class="g-text-error uk-text-danger"></p> 
										</div>
									</div>
								</div>
								<div class="uk-width-medium-1-2">
									<div class="uk-form-row uk-width-1-1">
										{{ Form::label( 'working_period', 'รวมเวลาปัฏิบัติงาน', array( 'class' => 'uk-form-label' ) ) }}
										<div class="uk-form-controls">													
											{{ Form::text( 'working_period', '', array( 'placeholder' => 'รวมเวลาปัฏิบัติงาน', 'class' => 'uk-width-1-1' ) ) }}								
											<p id="working_period_error" class="g-text-error uk-text-danger"></p> 
										</div>
									</div>
									<div class="uk-form-row uk-width-1-1">
										{{ Form::label( 'position', 'ตำแหน่ง', array( 'class' => 'uk-form-label' ) ) }}
										<div class="uk-form-controls">													
											{{ Form::text( 'position', '', array( 'placeholder' => 'ตำแหน่ง', 'class' => 'uk-width-1-1' ) ) }}								
											<p id="position_error" class="g-text-error uk-text-danger"></p> 
										</div>
									</div>
									<div class="uk-form-row uk-width-1-1">
										{{ Form::label( 'location', 'สถานที่ทำงาน', array( 'class' => 'uk-form-label' ) ) }}
										<div class="uk-form-controls">													
											{{ Form::text( 'location', '', array( 'placeholder' => 'สถานที่ทำงาน', 'class' => 'uk-width-1-1' ) ) }}																			
										</div>
									</div>
								</div>
							</div>
							<hr />
							<div class="uk-form-row uk-text-center">							
								{{Form::button( 'บันทึก', array( 'class'=>'uk-button uk-button-primary', 'id' => 'btnSubmitwork' ) )}}						
							</div>
						 	<hr />	
						</fieldset>	
						{{ Form::close() }}

						<div id="datawork">
							<div class="uk-overflow-container">							
							<?php
								if( isset($datawork) )
								{
									$w = '<table  class="uk-table uk-table-hover uk-table-striped uk-table-condensed" >';
									$w .= '<thead>';
									$w .= '<tr>';
									$w .= ' <th>ลำดับ</th> <th>เลข จ.</th> <th>วันที่บรรจุ</th> <th>วันออกงาน</th> <th>รวมเวลาปฎิบัติงาน</th> <th>ตำแหน่ง</th> <th>เงินเดือน</th> <th>สถานที่ทำงาน</th> <th>ลบ</th>';
									$w .= '</tr>';
									$w .= '</thead>';
									$w .= '<tbody>';
									$wi=0;
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
                                        $w .= '<td>'.'<a href="del_datawork/'.$dw->workID.'/'.$dw->cid.'" title="ลบ" ><i class="uk-icon-trash-o"></i></a>'.'</td>';
										$w .= '</tr>';
									}				
									$w .= '</tbody>';
									$w .= '</table>';

									echo $w;
								}
							?>
							</div>
						</div>										
				</li>
				<li>
						<!--  TAB 3 data study -->
						<?php
							if( isset($emp) ){
							   $url3 = 'admin/emps/createstudy/'.$emp->cid;
						?>						 
						{{ Form::open( array( 'id' => 'form-addstudy', 'url' => $url3, 'class' => 'uk-form uk-form-horizontal uk-width-medium-1-1' ) ) }}
						<input type="hidden" name="cidstudy" id="cidstudy" value="<?php echo $emp->cid; ?>" />
						<?php 
							} 
							else
							{ 
								$url3 = 'admin/emps/createstudy/'.Session::get('empcid'); 
						?>							 
							{{ Form::open( array( 'id' => 'form-addstudy', 'url' => $url3, 'class' => 'uk-form uk-form-horizontal uk-width-medium-1-1' ) ) }}
							<input type="hidden" name="cidstudy" id="cidstudy" value="<?php echo Session::get('empcid'); ?>" />
						<?php } ?>	

						<fieldset>
						<div class="g-header-from uk-text-danger">ข้อมูลการศึกษา 
							<?php
								if( isset($emp) ){
							?>
								<span class="uk-text-primary"> <?php  echo $emp->pname.$emp->fname.' '.$emp->lname;  ?> </span> 
							<?php } else{ ?>
								<span class="uk-text-primary"> <?php echo Session::get('emppname').Session::get('empfname').' '.Session::get('emplname'); ?> </span> 
							<?php } ?>
						</div>  
							{{ Form::token() }}								
								
								<div class="uk-form-row uk-width-1-1">
									{{ Form::label( 'degree', 'วุฒิการศึกษา', array( 'class' => 'uk-form-label' ) ) }}
									<div class="uk-form-controls">													
										{{ Form::text( 'degree', '', array( 'placeholder' => 'วุฒิการศึกษา', 'class' => 'uk-width-1-1' ) ) }}
										<p id="degree_error" class="g-text-error uk-text-danger"></p>																			
									</div>
								</div>
								<div class="uk-form-row uk-width-1-1">
									{{ Form::label( 'branch', 'สาขา', array( 'class' => 'uk-form-label' ) ) }}
									<div class="uk-form-controls">													
										{{ Form::text( 'branch', '', array( 'placeholder' => 'สาขา', 'class' => 'uk-width-1-1' ) ) }}
										<p id="branch_error" class="g-text-error uk-text-danger"></p>																			
									</div>
								</div>																					
								<div class="uk-form-row uk-width-1-1">
									{{ Form::label( 'year', 'จบปี', array( 'class' => 'uk-form-label' ) ) }}
									<div class="uk-form-controls">													
										{{ Form::text( 'year', '', array( 'placeholder' => 'จบปี', 'class' => 'uk-width-1-1' ) ) }}																	
									</div>
								</div>
								<div class="uk-form-row uk-width-1-1">
									{{ Form::label( 'institution', 'สถาบัน', array( 'class' => 'uk-form-label' ) ) }}
									<div class="uk-form-controls">													
										{{ Form::text( 'institution', '', array( 'placeholder' => 'สถาบัน', 'class' => 'uk-width-1-1' ) ) }}								
										<p id="institution_error" class="g-text-error uk-text-danger"></p> 
									</div>
								</div>								
							
							<hr />
							<div class="uk-form-row uk-text-center">							
								{{Form::button( 'บันทึก', array( 'class'=>'uk-button uk-button-primary', 'id' => 'btnSubmitstudy' ) )}}						
							</div>
						 	<hr />	
						</fieldset>	
						{{ Form::close() }}

						<div id="datastudy">
							<div class="uk-overflow-container">							
							<?php
								if( isset($datastudy) )
								{
									$s = '<table  class="uk-table uk-table-hover uk-table-striped uk-table-condensed" >';
									$s .= '<thead>';
									$s .= '<tr>';
									$s .= ' <th>ลำดับ</th> <th>วุฒิการศึกษา</th> <th>สาขา</th> <th>ปีที่จบ</th> <th>สถาบัน</th> <th>ลบ</th>';
									$s .= '</tr>';
									$s .= '</thead>';
									$s .= '<tbody>';
									$si=0;
									foreach ($datastudy as $dw) {
										$si++;
										$s .= '<tr>';
										$s .= '<td>'.$si.'</td>';									
										$s .= '<td>'.$dw->degree.'</td>';
										$s .= '<td>'.$dw->branch.'</td>';
										$s .= '<td>'.$dw->year.'</td>';
										$s .= '<td>'.$dw->institution.'</td>';	
                                        $s .= '<td>'.'<a href="del_datastudy/'.$dw->studyID.'/'.$dw->cid.'" title="ลบ" ><i class="uk-icon-trash-o"></i></a>'.'</td>';
										$s .= '</tr>';
									}				
									$s .= '</tbody>';
									$s .= '</table>';

									echo $s;
								}
							?>
							</div>
						</div>
				</li>
				<li>
						<!--  TAB 4 data salary -->
						<?php
							if( isset($emp) ){
							   $url4 = 'admin/emps/createsalary/'.$emp->cid;
						?>						 
						{{ Form::open( array( 'id' => 'form-addsalary', 'url' => $url4, 'class' => 'uk-form uk-form-horizontal uk-width-medium-1-1' ) ) }}
						<input type="hidden" name="cidsalary" id="cidsalary" value="<?php echo $emp->cid; ?>" />
						<?php 
							} 
							else
							{ 
								$url4 = 'admin/emps/createsalary/'.Session::get('empcid'); 
						?>							 
							{{ Form::open( array( 'id' => 'form-addsalary', 'url' => $url4, 'class' => 'uk-form uk-form-horizontal uk-width-medium-1-1' ) ) }}
							<input type="hidden" name="cidsalary" id="cidsalary" value="<?php echo Session::get('empcid'); ?>" />
						<?php } ?>	

						<fieldset>
						<div class="g-header-from uk-text-danger">ข้อมูลตำแหน่งงานและเงินเดือน 
							<?php
								if( isset($emp) ){
							?>
								<span class="uk-text-primary"> <?php  echo $emp->pname.$emp->fname.' '.$emp->lname;  ?> </span> 
							<?php } else{ ?>
								<span class="uk-text-primary"> <?php echo Session::get('emppname').Session::get('empfname').' '.Session::get('emplname'); ?> </span> 
							<?php } ?>
						</div>  
							{{ Form::token() }}								
								
								<div class="uk-form-row uk-width-1-1">
									{{ Form::label( 'positiondate', 'วันที่บรรจุ (ว-ด-ป)', array( 'class' => 'uk-form-label' ) ) }}
									<div class="uk-form-controls">													
										{{ Form::text( 'positiondate', '', array( 'id' => "positiondate", 'placeholder' => '__-__-____', 'class' => 'uk-width-1-1 positiondate' ) ) }}																			
										<p id="positiondate_error" class="g-text-error uk-text-danger"></p>	
									</div>
								</div>
								<div class="uk-form-row uk-width-1-1">
									{{ Form::label( 'position_id', 'ตำแหน่ง', array( 'class' => 'uk-form-label' ) ) }}
									<div class="uk-form-controls">			
									    <select name="position_id" class="uk-width-1-1">
									  		@foreach( $position as $p )									        
									        	<option value="{{ $p->position_id }}">{{ $p->positionName }}</option>								        
									   		@endforeach
										</select>  			
									</div>
								</div>
								<div class="uk-form-row uk-width-1-1">
									{{ Form::label( 'level', 'สถานะ', array( 'class' => 'uk-form-label' ) ) }}
									<div class="uk-form-controls">
										<select name="level" class="uk-width-1-3">							  										        
									        <option value="พกส.(ปฏิบัติงาน)">พกส.(ปฏิบัติงาน)</option>								        
									   		<option value="ลูกจ้างประจำ">ลูกจ้างประจำ</option>
									   		<option value="ข้าราชการ">ข้าราชการ</option>
									   		<option value="ลูกจ้างชั่วคราว">ลูกจ้างชั่วคราว</option>
									   		<option value="ลูกจ้างรายวัน">ลูกจ้างรายวัน</option>
									   		<option value="อื่น ๆ">อื่น ๆ</option>
										</select>  
									</div>
								</div>
								<div class="uk-form-row uk-width-1-1">
									{{ Form::label( 'location_id', 'สถานที่ทำงาน', array( 'class' => 'uk-form-label' ) ) }}
									<div class="uk-form-controls">			
									    <select name="location_id" class="uk-width-1-1">
									  		@foreach( $location as $d )									        
									        	<option value="{{ $d->location_id }}">{{ $d->locationName }}</option>								        
									   		@endforeach
										</select>  			
									</div>
								</div>
								<div class="uk-form-row uk-width-1-1">
									{{ Form::label( 'salary', 'เงินเดือน', array( 'class' => 'uk-form-label' ) ) }}
									<div class="uk-form-controls">													
										{{ Form::text( 'salary', '', array( 'placeholder' => 'เงินเดือน', 'class' => 'uk-width-1-1' ) ) }}
										<p id="salary_error" class="g-text-error uk-text-danger"></p>																			
									</div>
								</div>
								<div class="uk-form-row uk-width-1-1">
									{{ Form::label( 'comment', 'หมายเหตุ', array( 'class' => 'uk-form-label' ) ) }}
									<div class="uk-form-controls">													
										{{ Form::text( 'comment', '', array( 'placeholder' => 'หมายเหตุ', 'class' => 'uk-width-1-1' ) ) }}																												
									</div>
								</div>
													
							
							<hr />
							<div class="uk-form-row uk-text-center">							
								{{Form::button( 'บันทึก', array( 'class'=>'uk-button uk-button-primary', 'id' => 'btnSubmitsalary' ) )}}						
							</div>
						 	<hr />	
						</fieldset>	
						{{ Form::close() }}

						<div id="datasalary">
							<div class="uk-overflow-container">
							<?php
								if( isset($datasalary) )
								{
									$r = '<table  class="uk-table uk-table-hover uk-table-striped uk-table-condensed" >';
									$r .= '<thead>';
									$r .= '<tr>';
									$r .= ' <th>ลำดับ</th> <th>วันที่บรรจุ</th> <th>ตำแหน่ง</th> <th>สถานะ</th> <th>สถานที่ทำงาน</th> <th>เงินเดือน</th> <th>หมายเหตุ</th> <th>ลบ</th>';
									$r .= '</tr>';
									$r .= '</thead>';
									$r .= '<tbody>';
									$ri=0;
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
                                        $r .= '<td>'.'<a href="del_datasalary/'.$dw->salaryID.'/'.$dw->cid.'" title="ลบ" ><i class="uk-icon-trash-o"></i></a>'.'</td>';
                                        
										$r .= '</tr>';
									}				
									$r .= '</tbody>';
									$r .= '</table>';

									echo $r;
								}
							?>
							</div>
						</div>
				</li>
				<li>
						<!--  TAB 5 data leave -->
						<?php
							if( isset($emp) ){
							   $url5 = 'admin/emps/createleave/'.$emp->cid;
						?>						 
						{{ Form::open( array( 'id' => 'form-addleave', 'url' => $url5, 'class' => 'uk-form uk-form-horizontal uk-width-medium-1-1' ) ) }}
						<input type="hidden" name="cidleave" id="cidleave" value="<?php echo $emp->cid; ?>" />
						<?php 
							} 
							else
							{ 
								$url5 = 'admin/emps/createleave/'.Session::get('empcid'); 
						?>							 
							{{ Form::open( array( 'id' => 'form-addleave', 'url' => $url5, 'class' => 'uk-form uk-form-horizontal uk-width-medium-1-1' ) ) }}
							<input type="hidden" name="cidleave" id="cidleave" value="<?php echo Session::get('empcid'); ?>" />
						<?php } ?>	

						<fieldset>
						<div class="g-header-from uk-text-danger">ข้อมูลการลา
							<?php
								if( isset($emp) ){
							?>
								<span class="uk-text-primary"> <?php  echo $emp->pname.$emp->fname.' '.$emp->lname;  ?> </span> 
							<?php } else{ ?>
								<span class="uk-text-primary"> <?php echo Session::get('emppname').Session::get('empfname').' '.Session::get('emplname'); ?> </span> 
							<?php } ?>
						</div>  
							{{ Form::token() }}	

								<div class="uk-grid">
								<div class="uk-width-medium-1-2">
									<div class="uk-form-row uk-width-1-1">
										{{ Form::label( 'dateRequest', 'วันที่ขอ (ว-ด-ป)', array( 'class' => 'uk-form-label' ) ) }}
										<div class="uk-form-controls">													
											{{ Form::text( 'dateRequest', '', array( 'id' => "dateRequest", 'placeholder' => '__-__-____', 'class' => 'uk-width-1-1 dateRequest' ) ) }}																			
											<p id="dateRequest_error" class="g-text-error uk-text-danger"></p>	
										</div>
									</div>
								</div>
								<div class="uk-width-medium-1-2">
									<div class="uk-form-row uk-width-1-1">
										{{ Form::label( 'leave_type_id', 'ประเภทการลา', array( 'class' => 'uk-form-label' ) ) }}
										<div class="uk-form-controls">			
										    <select name="leave_type_id" class="uk-width-1-1">
										  		@foreach( $leave_type as $lt )									        
										        	<option value="{{ $lt->leave_type_id }}">{{ $lt->leave_type_name }}</option>								        
										   		@endforeach
											</select>  			
										</div>
									</div>
								</div>
								</div>

								<br />
								<div class="uk-form-row uk-width-1-1">
									{{ Form::label( 'leaveDetail', 'รายละเอียด', array( 'class' => 'uk-form-label' ) ) }}
									<div class="uk-form-controls">													
										{{ Form::text( 'leaveDetail', '', array( 'placeholder' => 'รายละเอียด', 'class' => 'uk-width-1-1' ) ) }}
										<p id="leaveDetail_error" class="g-text-error uk-text-danger"></p>																			
									</div>
								</div>
								<br />

								<div class="uk-grid">
								<div class="uk-width-medium-1-2">
									<div class="uk-form-row uk-width-1-1">
										{{ Form::label( 'startdate', 'ตั้งแต่วันที่ (ว-ด-ป)', array( 'class' => 'uk-form-label' ) ) }}
										<div class="uk-form-controls">													
											{{ Form::text( 'startdate', '', array( 'id' => "startdate", 'placeholder' => '__-__-____', 'class' => 'uk-width-1-1 startdate' ) ) }}																			
											<p id="startdate_error" class="g-text-error uk-text-danger"></p>	
										</div>
									</div>
									<div class="uk-form-row uk-width-1-1">
										{{ Form::label( 'totalleave', 'จำนวนกี่วัน', array( 'class' => 'uk-form-label' ) ) }}
										<div class="uk-form-controls">													
											{{ Form::text( 'totalleave', '', array( 'placeholder' => 'จำนวนกี่วัน', 'class' => 'uk-width-1-1' ) ) }}
											<p id="totalleave_error" class="g-text-error uk-text-danger"></p>																			
										</div>
									</div>
									
								</div>
								<div class="uk-width-medium-1-2">
									<div class="uk-form-row uk-width-1-1">
										{{ Form::label( 'enddate', 'ถึงวันที่ (ว-ด-ป)', array( 'class' => 'uk-form-label' ) ) }}
										<div class="uk-form-controls">													
											{{ Form::text( 'enddate', '', array( 'id' => "enddate", 'placeholder' => '__-__-____', 'class' => 'uk-width-1-1 enddate' ) ) }}		
											<p id="enddate_error" class="g-text-error uk-text-danger"></p>																												
										</div>
									</div>									
								</div>
								</div>
								<br />
													
							
							<hr />
							<div class="uk-form-row uk-text-center">							
								{{Form::button( 'บันทึก', array( 'class'=>'uk-button uk-button-primary', 'id' => 'btnSubmitleave' ) )}}						
							</div>
						 	<hr />	
						</fieldset>	
						{{ Form::close() }}

						<div id="dataleave">
							<div class="uk-overflow-container">
							<?php
								if( isset($dataleave) )
								{
									$l = '<table  class="uk-table uk-table-hover uk-table-striped uk-table-condensed" >';
									$l .= '<thead>';
									$l .= '<tr>';
									$l .= ' <th>ลำดับ</th> <th>วันที่ขอ</th> <th>ประเภทการลา</th> <th>รายละเอียด</th> <th>ตั้งแต่วันที่</th> <th>ถึงวันที่</th> <th>จำนวนกี่วัน</th> ';
									$l .= '</tr>';
									$l .= '</thead>';
									$l .= '<tbody>';
									$li=0;
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
									$l .= '</tbody>';
									$l .= '</table>';

									echo $l;
								}
							?>
							</div>
						</div>

				</li>
			</ul>
		</div>
	</div>
</div>
	
@stop