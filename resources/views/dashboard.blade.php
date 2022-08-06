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
	<title>主面板 - 奏Kanade</title>

</head>
<body>
@include("nav")
<!-- Committee starts -->
<main>
	<div class="container">
		<div class="row justify-content-center mt-4 mb-2 ">
			@if($isEnrolled)
				<div class="card col-10 bg-dark text-white p-0" id="enrollmentInfo" data-bs-toggle="modal" data-bs-target="#committeeInfo">
					<img src="/storage/committee/{{$info->cid}}.jpg" class="card-img"
						 style="filter: brightness(0.75);max-height: 192px;object-fit: cover">
					<div class="card-img-overlay">
						<h5 class="card-title">{{$committee->committee}}</h5>
						<p class="card-text">{{$committee->topic}}</p>
					</div>
				</div>
				<div class="modal fade" id="committeeInfo" tabindex="-1" aria-labelledby="enrollmentInfo" aria-hidden="true">
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
												@foreach($staff[0] as $i)
													<a href="{{$_ENV["Reimu_Url"]}}/s/{{$i["uid"]}}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$i["name"]}}"><img class="rounded-circle" src="{{$_ENV["Reimu_Url"]}}/storage/avatar/{{$i["avatar"]}}" style="height: 48px;width: 48px"></a>
												@endforeach
											</div>
										</div>
									</div>
									@if($staff[1][0]["uid"]!=0)
										<div class="list-group-item">
											<div class="row m-0">
												<p class="text-center col-4 col-lg-3">学术指导</p>
												<div class="col-8 col-lg-9">
													@foreach($staff[1] as $i)
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
												@foreach($staff[2] as $i)
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
								<button type="button" class="btn btn-danger" onclick="quit();">退会</button>
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">关闭</button>
							</div>
						</div>
					</div>
				</div>
			@else
				<div class="card col-10">
					<div class="card-body justify-content-center">
						<h5 class="d-flex card-title my-2 justify-content-center">尚未报名</h5>
						<div class="dropdown my-2 d-flex justify-content-center">
							<button class="btn btn-primary dropdown-toggle" type="button" id="EnrollBtn" data-bs-toggle="dropdown" aria-expanded="false">
								报名
							</button>
							<ul class="dropdown-menu" aria-labelledby="EnrollBtn">
								<li><a class="dropdown-item" href="/Enroll/Delegate">代表</a></li>
								<li><a class="dropdown-item" href="/Enroll/Observer">观察员</a></li>
								<li><a class="dropdown-item" href="/Enroll/Academic">学术团队</a></li>
							</ul>
						</div>
					</div>
				</div>
			@endif
		</div>
		<div class="row mt-4 mb-2 justify-content-center">
			@if($isEnrolled)
				@if($info->type!=1)
				<div class="p-2 col-12 col-lg-4">
					<div class="card">
						<div class="card-body justify-content-center">
							<h5 class="d-flex card-title my-2 justify-content-center">学术测试</h5>
							@if(time()<strtotime($ddl))
								<p>您需要在{{$ddl}}前完成，您的学测可以随时被保存并继续填写</p>
								<div class="my-2 d-flex justify-content-center">
									<a class="btn btn-primary" type="button" id="TestBtn" href="/Test">开始撰写</a>
								</div>
							@else
                                <p>学测已于{{$ddl}}截止，您可以查看自己的学测</p>
                                <div class="my-2 d-flex justify-content-center">
                                    <a class="btn btn-primary" type="button" id="TestBtn" href="/Test">查看</a>
                                </div>
							@endif
						</div>
					</div>
				</div>
				<div class="p-2 col-12 col-lg-4">
					<div class="card">
						<div class="card-body justify-content-center">
							<h5 class="d-flex card-title my-2 justify-content-center">席位</h5>
							@if(time()<strtotime($ddl))
								<p>学测评阅和席位分配尚未开始</p>
							@else
								<p>学测评阅和席位分配正在进行，请注意数据更新</p>
								<div class="my-2 d-flex justify-content-center">
									<a class="btn btn-primary" type="button" id="TestBtn" href="/Seat">查询</a>
								</div>
							@endif
						</div>
					</div>
				</div>
				@endif
				<div class="p-2 col-12 col-lg-4">
					<div class="card">
						<div class="card-body justify-content-center">
							<h5 class="d-flex card-title my-2 justify-content-center">文件</h5>
							<p>点击查收委员会文件</p>
							<div class="my-2 d-flex justify-content-center">
								<a class="btn disabled" type="button" id="TestBtn" href="/Files">查询</a>
							</div>
						</div>
					</div>
				</div>
			@endif
		</div>
		<div class="row mt-4 mb-2 justify-content-center">
			@if($isEnrolled)
				<div class="px-2 col-12 col-lg-10">
					<div class="card">
						<div class="card-body justify-content-center">
							<h5 class="d-flex card-title my-2 justify-content-center">账单</h5>
							<div class="list-group list-group-flush my-2">
								@foreach($bill as $item)
									<div class="list-group-item">
										<div class="row m-0">
											<p class="col-3 text-center">#{{$item->bid}}</p>
											<p class="col-3 text-center">{{$item->name}}</p>
											<p class="col-3 text-center">￥{{$item->cost}}</p>
											@if($item->purchased==0)
												<div class="col-3 d-flex justify-content-center"><button class="btn btn-primary" id="payBtn{{$item->bid}}" data-bs-toggle="modal" data-bs-target="#pay{{$item->bid}}">支付</button></div>
											@else
												<p class="col-3 text-center text-success">已支付</p>
											@endif
										</div>
									</div>
									<div class="modal fade" id="pay{{$item->bid}}" tabindex="-1" aria-labelledby="payBtn{{$item->bid}}" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title">支付账单#{{$item->bid}}</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<div class="modal-body">
													<ul class="nav nav-tabs" id="payTab{{$item->bid}}" role="tablist">
														<li class="nav-item" role="presentation">
															<button class="nav-link active" id="tabUnion{{$item->bid}}" data-bs-toggle="tab" data-bs-target="#Union{{$item->bid}}" type="button" role="tab" aria-controls="Union{{$item->bid}}" aria-selected="true">银行转账</button>
														</li>
														<li class="nav-item" role="presentation">
															<button class="nav-link" id="tabWechat{{$item->bid}}" data-bs-toggle="tab" data-bs-target="#Wechat{{$item->bid}}" type="button" role="tab" aria-controls="Wechat{{$item->bid}}" aria-selected="false">微信</button>
														</li>
														<li class="nav-item" role="presentation">
															<button class="nav-link" id="tabAlipay{{$item->bid}}" data-bs-toggle="tab" data-bs-target="#Alipay{{$item->bid}}" type="button" role="tab" aria-controls="Alipay{{$item->bid}}" aria-selected="false">支付宝</button>
														</li>
													</ul>
													<div class="tab-content" id="payTabContent{{$item->bid}}">
														<div class="tab-pane fade show active" id="Union{{$item->bid}}" role="tabpanel" aria-labelledby="tabUnion{{$item->bid}}">
															<ul>
																<li>户名：{{$paymentInfo[0]}}</li>
																<li>卡号：{{$paymentInfo[1]}}</li>
																<li>开户行：{{$paymentInfo[2]}}</li>
															</ul>
														</div>
														<div class="tab-pane fade" id="Wechat{{$item->bid}}" role="tabpanel" aria-labelledby="tabWechat{{$item->bid}}">
															<div class="d-flex justify-content-center">
																<img src="/storage/kanade/wechat.jpg" style="width: 80%">
															</div>
														</div>
														<div class="tab-pane fade" id="Alipay{{$item->bid}}" role="tabpanel" aria-labelledby="tabAlipay{{$item->bid}}">
															<div class="d-flex justify-content-center">
																<img src="/storage/kanade/alipay.jpg" style="width: 80%">
															</div>
														</div>
													</div>
													<div class="my-2">
														<ul>
															<li>转账时务必备注姓名与账单号；</li>
															<li>转账会在48小时内确认，若超出时间仍未确认，请及时联系组织团队。</li>
														</ul>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">关闭</button>
												</div>
											</div>
										</div>
									</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			@endif
		</div>
	</div>
</main>
<!-- Background file ends -->
@include("footbar")
<script type="application/javascript">
	var tooltipTriggerList = Array.prototype.slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
	var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
		return new bootstrap.Tooltip(tooltipTriggerEl)
	});
    function quit(){
		$.post("/Actions/Quit",{_token:$('meta[name="csrf-token"]').attr('content')},function(data){if(data=="1"){alert("退会成功！"); location.reload();}});
    }
</script>
</body>
</html>