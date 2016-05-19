<div class="row">
    <!-- /.col-lg-12 -->
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                编辑标签 - {{ $thing->name }}
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label>名称</label>
                    <input class="form-control" value="{{ $thing->name }}">
                </div>
                <button type="submit" class="btn btn-primary">修改</button>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>