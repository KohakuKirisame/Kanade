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
	<script src="/js/jquery-3.6.0.min.js"></script>
	<title>关于会议 - 奏Kanade</title>
</head>
<body>
@include("nav")
<main>
	<div class="container mt-3 mb-5">
		<div class="row justify-content-center mb-5">
			<div class="card col-12 col-lg-8 shadow">
				<div class="card-body">
					<h3 class="card-title text-center">{{$info[0]}}</h3>
					<h5 class="card-title text-center">{{$info[1]}}</h5>
					<p class="card-title text-center text-secondary">{{$info[2]}}</p>
					<div class="row my-4">
						<p class="card-text col-3 mb-1 text-center">时间</p><p class="card-text col-9 mb-1">{{$info[3]}}~{{$info[4]}}</p>
						<p class="card-text col-3 mb-1 text-center">地点</p><p class="card-text col-9 mb-1">{{$info[5]}}</p>
					</div>
				</div>
			</div>
		</div>
		<div class="row justify-content-center mb-5">
			<div class="card col-12 col-lg-8 shadow">
				<div class="card-body">
					<h3 class="card-title text-center">联系方式</h3>
					<div class="row my-1">
						<p class="card-text col-3 my-auto text-center">QQ群</p>
						<p class="card-text col-9 my-auto">{{$info[6]}}</p>
					</div>
					<div class="row my-2">
						<p class="card-text col-3 my-auto text-center">会议负责人</p>
						<div class="card-text col-9 my-auto">
							@foreach($head as $i)
								<a href="{{$_ENV["Reimu_Url"]."/s/".$i["uid"]}}">
									<div class="rounded-pill d-flex float-start m-1 bg-primary" style="height: 64px;width: 128px">
										<img src="{{$_ENV["Reimu_Url"]."/storage/avatar/".$i["avatar"]}}" class="rounded-circle h-100" />
										<p class="text-center my-auto text-white" style="width:64px;">{{$i["name"]}}</p>
									</div>
								</a>
							@endforeach
						</div>
					</div>
					<div class="row my-2">
						<p class="card-text col-3 my-auto text-center">联系人</p>
						<div class="card-text col-9 my-auto">
							@foreach($contact as $i)
								<a href="{{$_ENV["Reimu_Url"]."/s/".$i["uid"]}}">
									<div class="rounded-pill d-flex float-start m-1 bg-primary" style="height: 64px;width: 128px">
										<img src="{{$_ENV["Reimu_Url"]."/storage/avatar/".$i["avatar"]}}" class="rounded-circle h-100" />
										<p class="text-center my-auto text-white" style="width:64px;">{{$i["name"]}}</p>
									</div>
								</a>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row justify-content-center mb-5">
			<div class="card col-12 col-lg-8 shadow">
				<div class="card-body">
					<h3 class="card-title text-center">奏Kanade</h3>
					<h5 class="card-title text-center">开发者</h5>
					<ul class="list-group list-group-flush my-3">
						<li class="list-group-item">
							<div class="row">
								<p class="col-3 text-center">曹峰</p>
								<p class="col-6 text-center">北京航空航天大学</p>
								<p class="col-3 text-center">主催&后端</p>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">
								<p class="col-3 text-center">高赛康</p>
								<p class="col-6 text-center">北京航空航天大学</p>
								<p class="col-3 text-center">前端</p>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">
								<p class="col-3 text-center">蒋胜昔</p>
								<p class="col-6 text-center">华南理工大学</p>
								<p class="col-3 text-center">后端</p>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">
								<p class="col-3 text-center">金涛</p>
								<p class="col-6 text-center">北京航空航天大学</p>
								<p class="col-3 text-center">前端</p>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</main>
@include("footbar")
</body>
</html>