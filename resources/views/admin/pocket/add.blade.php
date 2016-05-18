@extends('layout._admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">添加奖状</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    {!! Form::open(array('url' => route('admin.pocket.store'), 'method' => 'POST')) !!}
    @include('admin.pocket._form', ['data' => $data])
    {!! Form::close() !!}

@endsection