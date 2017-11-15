@extends('layouts.admin')

@section('main-body')
	<app-holidays-index :holidays="{{ $holidays }}"></app-holidays-index>
@endsection