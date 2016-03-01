@extends('template.default_template')
@section('content')
<h3>Ecommerce</h3>
	<h3>Shop Online</h3>

{{Form::open(['url'=>'pay'])}}
		{{Form::text('name','Mobile')}}<p>
		{{Form::text('quantity',3)}}<p>
		{{Form::text('price',55)}}<p>
		{{Form::submit()}}



{{Form::close()}}
@stop
