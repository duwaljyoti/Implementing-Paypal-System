@extends('template.default_template')
@section('content')  
{{link_to(URL::to('/admin'),"Home")}}
<P>
Add Books
	
	{{ Form::open(['url'=>'add_books']) }}
		Bookname:{{Form::text('new_book_name')}}<p>
		Book Author: {{Form::text('new_author_name')}}<p>
		Book Category: {{Form::select('new_category_name', array('Management' => 'Management', 'Science' => 'Science'),'Management')}}<p>
		Availability: {{Form::text('new_avail')}}<p>
		Grade: &nbsp {{Form::text('new_grade')}}<p>
		{{Form::submit('Add Book')}}
	{{Form::close()}}
@stop
