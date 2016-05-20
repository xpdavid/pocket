@extends('layout._admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">编辑颁发机构名称 - {{ $organization->name }}</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    {!! Form::model($organization, array('url' => route('admin.organization.update', ['id' => $organization->id]), 'method' => 'PATCH')) !!}
    @include('admin.generic_edit')
    {!! Form::close() !!}

@endsection