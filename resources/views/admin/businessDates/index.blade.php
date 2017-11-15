@extends('layouts.admin')

@section('main-body')
	<app-business-dates-index :businessDates="{{ $businessDates }}"></app-business-dates-index>
@endsection