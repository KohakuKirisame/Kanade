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
	<script type="application/javascript">var n={{count($data)}};</script>
	<script type="application/javascript" src="/js/admin/test-review.js"></script>
	<title>学测 - 奏Kanade</title>
</head>
<body>
<main>
	<div class="up-notice" id="up-notice"></div>
	<div class="container mb-5">
		<div class="row justify-content-center">
			<h3 class="text-center my-4 col-12">学术测试 #{{strtoupper(substr(md5($eid),-6,6))}}</h3>
			<h5 class="text-center mb-4">更新时间: <font class="text-danger">{{$data[0]["updateTime"]}}</font></h5>
			@csrf
			@foreach($data as $item)
				<div class="card col-12 col-lg-8 my-3 shadow">
					<div class="card-body px-2 py-3">
						<p class="my-2">{!!nl2br(e($item["question"]))!!}</p>
						<div class="form-floating">
							<textarea class="form-control" placeholder="答案" id="answer{{$item["qid"]}}" style="height: 100px" readonly>{{htmlspecialchars_decode($item["answer"])}}</textarea>
							<label for="answer{{$item["qid"]}}">答案</label>
						</div>
					</div>
				</div>
			@endforeach
		</div>
			<div class="row justify-content-between mt-2 mb-5">
				<div class="col-3">
					<button onclick="window.opener=null;window.close();" class="btn btn-primary">关闭</button>
				</div>
				<div class="col-6">
					<div class="row justify-content-end">
						@if($score==0)
							<input class="col" type="number" max="{{$totalScore}}" min="0" step="0.1" placeholder="分数(可精确到0.1)" id="score"><p class="col" style="font-size: x-large">/{{number_format($totalScore,1)}}</p>
						@else
							<p class="col" style="font-size: x-large">{{number_format($score[1],1)}}/{{number_format($totalScore,1)}}</p>
						@endif
						@if($score==0)
							@if(time()>=strtotime($ddl))<button class="btn btn-danger col" onclick="saveScore({{$eid}});">评阅</button>@else<button class="btn btn-secondary col" data-bs-toggle="tooltip" data-bs-placement="top" title="评阅还未开始">评阅</button>@endif
						@else
							<p class="col" style="font-size: x-large">阅卷人：{{$score[2]}}</p>
						@endif
					</div>

				</div>
			</div>
	</div>
</main>
<div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
	<div id="updateSucToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
		<div class="toast-header"> <img src="/storage/kanade/logo.png" class="rounded me-2" style="width: 24px;height: 24px" /> <strong class="me-auto">奏Kanade</strong> <small>现在</small>
			<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
		</div>
		<div class="toast-body">
			<p>学测保存成功</p>
		</div>
	</div>
</div>
@include("footbar")
<script type="application/javascript">
    var tooltipTriggerList = Array.prototype.slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
</script>
</body>
</html>