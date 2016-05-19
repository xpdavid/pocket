@extends('layout._admin')

@section('content')
    @include('pocket._show', ['data' => $data, 'item' => $item])
@endsection