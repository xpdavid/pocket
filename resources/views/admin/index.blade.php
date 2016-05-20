@extends('layout._admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">总览</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-support fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $data['pocket_count'] }}</div>
                            <div>总奖状数量</div>
                        </div>
                    </div>
                </div>
                <a href="{{ action('PocketController@getSearch') }}">
                    <div class="panel-footer">
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix">点击查看全部</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $data['pocket_current_year_count'] }}</div>
                            <div>{{ $data['current_year'] }}年奖状数量</div>
                        </div>
                    </div>
                </div>
                <a href="{{ action('PocketController@getSearch',
                [
                    'date1' => $data['current_year_begin'],
                    'date2' => $data['current_year_end']
                ]) }}">
                    <div class="panel-footer">
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix">点击查看全部</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <span class="glyphicon glyphicon-home fa-5x"></span>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $data['locations_count'] }}</div>
                            <div>存储地点</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin.location.index') }}">
                    <div class="panel-footer">
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix">点击查看全部</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <span class="glyphicon glyphicon-list-alt fa-5x"></span>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $data['organizations_count'] }}</div>
                            <div>颁发机构</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin.organization.index') }}">
                    <div class="panel-footer">
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix">点击查看全部</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-tag fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $data['tags_count'] }}</div>
                            <div>标签数量</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin.tag.index') }}">
                    <div class="panel-footer">
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix">点击查看全部</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-random fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $data['types_count'] }}</div>
                            <div>颁奖形式</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin.type.index') }}">
                    <div class="panel-footer">
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix">点击查看全部</div>
                    </div>
                </a>
            </div>
        </div>
    </div>


@endsection