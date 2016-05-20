@extends('layout._admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">搜索奖状</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>奖项名称</label>
                {!! Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => '无']) !!}
            </div>
            <div class="form-group">
                <label>颁奖单位</label>
                {!! Form::select('organization_list[]', $data['organizations'], $param['organizations'], ['class' => 'form-control', 'id' => 'organizations', 'multiple']) !!}
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>开始日期</label>
                        <input type="checkbox" value="" id="noDateOptionSearch"> 无日期
                        {!! Form::text('date1', $param['date1'], ['class' => 'form-control', 'placeholder' => '不填', 'id' => 'date1']) !!}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>结束日期</label>
                        {!! Form::text('date2', $param['date2'], ['class' => 'form-control', 'placeholder' => '不填', 'id' => 'date2']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>颁奖形式</label>
                {!! Form::select('type_list[]', $data['types'], $param['types'] , ['class' => 'form-control', 'id' => 'types', 'multiple']) !!}
            </div>
            <div class="form-group">
                <label>存放地点</label>
                {!! Form::select('location_list[]', $data['locations'], $param['locations'], ['class' => 'form-control', 'id' => 'locations', 'multiple']) !!}
            </div>
            <div class="form-group">
                <label>标签</label>
                {!! Form::select('tag_list[]', $data['tags'], $param['tags'], ['class' => 'form-control', 'id' => 'tags', 'multiple']) !!}
            </div>
        </div>

    </div>


    <div class="row">

        <div class="col-lg-12">
            <button type="button" class="btn btn-primary btn-lg btn-block" onclick="search_table.ajax.reload();">搜索(以上不填代表全部搜索)</button>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    搜索结果
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table id="search_results" class="display" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>名称</th>
                            <th>单位</th>
                            <th>日期</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                    </table>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>



@endsection