$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});
function htmlCharacters(s){
	s = s.replace(/&/g, "&amp;");
	s = s.replace(/</g, "&lt;");
	s = s.replace(/>/g, "&gt;");
	s = s.replace(/\'/g, "&#39;");
	s = s.replace(/\"/g, "&quot;");
return s;
}
function sendTest(){
	var data={};
	var answers=$("textarea[id^=answer]");
	for(i=0;i<answers.length;i++){
		data[i]={"qid":parseInt(answers[i].getAttribute("id").slice(6)),"answer":htmlCharacters(answers[i].value)};
	}
	var token=$('meta[name="csrf-token"]').attr('content');
	$.post("/Actions/UpdateAnswer",{
		_token:token,
		data:data
	},function(data){
		if(data=="Success"){
			var toastId=$("#updateSucToast");
			var toast=new bootstrap.Toast(toastId);
			toast.show();
			setTimeout(function(){toast.hide()},3000);
		}
	});
}