@extends('layouts.admin')

@section('main-body')
	<app-solutions-index :solutions="{{ $solutions }}"></app-solutions-index>
@endsection