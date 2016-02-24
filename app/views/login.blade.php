@extends('template.default_template')
@section('content')
<h3>{{link_to(URL::to('/'),"Home")}}</h3>
	<h2>Login Form</h2>
	{{ Form::open(['url'=>'login']) }}
	@if(isset($login_failed_message))
		<div id='error_messages'>{{$login_failed_message}}<p></div>
	@endif
			{{ Form::label('username', 'Username')}}
			 {{Form::text('username')}}
			 {{ $errors->first('username')}}<p>
			 <p>
			 {{ Form::label('password', 'Password')}}
			 {{Form::password('password')}}
			  {{ $errors->first('password')}}<p>
			 <p>
			 {{Form::submit('Click Me!')}}

		{{Form::close()}}
		{{link_to('/sign_up',"Sign Up")}}
@stop


