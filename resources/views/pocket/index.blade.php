@extends('layout._index')

@section('content')

<div class="container">
    <div class="page-header">
        <h1 id="timeline">学校大事件</h1>
    </div>
    <ul class="timeline">
        @foreach($items as $item)
            <li class="{!! random_value($data['orientations']) !!}">
                <div class="timeline-badge {!! random_value($data['color_classes'], 1) !!}"><span class="glyphicon glyphicon-{!! random_value($data['icons'], 1) !!}" aria-hidden="true"></span></div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4 class="timeline-title">{{ $item->name }}</h4>
                        <p><small class="text-muted"> {{ $item->organization_list_string }}</small></p>
                    </div>
                    <div class="timeline-body">
                        @foreach($item->attachments as $attachment)
                            @if(in_arrayi($attachment->extension, App\Attachment::$image_extension))
                                <a id="single_image" href="{{ $attachment->url }}" class="thumbnail item-img">
                                    <img src="{{ $attachment->thumb_url }}" alt="" />
                                </a>
                            @endif
                        @endforeach

                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>

@endsection


@section('fixed')
    {{--<nav class="navbar navbar-default navbar-fixed-bottom">--}}
        {{--<div class="container-fluid">--}}
            {{--<!-- Brand and toggle get grouped for better mobile display -->--}}
            {{--<div class="navbar-header">--}}
                {{--<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">--}}
                    {{--<span class="sr-only">Toggle navigation</span>--}}
                    {{--<span class="icon-bar"></span>--}}
                    {{--<span class="icon-bar"></span>--}}
                    {{--<span class="icon-bar"></span>--}}
                {{--</button>--}}
                {{--<a class="navbar-brand" href="#">筛选</a>--}}
            {{--</div>--}}

            {{--<!-- Collect the nav links, forms, and other content for toggling -->--}}
            {{--<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">--}}
                {{--<ul class="nav navbar-nav">--}}
                    {{--<li class="dropdown">--}}
                        {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">时间 <span class="caret"></span></a>--}}
                        {{--<ul class="dropdown-menu">--}}
                            {{--<li><a href="#">Action</a></li>--}}
                            {{--<li><a href="#">Another action</a></li>--}}
                            {{--<li><a href="#">Something else here</a></li>--}}
                            {{--<li role="separator" class="divider"></li>--}}
                            {{--<li><a href="#">Separated link</a></li>--}}
                            {{--<li role="separator" class="divider"></li>--}}
                            {{--<li><a href="#">One more separated link</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                {{--</ul>--}}
                {{--<form class="navbar-form navbar-left" role="search">--}}
                    {{--<div class="form-group">--}}
                        {{--<input type="text" class="form-control" placeholder="搜索名称">--}}
                    {{--</div>--}}
                    {{--<button type="submit" class="btn btn-default">搜索</button>--}}
                {{--</form>--}}
                {{--<ul class="nav navbar-nav navbar-right">--}}
                    {{--<li class="dropdown">--}}
                        {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">颁奖机构 <span class="caret"></span></a>--}}
                        {{--<ul class="dropdown-menu">--}}
                            {{--<li><a href="#">Action</a></li>--}}
                            {{--<li><a href="#">Another action</a></li>--}}
                            {{--<li><a href="#">Something else here</a></li>--}}
                            {{--<li><a href="#">Separated link</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    {{--<li class="dropdown">--}}
                        {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">标签 <span class="caret"></span></a>--}}
                        {{--<ul class="dropdown-menu">--}}
                            {{--<li><a href="#">Action</a></li>--}}
                            {{--<li><a href="#">Another action</a></li>--}}
                            {{--<li><a href="#">Something else here</a></li>--}}
                            {{--<li><a href="#">Separated link</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</div><!-- /.navbar-collapse -->--}}
        {{--</div><!-- /.container-fluid -->--}}
    {{--</nav>--}}
@endsection
