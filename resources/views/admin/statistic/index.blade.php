@extends('layout._admin')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">图表分析</h1>
        <h4>请选择生成数据.</h4>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>颁奖单位</label> <span name="mainAnalysisSpan">{{ Form::radio('mainAnalysis', 'organization', true) }} 分析</span>
            {!! Form::select('organization_list[]', $data['organizations'], null, ['class' => 'form-control', 'id' => 'organizations', 'multiple']) !!}
        </div>
        <div class="form-group">
            <label>颁奖形式</label> <span name="mainAnalysisSpan">{{ Form::radio('mainAnalysis', 'type', false) }} 分析</span>
            {!! Form::select('type_list[]', $data['types'], null , ['class' => 'form-control', 'id' => 'types', 'multiple']) !!}
        </div>
        <div class="form-group">
            <label>存放地点</label> <span name="mainAnalysisSpan">{{ Form::radio('mainAnalysis', 'location', false) }} 分析</span>
            {!! Form::select('location_list[]', $data['locations'], null, ['class' => 'form-control', 'id' => 'locations', 'multiple']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>标签</label> <span name="mainAnalysisSpan">{{ Form::radio('mainAnalysis', 'tag', false) }} 分析</span>
            {!! Form::select('tag_list[]', $data['tags'], null, ['class' => 'form-control', 'id' => 'tags', 'multiple']) !!}
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>开始日期</label>
                    <input type="checkbox" value="" id="noDateOptionSearch"> 无日期
                    {!! Form::text('date1', null, ['class' => 'form-control', 'placeholder' => '不填', 'id' => 'date1']) !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>结束日期</label>
                    {!! Form::text('date2', null, ['class' => 'form-control', 'placeholder' => '不填', 'id' => 'date2']) !!}
                </div>
            </div>

            <div class="col-md-6">
                <br>
                <button type="button" class="btn btn-info" onclick="getData()">生成图表</button>
            </div>

        </div>
    </div>
</div>

<div class="row">

    <div class="col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                搜索提示
            </div>
            <div class="panel-body">
                <p>您可以: </p>
                <p>1. {{ Form::checkbox('useFilter', null, true) }} 使用筛选 (显示全部奖状统计数据)</p>
                <p>2. 不使用筛选, 分析标签对比. (如果不在分析标签选中的, 视为筛选条件)</p>
            </div>
        </div>
    </div>
</div>

<br>

<div class="row">

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                图表数据
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div id="chartdiv"></div>
            </div>
            <!-- /.panel-body -->
        </div>
    </div>
</div>

@endsection

@section('footer')
<script>
    /**
     * auto generate charts when page load.
     */
    $(function() {
        $( "[name=mainAnalysisSpan]" ).toggle();
        getData();
    });
</script>
@endsection