@extends('template.default_template')
@section('content')
{{link_to('/admin','Home')}}
	<h2>Edit</h2>
	@foreach($books_detail as $single_book_detail)
		{{    $single_book_detail['BookName']     }}</i><p>
		{{Form::open(array('action' => 'MainController@edit_book_details'))}}
		{{ Form::hidden('id', $single_book_detail['id'] ) }}
		Input New Name : {{Form::text('new_book_name',$single_book_detail['BookName'] )}}<p>
		Book Author:{{Form::text('new_author_name',$single_book_detail['BookAuthor'] )}}<p>
		Book Category:{{Form::text('new_category_name',$single_book_detail['bookCategory'] )}}<p>
		Availability:{{Form::text('new_avail',$single_book_detail['availability'] )}}<p>
		Grade:{{Form::text('new_grade',$single_book_detail['grade'] )}}<p>
		{{ Form::submit('Change!')}}
	@endforeach
	
@stop


		<!-- <?php echo Form::open(array(null, null, 'onsubmit' => 'demo_js(this); return false;')); ?>
    <?php echo Form::submit('Search', null, array('id'=>'searchbtn', 'class'=>'button radius right')); ?>
<?php echo Form::close(); ?> -->