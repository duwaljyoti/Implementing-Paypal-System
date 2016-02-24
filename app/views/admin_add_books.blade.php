@extends('template.default_template')
@section('content')  
{{link_to(URL::to('/admin'),"Home")}}
<P>
Add Books
	
	{{ Form::open(['url'=>'add_books']) }}
		Bookname:{{Form::text('bookname')}}<p>
		Book Author: {{Form::text('author')}}<p>
		Book Category: {{Form::select('category', array('Management' => 'Management', 'Science' => 'Science'),'Management')}}<p>
		Availability: {{Form::text('availability')}}<p>
		Grade: &nbsp {{Form::text('grade')}}<p>
		{{Form::submit('Add Book')}}
	{{Form::close()}}
@stop
