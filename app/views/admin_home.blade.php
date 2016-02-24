@extends('template.default_template')
@section('content')
	<h2>E-Library Admin</h2>

	<div id="ad_books_category">
	<u>{{ link_to('logout',"Books By Category") }}</u>  &nbsp &nbsp
	{{link_to('add_new/'."Category","Add")}}<p>
		@foreach($BookCatList as $SingleList)
			  {{ $SingleList->categories   }} &nbsp {{link_to('/edit/category/ '.$SingleList->id,"Edit")}} &nbsp  {{link_to('/delete/category/ '.$SingleList->id,"Delete")}} <p>
		@endforeach
	</div>
<p>
<div id="ad_all_books">
	<u>{{ link_to('logout',"All Books	")  }}</u><p>
		@foreach($AllBooks as $SingleList)
			 {{ $SingleList->BookName   }} &nbsp {{link_to('/edit_book/book/ '.$SingleList->id,"Edit")}} &nbsp  {{link_to('/delete/book/ '.$SingleList->id,"Delete")}} <p>

		@endforeach
		{{link_to('/add_books_admin','Add Books')}}
		</div>
	
	<p><p><p>
	<div id='ad_bottom_menus'>
	{{ link_to('logout',"Log Out")  }}     &nbsp &nbsp {{link_to(URL::to('/admin'),"Home")}}
	</div>
@stop