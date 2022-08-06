<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>登录 - Kanade</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="/css/login.css" />
    <script type="application/javascript" src="/js/bootstrap.bundle.min.js"></script>
    <script type="application/javascript" src="/js/jquery-3.6.0.min.js"></script>
    <script type="application/javascript" src="/js/login.js"></script>
</head>

<body>
<div class="bg-img" id="bg-img"></div>
<main>
    <div class="row justify-content-center cbl">
        <div class="container main-form col-10 col-md-8 col-lg-6 shadow-lg pb-1" id="main-form" onMouseOver="bgBlur();" onMouseOut="bgDeblur();">
            <div class="row justify-content-center">
                <img src="/storage/kanade/logo.svg" class="col-4 col-md-3 logo-svg my-2" />
                <a class="my-2 btn btn-lg btn-primary col-10" href="{{$_ENV["Reimu_Url"]."/login?app=kanade&redirect=".$_ENV["APP_URL"]."/Actions/Auth"}}">用灵Reimu登录</a>
            </div>
        </div>
    </div>
</main>
<footer style="bottom: 0; width: 100%">
    <div class="container-fluid text-white page-footer" style="height: 128px;z-index:-999">
        <h5 class="px-auto text-center">奏Kanade会议系统</h5>
        <p class="text-center">由星云娘~DevTeam~开发<br />背景图自<a href="https://www.pixiv.net/artworks/80453394">https://www.pixiv.net/artworks/80453394</a><br /><a href="https://beian.miit.gov.cn">京ICP备2022009339号-3</a><br/><a href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=11010802039245"><img src="https://nbmun.cn/wp-content/uploads/2022/04/2022-04-14_23-12-54_472354.png">京公网安备 11010802039245号</a></p>

    </div>
    <iframe width=330 height=86 style="display: none;" src="//music.163.com/outchain/player?type=2&id=34014168&auto=1&height=66"></iframe>
</footer>
</body>
</html>