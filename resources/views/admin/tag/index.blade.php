@extends('layout._admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            {!! Form::open(array('url' => action('StatisticController@postExcelGeneric'), 'method' => 'POST')) !!}
            {{ Form::hidden('generic_name', 'tag') }}
            <h1 class="page-header">管理标签 <button type="submit" class="btn btn-info btn-xs">生成Excel文件</button></h1>
            {!! Form::close() !!}
        </div>
        <!-- /.col-lg-12 -->
    </div>

    @include('admin.generic_index', ['table_id' => 'tag_table'])




@endsection