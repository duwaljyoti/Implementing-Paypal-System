@extends('template/default_template')
@section('title')
	Search Page
@stop  
@section('content')
{{link_to(URL::to('/'),"Home")}}
<h2>Search</h2>
	Your Search Query   :    {{$search_data['search_item']}}<p>
	Most Popular  Search Results :<br>
	<p>Results Found: {{count($search_data['search_book_result'])}}<p>
	@foreach($search_data['search_book_result']->toArray() as $single_search_result)
	{{link_to('single_book/'.$single_search_result['id'],$single_search_result['BookName'] )}}<p>
	@endforeach

@stop