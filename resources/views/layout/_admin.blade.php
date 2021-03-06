﻿<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{!! config('pocket.siteName') !!} 管理页面</title>

    <!-- Bootstrap -->
    <!-- Bootstrap Core CSS -->
    <link href="/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- DataTable -->
    <link rel="stylesheet" type="text/css" href="/DataTables/datatables.css"/>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


    <link href="/css/admin_all.css" rel="stylesheet" type="text/css">

    {{--for fancybox--}}
    <link rel="stylesheet" href="/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
    <link rel="stylesheet" href="/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
    <link rel="stylesheet" href="/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
    {{--for fancybox--}}
</head>
<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/admin/">{!! config('pocket.siteName') !!} 管理页面</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#"><i class="fa fa-user fa-fw"></i> {{ Auth::user()->name }}</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="{{ url("/logout") }}"><i class="fa fa-sign-out fa-fw"></i> 登出</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="{{ action('AdminController@Overall') }}"><i class="fa fa-dashboard fa-fw"></i> 总览</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-edit fa-fw"></i> 管理奖状<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{ action('PocketController@create') }}">添加</a>
                            </li>
                            <li>
                                @if(isset($item))
                                    <a href="{{ action('PocketController@edit', $item->id) }}">编辑</a>
                                @else
                                    <a href="{{ action('PocketController@getSearch') }}">编辑</a>
                                @endif
                            </li>
                            <li>
                                @if(isset($item))
                                    <a href="{{ action('PocketController@show', $item->id) }}">查看</a>
                                @else
                                    <a href="{{ action('PocketController@getSearch') }}">查看</a>
                                @endif
                            </li>
                            <li>
                                <a href="{{ action('PocketController@getSearch') }}">搜索</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-edit fa-fw"></i> 管理存储地点<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{ route('admin.location.index') }}">查看</a>
                            </li>
                            <li>
                                @if(isset($location))
                                    <a href="{{ action('LocationController@edit', $location->id) }}">编辑</a>
                                @else
                                    <a href="{{ route('admin.location.index') }}">编辑</a>
                                @endif
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-edit fa-fw"></i> 管理奖状形式<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{ route('admin.type.index') }}">查看</a>
                            </li>
                            <li>
                                @if(isset($type))
                                    <a href="{{ action('TypeController@edit', $type->id) }}">编辑</a>
                                @else
                                    <a href="{{ route('admin.type.index') }}">编辑</a>
                                @endif
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-edit fa-fw"></i> 管理颁奖机构<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{ route('admin.organization.index') }}">查看</a>
                            </li>
                            <li>
                                @if(isset($organization))
                                    <a href="{{ action('OrganizationController@edit', $organization->id) }}">编辑</a>
                                @else
                                    <a href="{{ route('admin.organization.index') }}">编辑</a>
                                @endif
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-edit fa-fw"></i> 管理奖状标签<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{ route('admin.tag.index') }}">查看</a>
                            </li>
                            <li>
                                @if(isset($tag))
                                    <a href="{{ action('TagController@edit', $tag->id) }}">编辑</a>
                                @else
                                    <a href="{{ route('admin.tag.index') }}">编辑</a>
                                @endif
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> 其他功能<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{ action('StatisticController@getStatistic') }}">统计</a>
                            </li>
                            <li>
                                <a href="{{ action('PocketController@getSearch') }}">生成报表</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>

                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <div id="page-wrapper">
        @yield('content')
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@if (count($errors) > 0)
    <div class="bottom_error_message">
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>出现了错误</strong>
            @foreach($errors->all() as $error)
                <p class="text-danger">{{ $error }}</p>
            @endforeach
        </div>
    </div>
@endif


        <!-- jQuery -->
<script src="/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="/bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- amcharts Charts JavaScript -->
    <script src="/amcharts/amcharts.js"></script>
    <script src="/amcharts/serial.js"></script>
    <script src="/amcharts/themes/light.js"></script>
    <script src="/amcharts/lang/zh.js"></script>

<!-- Custom Theme JavaScript -->
<script src="/js/sb-admin-2.js"></script>

<!-- DataTable JavaScript -->
<script type="text/javascript" src="/DataTables/datatables.min.js"></script>

<script src="/js/admin_all.js"></script>

    {{--for fancybox--}}
    <script type="text/javascript" src="/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
    <script type="text/javascript" src="/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
    <script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
    <script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
    <script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
    {{--for fancybox--}}

@yield('footer')
</body>
</html>
