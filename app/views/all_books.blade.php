@extends('template.default_template')
@section('title')
	All Books
@stop

@section('content')
	<h2>All Books Section</h2>
		@foreach($all_books_data as $key)
			<p>{{link_to('single_book/'.$key['id'],$key['BookName'] )}}
		@endforeach
@stop
