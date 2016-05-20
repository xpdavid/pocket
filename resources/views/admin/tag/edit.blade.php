@extends('layout._admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">编辑标签名称 - {{ $tag->name }}</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    {!! Form::model($tag, array('url' => route('admin.tag.update', ['id' => $tag->id]), 'method' => 'PATCH')) !!}
    @include('admin.generic_edit')
    {!! Form::close() !!}

@endsection