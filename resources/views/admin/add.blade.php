@extends('layout._admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">添加奖状</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    {!! Form::open(array('url' => '/admin/add', 'method' => 'POST')) !!}
    @include('admin._form', ['data' => $data])
    {!! Form::close() !!}

@endsection