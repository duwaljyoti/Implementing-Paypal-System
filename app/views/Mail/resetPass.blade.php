@extends('template.default_template')
@section('content')

{{link_to('/','Home')}}
<p><p>

			@foreach($userDetails->toArray() as $fullDetails)
			<h3>Hi	{{ucfirst($fullDetails['name'])}}
			@endforeach
			</h3>
			<div id='error_messages'>{{Session::get('wrongcode')}}</div>
		{{ Form::open(['url'=>'resetPassword']) }}
		{{ Form::hidden('id', $userId ) }}
		Email address:
			@foreach($userDetails->toArray() as $fullDetails)
				{{ucfirst($fullDetails['email'])}}
			@endforeach
			<p>
		Input New Password <p>{{Form::password('newPassword')}}<p>
		{{$errors->first('newPassword')}}
		<p>

		Input previous Code<p>{{Form::password('prevCode' )}}<p>
		@if(isset($messages))
			{{$messages}}<p>
		@endif
		{{ Form::submit('Change!')}}

@stop
