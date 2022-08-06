$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function enroll(type,committee){
    var token=$('meta[name="csrf-token"]').attr('content');
    var inviteCode=$("#inviteCode"+committee).val();
    $.post("/Actions/Enroll",{
        type:type,
        committee:committee,
        _token:token,
        invitation_code:inviteCode
    },function(data){
        if(data=="1"){
            window.location.href="/";
        }
    });
}