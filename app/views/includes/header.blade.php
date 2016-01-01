
<div class="g-header uk-clearfix" data-uk-sticky>									
					
		<nav class="uk-navbar">
			<a href="{{ URL::to('/') }}" class="uk-navbar-brand uk-hidden-small"><span class="uk-text-success">EMP360</span> <span class="uk-text-danger">SYSTEMS.</span></a>
			<ul class="uk-navbar-nav uk-navbar-flip">
				<li class="uk-parent" data-uk-dropdown="">
					<a href="">
						<?php
							$urlimg_login='';
							$ckfile='';
							$dir = 'uploads/'.Session::get('cid');
							if ( file_exists( $dir ) && is_dir( $dir ) ) {
								$handle = opendir( $dir );
								while ( $entry = readdir($handle) ) 
								{
									if(($entry==".")||($entry=="..")){ continue; }
									  $urlimg_login = 'uploads/'.Session::get('cid').'/'.$entry;
									  $ckfile = $entry;
								}
								closedir($handle);	
							}											
						?>
							<?php if( $ckfile != '' ) {?>
						{{ HTML::image($urlimg_login, '', array('class' => 'uk-border-circle', 'height' => '40', 'width' => '40' ) ); }}
						<?php } else {?>
							{{ HTML::image('assets/images/avatar04.png', '', array('class' => 'uk-border-circle', 'height' => '40', 'width' => '40' ) ); }}
						<?php } ?>
					</a>
					<div class="uk-dropdown uk-dropdown-navbar" style="">													
						<div class="uk-text-center">{{ HTML::image($urlimg_login, '', array('class' => 'uk-border-circle', 'height' => '100', 'width' => '100' ) ); }}</div>
						<div class="uk-thumbnail-caption">
							<?php
				        		echo Session::get('pname').Session::get('fname').' '.Session::get('lname');
				        	?>
							<div class="uk-grid uk-grid-small">
								<div class="uk-width-medium-1-2 uk-text-center">
									<a class="uk-button uk-button-primary" href="{{ URL::to( 'admin/users/edit/' ) }}<?php echo '/'.Session::get('userid'); ?>">แก้ไข</a>
								</div>
								<div class="uk-width-medium-1-2 uk-text-center">
									@if ( Auth::check() )									       
								        <a class="uk-button uk-button-primary" href="{{ URL::to( 'logout' ) }}">ออกระบบ</a>									        	       		   
								    @endif
								</div>
							</div>
						</div>				
					</div>
				</li>								
			</ul>
								
			<div class="uk-height-1-1 uk-vertical-align uk-text-center">
				<div class="uk-vertical-align-middle">						
				<div class="uk-visible-small uk-text-large"><span class="uk-text-success">EMP360</span> <span class="uk-text-danger">SYSTEMS.</span></div>				
				</div>
			</div>
		</nav>	
						
</div>