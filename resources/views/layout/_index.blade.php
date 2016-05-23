<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{!! config('pocket.siteName') !!}</title>

    <!-- Bootstrap -->
    <link href="css/all.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


      {{--for fancybox--}}
      <link rel="stylesheet" href="/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
      <link rel="stylesheet" href="/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
      <link rel="stylesheet" href="/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
      {{--for fancybox--}}
  </head>
  <body>
  <div class="logo">
      <img src="images/index/logo.png" alt="">
  </div>
  <div class="admin">
      @if(Auth::guest())
          <a href="{{ url('/login') }}" class="btn btn-default">登录</a>
      @else
          <a href="{{ url('/admin/') }}" class="btn btn-default">欢迎, {{ Auth::user()->name }}</a>
      @endif

  </div>
  <!-- Half Page Image Background Carousel Header -->
  <header id="myCarousel" class="carousel slide">
      <!-- Indicators -->
      <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>

      <!-- Wrapper for Slides -->
      <div class="carousel-inner">
          <div class="item active">
              <!-- Set the first background image using inline CSS below. -->
              <div class="fill" style="background-image:url('images/index/slide1.jpg');"></div>
              <div class="carousel-caption">
                  {{--<h2>Caption 1</h2>--}}
              </div>
          </div>
          <div class="item">
              <!-- Set the second background image using inline CSS below. -->
              <div class="fill" style="background-image:url('images/index/slide1.jpg');"></div>
              <div class="carousel-caption">
                  {{--<h2>Caption 2</h2>--}}
              </div>
          </div>
          <div class="item">
              <!-- Set the third background image using inline CSS below. -->
              <div class="fill" style="background-image:url('images/index/slide1.jpg');"></div>
              <div class="carousel-caption">
                  {{--<h2>Caption 3</h2>--}}
              </div>
          </div>
      </div>

      <!-- Controls -->
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
          <span class="icon-prev"></span>
      </a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">
          <span class="icon-next"></span>
      </a>

  </header><br>
    @yield('content')

    @yield('fixed')
    @yield('footer')



    <script src="js/all.js"></script>
    {{--for fancybox--}}
    <script type="text/javascript" src="/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
    <script type="text/javascript" src="/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
    <script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
    <script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
    <script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
    {{--for fancybox--}}
  </body>
</html>
