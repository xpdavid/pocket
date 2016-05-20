@extends('layout._admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">编辑存放地点 - {{ $location->name }}</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    {!! Form::model($location, array('url' => route('admin.location.update', ['id' => $location->id]), 'method' => 'PATCH')) !!}
    @include('admin.generic_edit')
    {!! Form::close() !!}

@endsection