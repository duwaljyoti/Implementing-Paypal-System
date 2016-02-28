@extends('template.default_template')
@section('title')
    Home--E Library
@stop
@section('content')
	<h2>E-Library</h2>
	<h3>Sign Up</h3>

		{{Form::open(['url'=>'final_sign_up'])}}
			{{ Form::label('name', 'Name')}}: &nbsp
			 {{Form::text('name')}} <p>{{ $errors->first('name')}}<p>

			 {{ Form::label('Email', 'Email')}}: &nbsp
			 {{Form::text('email')}}<p>{{ $errors->first('email')}}<p>

			 {{ Form::label('username', 'Username')}}: &nbsp
			 {{Form::text('email')}} <p>{{ $errors->first('email')}}<p>

			 {{ Form::label('password')}}: &nbsp
			 {{Form::password('password')}}<p>{{ $errors->first('password')}}<p>

			 {{ Form::label('grade', 'Grade')}}: &nbsp
			 {{Form::text('grade')}} <p> {{ $errors->first('grade')}}<p>

			 {{ Form::label('Faculty', 'Faculty')}}: &nbsp
			 {{Form::text('faculty')}} <p> {{ $errors->first('faculty')}}<p>
			 {{Form::submit('Sign Up!')}}
		{{Form::close()}}
@stop
