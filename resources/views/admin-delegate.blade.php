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
	<title>代表列表 - 奏Kanade</title>
</head>
<body>
@include("nav")
<main>
<div class="container my-5">
	<h2 class="text-center my-3">代表管理</h2>
	<div class="row">
		<div class="card col-12 shadow my-2">
			<div class="card-body">
				<select class="form-select form-select-lg my-2" id="searchCommittee" onchange="searchCommittee();">
					<option selected value="0">全部委员会</option>
					@foreach($committeeList as $committee)
					<option value="{{$committee["cid"]}}">{{$committee["committee"]}}</option>
					@endforeach
				</select>
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
				<ul class="list-group list-group-flush my-2">
					<li class="list-group-item my-1">
						<div class="row m-0">
							<h5 class="col-2 text-center">姓名</h5><h5 class="col-2 text-center">类型</h5><h5 class="col-2 text-center">委员会</h5><h5 class="col-2 text-center">会费</h5><h5 class="col-2 text-center">住宿费</h5><h5 class="col-2 text-center">信息</h5>
						</div>
					</li>
					@foreach($delegates as $del)
					<li class="list-group-item mt-1" data-c="{{$delCom[$del]["cid"]}}" data-n="{{$delegatesInfo[$del]["name"]}}" data-s="{{$delegatesInfo[$del]["school"]}}" >
						<div class="row m-0">
							<p class="text-center col-2">{{$delegatesInfo[$del]["name"]}}</p>
							@if($delCom[$del]["type"]==0)<p class="text-center col-2">代表</p>@elseif($delCom[$del]["type"]==1)<p class="text-center col-2">观察员</p>@endif
							<p class="text-center col-2">{{$delCom[$del]["committee"]}}</p>
							@if($delCom[$del]["bill"][0]==1)<p class="text-center col-2 text-success">已支付</p>@elseif($delCom[$del]["bill"][0]==0)<p class="text-center col-2 text-warning">未支付</p>@endif
							@if($delCom[$del]["bill"][1]==1)<p class="text-center col-2 text-success">已支付</p>@elseif($delCom[$del]["bill"][1]==0)<p class="text-center col-2 text-warning">未支付</p>@endif
							<p class="text-center col-2">
								<button class="btn btn-primary"
										onclick='infoModal({{$del}},"{{$delegatesInfo[$del]["name"]}}","{{$delegatesInfo[$del]["avatar"]}}","@if($delegatesInfo[$del]["sex"]==0)奇怪@elseif($delegatesInfo[$del]["sex"]==1)男@elseif($delegatesInfo[$del]["sex"]==2)女@endif","{{$delegatesInfo[$del]["school"]}}","{{$delegatesInfo[$del]["phone"]}}","{{$delegatesInfo[$del]["qq"]}}","{{$delegatesInfo[$del]["email"]}}","{{$delegatesInfo[$del]["wechat"]}}");'>详情
								</button>
							</p>
						</div>
					</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
</div>
	<div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="infoModalLabel"></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="row justify-content-center">
						<img src="" id="avatar" class="col-2 my-2 rounded-circle">
						<h3 id="name" class="col-12 text-center mb-2"></h3>
					</div>
					<ul class="list-group list-group-flush my-2">
						<li class="list-group-item mt-1">
							<div class="row">
								<p class="col-4 pr-1 text-end">性别</p>
								<p class="col-8 pl-1" id="sex"></p>
							</div>
						</li>
						<li class="list-group-item mt-1">
							<div class="row">
								<p class="col-4 pr-1 text-end">学校</p>
								<p class="col-8 pl-1" id="school"></p>
							</div>
						</li>
						<li class="list-group-item mt-1">
							<div class="row">
								<p class="col-4 pr-1 text-end">手机</p>
								<p class="col-8 pl-1" id="phone"></p>
							</div>
						</li>
						<li class="list-group-item mt-1">
							<div class="row">
								<p class="col-4 pr-1 text-end">QQ</p>
								<p class="col-8 pl-1" id="qq"></p>
							</div>
						</li>
						<li class="list-group-item mt-1">
							<div class="row">
								<p class="col-4 pr-1 text-end">邮箱</p>
								<p class="col-8 pl-1" id="email"></p>
							</div>
						</li>
						<li class="list-group-item mt-1">
							<div class="row">
								<p class="col-4 pr-1 text-end">微信</p>
								<p class="col-8 pl-1" id="wechat"></p>
							</div>
						</li>
						<li class="list-group-item mt-1">
							<div class="row">
								<p class="col-4 pr-1 text-end">Reimu名片</p>
								<p class="col-8 pl-1"><a class="btn btn-primary" href="" id="link">打开</a></p>
							</div>
						</li>
					</ul>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">吔！</button>
				</div>
			</div>
		</div>
	</div>
</main>
@include('footbar')
<script type="application/javascript">
	function infoModal(uid,name,avatar,sex,school,phone,qq,email,wechat){
        $("#link").attr("href","{{$_ENV["Reimu_Url"]."/s/"}}"+uid);
        $("#avatar").attr("src","{{$_ENV["Reimu_Url"]."/storage/avatar/"}}"+avatar);
        $("#name").html(name);
        $("#sex").html(sex);
        $("#school").html(school);
        $("#phone").html(phone);
        $("#qq").html(qq);
        $("#email").html(email);
        $("#wechat").html(wechat);
        var modal=new bootstrap.Modal(document.getElementById("infoModal"));
        modal.toggle();
	}
</script>
<script type="application/javascript" src="/js/admin/delegate.js"></script>
</body>
</html>