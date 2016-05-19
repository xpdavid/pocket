<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">查看奖状 : {{ $item->name }}</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                1.奖状基本信息
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>奖项名称</label>
                            {!! Form::text('name', $item->name, ['class' => 'form-control', 'disabled']) !!}
                        </div>
                        <div class="form-group">
                            <label>颁奖单位</label>
                            {!! Form::select('organization_list[]', $data['organizations'], $item->organization_list, ['class' => 'form-control', 'id' => 'organizations', 'multiple', 'disabled']) !!}
                        </div>
                        <div class="form-group">
                            <label>颁奖年份/月份</label>
                            <input type="checkbox" value="" id="noDateOption"> 无日期
                            {!! Form::text('date', $item->date, ['class' => 'form-control', 'id' => 'date', 'disabled']) !!}
                        </div>
                        <div class="form-group">
                            <label>颁奖形式</label>
                            {!! Form::select('type_list[]', $data['types'], $item->type_list , ['class' => 'form-control', 'id' => 'types', 'multiple', 'disabled']) !!}
                        </div>
                        <div class="form-group">
                            <label>存放地点</label>
                            {!! Form::select('location_list[]', $data['locations'], $item->location_list, ['class' => 'form-control', 'id' => 'locations', 'multiple', 'disabled']) !!}
                        </div>
                        <div class="form-group">
                            <label>给一个标签吧</label>
                            {!! Form::select('tag_list[]', $data['tags'], $item->tag_list, ['class' => 'form-control', 'id' => 'tags', 'multiple', 'disabled']) !!}
                        </div>
                        <div class="form-group">
                            <label>备注</label>
                            {!! Form::textarea('note', $item->note, ['class' => 'form-control', 'rows' => '3', 'disabled']) !!}
                        </div>

                    </div>
                    <!-- /.col-lg-6 (nested) -->
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                2.奖状材料
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