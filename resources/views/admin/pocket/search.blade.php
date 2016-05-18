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
                <label for="exampleInputName2">奖状名字</label>
                <input type="text" class="form-control" placeholder="不填">
            </div>

            <div class="form-group">
                <label for="exampleInputName2">颁奖单位</label>
                <input type="text" class="form-control" placeholder="不填">
            </div>

            <div class="form-group">
                <label for="exampleInputName2">年份</label>
                <input type="text" class="form-control" placeholder="不填">
            </div>

        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputName2">标签</label>
                <input type="text" class="form-control" placeholder="不填">
            </div>

            <div class="form-group">
                <label for="exampleInputName2">存放地点</label>
                <input type="text" class="form-control" placeholder="不填">
            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-lg-12">
            <button type="button" class="btn btn-primary btn-lg btn-block">搜索</button>
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

                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>



@endsection