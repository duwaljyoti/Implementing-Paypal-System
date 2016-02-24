@extends('template.default_template')
@section('title')
<?php 
// dd($single_book_detail->BookName);
	$issued_date=$complete_data['issued_date'];
	$return_date=$complete_data['return_date'];
	$user_book_issue_check=$complete_data['user_check'];
	$book_complete_detail=$complete_data['single_book_detail'];
// $user_check
?>
   {{ $book_complete_detail['BookName']}}
@stop
@section('content')
		<h2>{{link_to(URL::to('/'),"Home")}}</h2>
		@if(Session::get('username')==null) 
			<span id='error_messages'>Please Login with your Valid credentials</span>
		@else
		Welcome {{ ucfirst(Session::get('username'))}}
		@endif
		<h4>Complete Book Info</h4>

	<table border="1" style="width:60%" align='center'>
  <tr>
    <td>Name</td>
    <td>{{ $book_complete_detail['BookName']}}</td> 
  </tr>
  <tr>
    <td>Book Author</td>
    <td>{{ $book_complete_detail['BookAuthor']}}</td> 
    </tr>
    <tr>
    <td>Book Category</td>
    <td>{{ $book_complete_detail['bookCategory']}}</td> 
    </tr>
    <tr>
    <td>Available Numbers</td>
    <td>{{ $book_complete_detail['availability']}} </td> 
    </tr>
    <td>Grade</td>
    <td>{{ ucfirst($book_complete_detail['grade'])}} </td> 
    </tr>

    
</table><p>
	@if(!Session::get('username')==null)
		@if($user_book_issue_check==0  and $complete_data['total_book_issued']<5)
			{{ Form::open(array('url' => '/issue_book')) }}
			{{ Form::hidden('book_id', $book_complete_detail['id']) }}
					{{Form::submit('Issue')}}
			{{ Form::close() }}<p><p>
		@else
		<script type="text/javascript">alert("Issue Successful");</script>
			You have already issued this book...<p>
			Issued Date:{{$issued_date}}<p>
			Return Date:{{$return_date}}<p>
			Number of Books issued so far : {{$complete_data['total_book_issued']}}<p>
			@if($complete_data['total_book_issued']>5)
				<p>Please Retrn your books before issuing other books<p>
			@endif
		@endif
	{{ link_to('logout',"Log Out")  }} 
	@else
	<button disabled> Issue</button><p>
	<span id='error_messages'>Please Login To Issue</span><p>

	{{ link_to('/login',"Login")  }}<p>
	@endif
	


@stop

