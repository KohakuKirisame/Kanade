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
	<title>席位分配 - 奏Kanade</title>
</head>
<body>
@include("nav")
<main>
	<div class="container my-5">
		<h2 class="text-center my-3">席位管理</h2>
		<div class="row">
			<div class="card col-12 shadow my-2">
				<div class="card-body">
					<h4 class="card-title">意向委员会</h4>
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
								<h5 class="col-2 text-center">姓名</h5><h5 class="col-3 text-center">报名意向</h5><h5 class="col-2 text-center">学测分数</h5><h5 class="col-3 text-center">实际参会</h5><h5 class="col-2 text-center">席位</h5>
							</div>
						</li>
						@foreach($scored as $s)
							@php($del=$s["uid"])
							<li class="list-group-item mt-1" data-c="{{$s["cid"]}}" data-n="{{$delInfo[$del]["name"]}}" data-s="{{$delInfo[$del]["school"]}}" >
								<div class="row m-0">
									<p class="text-center col-2">{{$delInfo[$del]["name"]}}</p>
									<p class="text-center col-3">{{$committeeList[$s["cid"]]["committee"]}}</p>
									<p class="text-center col-2">{{number_format($s["score"],1)}}/{{number_format($committeeList[$s["cid"]]["score"],1)}}</p>
									<div class="col-3">
										@if($delSeat[$del]==0)
											<select class="form-select my-2" id="inCommittee-{{$del}}" onchange="updateSeat({{$del}});">
												<option value="0">请选择</option>
												@foreach($committeeList as $committee)
													<option value="{{$committee["cid"]}}" @if($s["cid"]==$committee["cid"])selected @endif>{{$committee["committee"]}}</option>
												@endforeach
											</select>
										@else
											<select class="form-select my-2" id="inCommittee-{{$del}}" onchange="updateSeat({{$del}});">
												<option selected value="0">请选择</option>
												@foreach($committeeList as $committee)
													<option value="{{$committee["cid"]}}" @if($delSeat[$del][0]==$committee["cid"])selected @endif>{{$committee["committee"]}}</option>
												@endforeach
											</select>
										@endif
									</div>
									<div class="col-2">
										<input class="form-control" type="text" placeholder="请填写席位" @if($delSeat[$del]!=0)value="{{$delSeat[$del][2]}}" @endif id="seat-{{$del}}" onchange="updateSeat({{$del}});" />
									</div>
								</div>
							</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
</main>
<div class="position-fixed top-0 end-0 p-3 toast-container" style="z-index: 11">
	<div id="updateSucToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
		<div class="toast-header"> <img src="/storage/kanade/logo.png" class="rounded me-2" style="width: 24px;height: 24px" /> <strong class="me-auto">奏Kanade</strong> <small>现在</small>
			<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
		</div>
		<div class="toast-body">
			<p>席位保存成功</p>
		</div>
	</div>
</div>
@include('footbar')
<script type="application/javascript" src="/js/admin/seat.js"></script>
</body>
</html>