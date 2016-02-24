<!DOCTYPE html>
<html>
<head>
<title>@yield('title')</title>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script type="text/javascript">
	function demo_js($sth){
		console.log('helo from demojs');
		 edit_jq();
	}

</script>
<link rel="stylesheet" href="{{ URL::asset('css/style.css') }}" />
<script type="text/javascript" src=""{{ URL::asset('assets/js/my_js.js') }}""> </script>

	<title></title>
</head>
<body>
	@yield ('content')
</body>
</html>