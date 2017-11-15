@extends('layouts.admin')

@section('main-body')
	<app-products-approve :products="{{ $products }}"></app-products-approve>
@endsection