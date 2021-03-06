<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                第一步: 添加基本信息
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                            <div class="form-group">
                                <label>奖项名称</label>
                                {!! Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                                <p class="help-block">填写名称即可, 没有必要特意注明年份, 单位</p>
                            </div>
                            <div class="form-group">
                                <label>颁奖单位</label>
                                {!! Form::select('organization_list[]', $data['organizations'], null, ['class' => 'form-control', 'id' => 'organizations', 'multiple']) !!}
                                <p class="help-block">请尽量使用自动补全框提示内容.</p>
                            </div>
                            <div class="form-group">
                                <label>颁奖年份/月份</label>
                                <input type="checkbox" value="" id="noDateOption"> 无日期
                                {!! Form::text('date', null, ['class' => 'form-control', 'id' => 'date']) !!}
                                <p class="help-block">如果是一段时间的请在备注中注明即可, 只有月份的用1代替</p>
                            </div>
                            <div class="form-group">
                                <label>颁奖形式</label>
                                {!! Form::select('type_list[]', $data['types'], null , ['class' => 'form-control', 'id' => 'types', 'multiple']) !!}
                                <p class="help-block">请尽量使用自动补全框提示内容.</p>
                            </div>
                            <div class="form-group">
                                <label>存放地点</label>
                                {!! Form::select('location_list[]', $data['locations'], null, ['class' => 'form-control', 'id' => 'locations', 'multiple']) !!}
                                <p class="help-block">请尽量使用自动补全框提示内容.</p>
                            </div>
                            <div class="form-group">
                                <label>给一个标签吧</label>
                                {!! Form::select('tag_list[]', $data['tags'], null, ['class' => 'form-control', 'id' => 'tags', 'multiple']) !!}
                                <p class="help-block">比如说: 个人荣誉, 集体荣誉</p>
                            </div>
                            <div class="form-group">
                                <label>备注</label>
                                {!! Form::textarea('note', null, ['class' => 'form-control', 'rows' => '3']) !!}
                                <p class="help-block">比如说: 联系方式, 是否损坏等.</p>
                            </div>
                            <div class="form-group">
                                <label>是否对外显示</label>
                                {!! Form::checkbox('published', true) !!}
                            </div>

                            <button type="submit" class="btn btn-default">提交</button>
                            <p class="help-block">请先保存, 然后进行第二步传照片</p>
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