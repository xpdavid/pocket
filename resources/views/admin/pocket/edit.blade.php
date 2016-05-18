@extends('layout._admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">编辑奖状</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    {!! Form::model($item, array('url' => route('admin.pocket.update', ['id' => $item->id]), 'method' => 'PATCH')) !!}
    @include('admin.pocket._form', ['data' => $data])
    {!! Form::close() !!}

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    已经添加材料
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="pocket_edit_attachment">
                                    @foreach ($item->attachments->chunk(6) as $attachments)
                                        <div class="row">
                                            @foreach ($attachments as $attachment)
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-danger btn-xs" onclick="deletePocketUploadById({{ $attachment->id }})">
                                                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                    </button>
                                                    <a class="thumbnail"  href="/{{ $attachment->url }}" id="single_image">
                                                        <img src="/{{ $attachment->thumb_url }}" alt="" />
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    第二步: 添加奖状相关材料
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            {{ Form::open(['url' => action('PocketFileController@postUpload', ['id' => $item->id]), 'file' => true, 'class' => 'dropzone']) }}
                            {{ Form::close() }}
                        </div>
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