@extends('template.default_template')
@section('content')
{{link_to('/admin','Home')}}
	<h2>Edit</h2>
	@foreach($bookcategories_detail as $single_book_category_detail)
		Previous Category Name<i>:{{    $single_book_category_detail['categories']     }}</i><p>
		{{Form::open(array('action' => 'MainController@change'))}}
		{{ Form::hidden('id', $single_book_category_detail['id'] ) }}
		Input New Name : {{Form::text('new_cat_name')}}<p>
		{{ Form::submit('Change!')}}
	@endforeach
	
@stop


		<!-- <?php echo Form::open(array(null, null, 'onsubmit' => 'demo_js(this); return false;')); ?>
    <?php echo Form::submit('Search', null, array('id'=>'searchbtn', 'class'=>'button radius right')); ?>
<?php echo Form::close(); ?> -->