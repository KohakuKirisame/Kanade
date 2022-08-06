<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="csrf-token" content="{{csrf_token()}}">
	<link href="/css/bootstrap.min.css" rel="stylesheet">
	<link href="/css/flex.css" rel="stylesheet">
	<script src="/js/bootstrap.bundle.min.js"></script>
	<script src="/js/jquery-3.6.0.min.js"></script>
	<title>@if($type==0)代表报名@elseif($type==1)观察员报名@elseif($type==2)学术团队申请@endif - 奏Kanade</title>
	<script type="application/javascript">var type={{$type}};</script>
	<script type="application/javascript" src="/js/enroll.js"></script>
</head>
<body>
@include("nav")
<main>
	<div class="container mt-4 mb-2">
		<h3 class="text-center">@if($type==0)代表报名@elseif($type==1)观察员报名@elseif($type==2)学术团队申请@endif</h3>
		<h5 class="text-center mb-4">Deadline: <font class="text-danger">{{$ddl}}</font></h5>
		<div class="row justify-content-center mt-4 mb-2 ">
			@php($j=0)
			@foreach($coms["committees"] as $committee)
				<div class="col-12 col-lg-4 my-3 px-2">
					<div class="card px-0">
						<img class="card-img-top" src="/storage/committee/{{$committee->cid}}.jpg" />
						<div class="card-body">
							<h5 class="card-title">{{$committee->committee}}</h5>
							<p class="card-text">{{$committee->topic}}</p>
							<div class="my-1 d-flex justify-content-end">
								<button class="btn btn-secondary mx-2" id="detail{{$committee->cid}}" data-bs-toggle="modal" data-bs-target="#committeeInfo{{$committee->cid}}">详情</button>
								@if(time()<strtotime($ddl))
								<button class="btn btn-primary mx-2" id="enrollBtn{{$committee->cid}}" data-bs-toggle="modal" data-bs-target="#enroll{{$committee->cid}}">报名</button>
								@else
									<button class="btn" id="enrollBtn{{$committee->cid}}" disabled>报名截止</button>
								@endif
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade" id="committeeInfo{{$committee->cid}}" tabindex="-1" aria-labelledby="detail{{$committee->cid}}" aria-hidden="true">
					<div class="modal-dialog modal-dialog-scrollable">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">委员会信息</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<div class="list-group list-group-flush">
									<div class="list-group-item">
										<div class="row m-0">
											<p class="text-center col-4 col-lg-3">委员会</p>
											<p class="col-8 col-lg-9">{{$committee->committee}}</p>
										</div>
									</div>
									<div class="list-group-item">
										<div class="row m-0">
											<p class="text-center col-4 col-lg-3">议题</p>
											<p class="col-8 col-lg-9">{{$committee->topic}}</p>
										</div>
									</div>
									<div class="list-group-item">
										<div class="row m-0">
											<p class="text-center col-4 col-lg-3">负责人</p>
											<div class="col-8 col-lg-9">
												@foreach($coms["staff"][$j][0] as $i)
													<a href="{{$_ENV["Reimu_Url"]}}/s/{{$i["uid"]}}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$i["name"]}}"><img class="rounded-circle" src="{{$_ENV["Reimu_Url"]}}/storage/avatar/{{$i["avatar"]}}" style="height: 48px;width: 48px"></a>
												@endforeach
											</div>
										</div>
									</div>
									@if($coms["staff"][$j][1][0]["uid"]!=0)
										<div class="list-group-item">
											<div class="row m-0">
												<p class="text-center col-4 col-lg-3">学术指导</p>
												<div class="col-8 col-lg-9">
													@foreach($coms["staff"][$j][1] as $i)
														<a href="{{$_ENV["Reimu_Url"]}}/s/{{$i["uid"]}}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$i["name"]}}"><img class="rounded-circle" src="{{$_ENV["Reimu_Url"]}}/storage/avatar/{{$i["avatar"]}}" style="height: 48px;width: 48px"></a>
													@endforeach
												</div>
											</div>
										</div>
									@endif
									<div class="list-group-item">
										<div class="row m-0">
											<p class="text-center col-4 col-lg-3">学术团队</p>
											<div class="col-8 col-lg-9">
												@foreach($coms["staff"][$j][2] as $i)
													<a href="{{$_ENV["Reimu_Url"]}}/s/{{$i["uid"]}}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$i["name"]}}"><img class="rounded-circle" src="{{$_ENV["Reimu_Url"]}}/storage/avatar/{{$i["avatar"]}}" style="height: 48px;width: 48px"></a>
												@endforeach
											</div>
										</div>
									</div>
									<div class="list-group-item">
										<div class="row m-0">
											<p class="text-center col-4 col-lg-3">议事规则</p>
											<p class="col-8 col-lg-9">{{$committee->rule}}</p>
										</div>
									</div>
									<div class="list-group-item">
										<div class="row m-0">
											<p class="text-center col-4 col-lg-3">代表制</p>
											<p class="col-8 col-lg-9">{{$committee->delegate}}</p>
										</div>
									</div>
									<div class="list-group-item">
										<div class="row m-0">
											<p class="text-center col-4 col-lg-3">时间节点</p>
											<p class="col-8 col-lg-9">{{$committee->time}}</p>
										</div>
									</div>
									<div class="list-group-item">
										<div class="row m-0">
											<p class="text-center col-4 col-lg-3">议题介绍</p>
											<p class="col-8 col-lg-9">{!!nl2br(e($committee->introduction))!!}</p>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">关闭</button>
							</div>
						</div>
					</div>
				</div>
				@if(time()<strtotime($ddl))
				<div class="modal fade" id="enroll{{$committee->cid}}" tabindex="-1" aria-labelledby="enrollBtn{{$committee->cid}}" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">报名{{$committee->committee}}</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<div class="my-2">
									<label class="form-label" for="inviteCode{{$committee->cid}}">邀请码</label>
									<input class="form-control" id="inviteCode{{$committee->cid}}" placeholder="（非必填，若无请留空）">
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-primary" onclick="enroll({{$type}},{{$committee->cid}});">报名</button>
							</div>
						</div>
					</div>
				</div>
				@endif
                @php($j+=1)
			@endforeach
		</div>
	</div>
</main>
@include("footbar")
<script type="application/javascript">
    var tooltipTriggerList = Array.prototype.slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
</script>
</body>
</html>