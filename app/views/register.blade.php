@extends('template.default_template')
@section('content')
	<h2>Admin's Home</h2>()<p>
	<?php   $data=Session::get('username');   ?>
	<?php   var_dump($data)?>
	<br><br><p>
	{{ link_to('logout',"Log Out")  }}
	
@stop