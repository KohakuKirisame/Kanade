<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/flex.css" rel="stylesheet">
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/jquery-3.6.0.min.js"></script>
    <title>报名未开始 - 奏Kanade</title>
</head>
<body>
@include("nav")
<main>
<div class="container my-4">
    <h4 class="text-center text-secondary mb-2">报名未开始</h4>
    <h5 class="text-center text-secondary mb-2">开放时间：{{$start}}</h5>
</div>
</main>
@include("footbar")
</body>