@extends('template.default_template')
@section('title')
	Category
@stop

@section('content')
{{link_to(URL::to('/'),"Home")}}
	<h2>Category Name: {{$book['cat_name']}}</h2>
	<p><i>Books Found in {{$book['cat_name']}} Category </i>:{{$bookNumbers}}
	@foreach($book['result'] as $book_detail=>$value)
			<p>{{link_to('single_book/'.$value['id'],$value['BookName'] )}}
	@endforeach
@stop
