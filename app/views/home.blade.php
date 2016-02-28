@extends('template.default_template')
@section('title')
    Home--E Library
@stop
@section('content')
	<h2>E-Library</h2>
	Welcome
	{{{ $logged_user or 'Visitor' }}}
	<p>
	<div id='search_box'>
	{{ Form::open(array('url' => 'search'))}}
		{{Form::text('search_item')}}
		{{Form::submit('Search')}}
	{{Form::close()}}
	</div>

	<div id='reminder'>
	@if(isset($logged_user))
		Latest Date of Book Submission:
	@else
		<div id='error_messages'>Please Login</div>
	@endif
	</div>
<p><p>
	<div id='books_category'>
	<u>{{ link_to('logout',"Books By Category")  }}</u></p>
		@foreach($BookCatList as $SingleList)
			{{ link_to('category/'.$SingleList->categories,ucfirst($SingleList->categories) )}}<p>
		@endforeach
	</div>
	<div id='all_books'>
	<u>	{{ link_to('/all_books',"All Books")  }}<p></u>
		@foreach($AllBooks as $SingleList)
			{{link_to('single_book/'.$SingleList->id,$SingleList->BookName )}}<p>

		@endforeach
	</div>
	<div id='latest_books'>
	<u>{{ link_to('logout',"Latest Books Added")  }}</u><p>
		@foreach($AllBooks as $SingleList)
			{{ $SingleList->BookName   }}<p>
		@endforeach
	</div>
	<p><br><p><br>
	<div id='buttom_menus'>
	@if(!$logged_user)
	{{ link_to('/login',"Login")  }}<p>
	@else
	{{ link_to('logout',"Log Out")  }}  &nbsp   &nbsp
	{{ link_to('/login',"My Profile")  }}<p>
	@endif
	</div>
	<br><br><p>

@stop
