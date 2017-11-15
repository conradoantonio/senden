@extends('layouts.admin')

@section('main-body')
	<app-products-index :products="{{ $products }}"></app-products-index>
@endsection