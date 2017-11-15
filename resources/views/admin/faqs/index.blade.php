@extends('layouts.admin')

@section('main-body')
	<app-faqs-index :faqs="{{ $faqs }}"></app-faqs-index>
@endsection