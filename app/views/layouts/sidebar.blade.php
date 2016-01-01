<!doctype html>
<html>
<head>
	@include('includes.head')
</head>
<body>


	
	@include('includes.header')
	
	
	<div class="g-page">	
	    <div class="uk-grid uk-grid-small">
	    	<div class="uk-width-medium-2-10">
	    		<div class="g-menu g-background-content">
					@include('includes.sidebar')
				</div>
			</div>
			<div class="uk-width-medium-8-10">
				<div class="g-content g-background-content">
					<div class="uk-container uk-container-center">
						@yield('content')	
					</div>
				</div>
			</div>
		</div>	
	</div>
	
	@include('includes.footer')
	


</body>
</html>