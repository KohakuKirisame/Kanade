$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function saveScore(eid){
    var score=$("#score").val();
    var token=$('meta[name="csrf-token"]').attr('content');
    $.post("/Actions/SaveScore",{
        _token:token,
        eid:eid,
        score:score
    },function(data,status){
        if(data=="Success"){
            location.reload();
        }else{
            var err=JSON.parse(data);
            alert(err.Message);
        }
    });
}