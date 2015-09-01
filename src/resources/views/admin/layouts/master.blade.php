<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	
    <title>Hello Laravel 5 | @yield('headTitle')</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
	<meta name="csrf-token" content="{!! csrf_token() !!}" />
	
	@include('titanwall::admin.partials.header-media')

    {!! Html::script('vendor/odenktools/global/plugins/jquery.min.js') !!}

</head>


<body>

<!-- BEGIN FOOTER -->
@include('titanwall::admin.partials.footer')
<!-- END FOOTER -->

<!-- END CORE PLUGINS -->

<!-- START custom javascript -->
{!! Html::script('vendor/odenktools/app/index.js') !!}
<!-- END custom javascript -->

<!-- -->

<script type="text/javascript">
	
	window.base_url = '{!! URL::to("/") !!}/';
	
	window.token = $('meta[name="csrf-token"]').attr('content');

</script>

	@yield('jsOnFooter')
	
</body>

</html>
