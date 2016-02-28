@extends('template.default_template')
@section('content')
	<h2>Forgot Password</h2>
	<div id='error_messages'>{{Session::get('forgetMessage')}}<p></div>
	{{ Form::open(['url'=>'sendDemo']) }}

			 {{ Form::label('email', 'Email')}}
			 {{Form::Email('email')}}
			  {{ $errors->first('email')}}<p>
			 <p>
			  {{ Form::label('pCode', 'Code')}}
			 {{Form::password('pCode')}}<p>
			 {{$errors->first('pCode')}}
			 <p>
			 {{Form::submit('Send Mail!')}}

		{{Form::close()}}
@stop
