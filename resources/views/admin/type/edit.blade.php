@extends('layout._admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">编辑颁奖形式名称 - {{ $type->name }}</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    {!! Form::model($type, array('url' => route('admin.type.update', ['id' => $type->id]), 'method' => 'PATCH')) !!}
    @include('admin.generic_edit')
    {!! Form::close() !!}

@endsection