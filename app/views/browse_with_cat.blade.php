@extends('template.default_template')
@section('title')
	Category
@stop

@section('content')
{{link_to(URL::to('/'),"Home")}}
	<p>Category Name: {{$book['cat_name']}}
	@foreach($book['result'] as $book_detail=>$value)			
			<p>{{link_to('single_book/'.$value['id'],$value['BookName'] )}}

	@endforeach
@stop
