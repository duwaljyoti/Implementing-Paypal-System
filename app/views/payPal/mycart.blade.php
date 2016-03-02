@extends('template.default_template')
@section('content')
<h3>Ecommerce</h3>
	<h3>Shop Online</h3>

{{Form::open(['url'=>'pay'])}}
@foreach($items as $singleItem)
	{{Form::hidden('id', $singleItem->id )}}
	Product Name:{{$singleItem->name}} {{Form::hidden('name', $singleItem->name )}}<br>
	Product Single Price:{{$singleItem->price}} {{Form::hidden('price', $singleItem->price )}}<br>
	Product Nums: {{$singleItem->quantity}} {{Form::hidden('quantity', $singleItem->quantity )}}<br>
	<?php  $totalPrice= $singleItem->price * $singleItem->quantity;?>
	Status:{{$singleItem->status}} <br>
	Total Price:{{$totalPrice}} {{Form::hidden('name', $totalPrice )}}<br>
	{{Form::submit('pay')}}<p>
@endforeach

{{Form::close()}}
{{link_to('/','Home')}}
@stop


