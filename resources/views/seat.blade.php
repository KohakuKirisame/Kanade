<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{csrf_token()}}">
	<link href="/css/bootstrap.min.css" rel="stylesheet">
	<link href="/css/flex.css" rel="stylesheet">
	<script src="/js/bootstrap.bundle.min.js"></script>
	<script type="application/javascript" src="/js/jquery-3.6.0.min.js"></script>
	<title>学测分数与席位 - 奏Kanade</title>
</head>
<body>
@include("nav")
<main>
	<div class="container my-5">
		<div class="row justify-content-center">
			<div class="card col-12 col-md-8 col-lg-6 my-3">
				<div class="card-body">
					<h4 class="card-title text-center">学测分数</h4>
					@if($score!=0)
					<ul class="list-group list-group-flush my-3">
						<li class="list-group-item mt-1">
							<div class="row">
								<p class="col-4 pr-1 text-end">委员会</p>
								<p class="col-8 pl-1">{{$score[0]}}</p>
							</div>
						</li>
						<li class="list-group-item mt-1">
							<div class="row">
								<p class="col-4 pr-1 text-end">分数</p>
								<p class="col-8 pl-1">{{number_format($score[1],1)}} / {{$totalScore}}</p>
							</div>
						</li>
						<li class="list-group-item mt-1">
							<div class="row">
								<p class="col-4 pr-1 text-end">阅卷人</p>
								<p class="col-8 pl-1">{{$score[2]}}</p>
							</div>
						</li>
					</ul>
					@else
					<p class="text-secondary my-4 text-center">学测尚未评阅</p>
					@endif
				</div>
			</div>
			<div class="w-100"></div>
			<div class="card col-12 col-md-8 col-lg-6 my-3">
				<div class="card-body">
					<h4 class="card-title text-center">席位</h4>
					@if($seat!=0)
					<ul class="list-group list-group-flush my-3">
						<li class="list-group-item mt-1">
							<div class="row">
								<p class="col-4 pr-1 text-end">委员会</p>
								<p class="col-8 pl-1">{{$seat[1]}}</p>
							</div>
						</li>
						<li class="list-group-item mt-1">
							<div class="row">
								<p class="col-4 pr-1 text-end">席位</p>
								<p class="col-8 pl-1">{{$seat[2]}}</p>
							</div>
						</li>
					</ul>
					@else
						<p class="text-secondary my-4 text-center">席位尚未分配</p>
					@endif
				</div>
			</div>
		</div>
	</div>
</main>
@include("footbar")
</body>
</html>