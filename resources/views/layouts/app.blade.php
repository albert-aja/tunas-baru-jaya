<!DOCTYPE html>
<html>
    <head>
        <title>{{ config('app.name') }}</title>
        @include('layouts.favicon')
        @include('layouts.description')
		@include('layouts.style')
	</head>
    <body class="hold-transition skin-custom sidebar-mini">
	    <div class="se-pre-con"></div>
		<div class="wrapper">
			@include('layouts.header')
			@include('layouts.sidebar')

			<div class="content-wrapper">
				<section class="content-header">
					@include('layouts.title')
					@stack('breadcrumbs')
				</section>

				@yield('content')				
			</div>
			@include('layouts.footer')
		</div>
		@include('layouts.script')
		@stack('page_scripts')
		@include('sweet::alert')    
    </body>

</html>