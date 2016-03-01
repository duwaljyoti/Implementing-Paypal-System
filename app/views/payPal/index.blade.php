@extends('template.default_template')
@section('content')
<h3>Ecommerce</h3>
	<h3>Shop Online</h3>

{{Form::open(['url'=>'addToMyCart'])}}
	@foreach($allItems as $singleItem)
		{{ Form::hidden('id', $singleItem->id ) }}
		{{ Form::hidden('name', $singleItem->itemname ) }}
		{{ Form::hidden('price', $singleItem->price ) }}
		<p>Name: {{$singleItem->itemname}}
		<br>Item Id: {{$singleItem->id}}<br>
		Price: {{$singleItem->price}}<br>
		Quantity: <input type='text' name='quantity' value='4'><p>
		{{Form::submit('Add To Cart')}}<p><p><p>
	@endforeach


{{Form::close()}}

{{link_to('/mycart','My Cart')}}
@stop



