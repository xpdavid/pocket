@extends('layout._admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">编辑奖状</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    {!! Form::model($item, array('url' => action('AdminController@postEdit', ['id' => $item->id]), 'method' => 'POST')) !!}
    @include('admin._form', ['data' => $data])
    {!! Form::close() !!}

    {{--<div class="row">--}}
        {{--<div class="col-lg-12">--}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">--}}
                    {{--已经添加材料--}}
                {{--</div>--}}
                {{--<div class="panel-body">--}}
                    {{--<div class="row">--}}
                        {{--<a id="single_image" href="images/sample_icon.png" class="thumbnail item-img">--}}
                            {{--<img src="images/sample_icon.png" alt="" />--}}
                        {{--</a>--}}
                    {{--</div>--}}
                    {{--<!-- /.row (nested) -->--}}
                {{--</div>--}}
                {{--<!-- /.panel-body -->--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    第二步: 添加奖状相关材料
                </div>
                <div class="panel-body">
                    <div class="row">
                        <form action="{{ action('AdminController@postUpload', ['id' => $item->id]) }}"
                                  class="dropzone"
                                  id="item_image_upload"></form>
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
@endsection