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
	<script type="application/javascript" src="/js/test.js"></script>
	<title>学测 - 奏Kanade</title>
</head>
<body>
@include("nav")
<main>
	<div class="up-notice" id="up-notice"></div>
	<div class="container mb-5">
		<div class="row justify-content-center">
			<p><a class="btn btn-primary mt-4" href=".">返回</a></p>
			<h3 class="text-center my-1">学术测试</h3>
			<h5 class="text-center mb-4">Deadline: <font class="text-danger">{{$ddl}}</font></h5>
			@csrf
			@foreach($data as $item)
				<div class="card col-12 col-lg-8 my-3 shadow">
					<div class="card-body px-2 py-3">
						<p class="my-2">{!!nl2br(e($item["question"]))!!}</p>
						<div class="form-floating">
							<textarea class="form-control" placeholder="答案" id="answer{{$item["qid"]}}" style="height: 100px" @if(time()>=strtotime($ddl))readonly @endif>{{htmlspecialchars_decode($item["answer"])}}</textarea>
							<label for="answer{{$item["qid"]}}">答案</label>
						</div>
					</div>
				</div>
			@endforeach
		</div>
		@if(time()<strtotime($ddl))
		<div class="row justify-content-center my-2">
			<button class="btn btn-success col-4 col-lg-2 shadow" onclick="sendTest()">保存</button>
		</div>
		@endif
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
<!-- Background file ends -->
@include("footbar")
</body>
</html>