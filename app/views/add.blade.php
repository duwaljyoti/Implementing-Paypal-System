@extends('template.default_template')
@section('content')
<h3>Create New {{$field}}</h3>
		{{Form::open(array('action' => 'MainController@add'))}}
	@if($field=="Category")
		
		
		{{ Form::hidden('field', 'category' ) }}
		Input New Category : {{Form::text('new_category_name')}}<p>
		{{ Form::submit('Create!')}}
	@elseif ($field=="Grade")
		{{ Form::hidden('field', 'grade' ) }}
		Input New Category : {{Form::text('new_grade_name')}}<p>
		{{ Form::submit('Create!')}}
	@endif
@stop
