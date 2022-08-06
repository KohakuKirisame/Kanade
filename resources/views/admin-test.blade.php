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
	<title>学测 - 奏Kanade</title>
</head>
<body>
@include("nav")
<main>
	<div class="container my-5">
		<h2 class="text-center my-3">学测管理</h2>
		<div class="row">
			<div class="card col-12 shadow my-2">
				<div class="card-body">
					<select class="form-select form-select-lg my-2" id="searchCommittee" onchange="searchCommittee();">
						<option selected value="0">全部委员会</option>
						@foreach($committeeList as $committee)
							<option value="{{$committee["cid"]}}">{{$committee["committee"]}}</option>
						@endforeach
					</select>
					<ul class="nav nav-pills my-2" id="selectStatus" role="tablist">
						<li class="nav-item" role="presentation">
							<button class="nav-link active" id="unreviewed-tab" data-bs-toggle="pill" data-bs-target="#unreviewed" type="button" role="tab" aria-controls="unreviewed" aria-selected="true">未评阅</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="reviewed-tab" data-bs-toggle="pill" data-bs-target="#reviewed" type="button" role="tab" aria-controls="reviewed" aria-selected="false">已评阅</button>
						</li>
					</ul>
				</div>
			</div>
			<div class="card col-12 shadow my-2">
				<div class="card-body">
					<div class="row justify-content-end my-2">
						<div class="form-floating col-6 col-md-4">
							<input class="form-control" type="text" id="searchDelegate" placeholder="搜索..." onchange="searchDelegate();" />
							<label for="searchDelegate">搜索...</label>
						</div>
					</div>
					<div class="tab-content" id="selectStatusContent">
						<div class="tab-pane fade show active" id="unreviewed" aria-labelledby="unreviewed-tab" role="tabpanel">
							<ul class="list-group list-group-flush my-2">
								<li class="list-group-item my-1">
									<div class="row m-0">
										<h5 class="col-3 text-center">学测代码</h5><h5 class="col-4 text-center">委员会</h5><h5 class="col-2 text-center">会费</h5><h5 class="col-3 text-center">评阅</h5>
									</div>
								</li>
								@foreach($delegates as $del)
									@if(!$delTest[$del]["isReviewed"])
										<li class="list-group-item mt-1" data-c="{{$delTest[$del]["cid"]}}">
											<div class="row m-0">
												<p class="text-center col-3">{{strtoupper(substr(md5($delTest[$del]["eid"]),-6,6))}}</p>
												<p class="text-center col-4">{{$delTest[$del]["committee"]}}</p>
												@if($delTest[$del]["bill"][0]==1)<p class="text-center col-2 text-success">已支付</p>
												<p class="text-center col-3">
													<a class="btn btn-primary" href="/Admin/Test/{{$delTest[$del]["eid"]}}" target="_blank">评阅</a>
												</p>
												@elseif($delTest[$del]["bill"][0]==0)
													<p class="text-center col-2 text-warning">未支付</p>
													<p class="text-center text-secondary col-3">不可评阅</p>
												@endif
											</div>
										</li>
									@endif
								@endforeach
							</ul>
						</div>
						<div class="tab-pane fade" id="reviewed" aria-labelledby="reviewed-tab" role="tabpanel">
							<ul class="list-group list-group-flush my-2">
								<li class="list-group-item my-1">
									<div class="row m-0">
										<h5 class="col-3 text-center">姓名</h5><h5 class="col-4 text-center">委员会</h5><h5 class="col-2 text-center">会费</h5><h5 class="col-3 text-center">查看</h5>
									</div>
								</li>
								@foreach($delegates as $del)
									@if($delTest[$del]["isReviewed"])
										<li class="list-group-item mt-1" data-c="{{$delTest[$del]["cid"]}}">
											<div class="row m-0">
												<p class="text-center col-3">{{$delegatesInfo[$del]["name"]}}</p>
												<p class="text-center col-4">{{$delTest[$del]["committee"]}}</p>
												@if($delTest[$del]["bill"][0]==1)<p class="text-center col-2 text-success">已支付</p>
												<p class="text-center col-3">
													<a class="btn btn-primary" href="/Admin/Test/{{$delTest[$del]["eid"]}}" target="_blank">查看</a>
												</p>
												@elseif($delTest[$del]["bill"][0]==0)
													<p class="text-center col-2 text-warning">未支付</p>
													<p class="text-center text-secondary col-3">不可评阅</p>
												@endif
											</div>
										</li>
									@endif
								@endforeach
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
@include('footbar')
<script type="application/javascript" src="/js/admin/delegate.js"></script>
</body>
</html>