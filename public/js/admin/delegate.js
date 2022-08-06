function searchCommittee(){
    var cid=$("#searchCommittee").val();
    var li=$("li[data-c]");
    if(cid==0){
        li=$("li[data-c]");
        for(var i=0;i<li.length;i++){
            li[i].style.display="block";
        }
    }else{
        li=$("li[data-c][data-c!="+cid+"]");
        for(var i=0;i<li.length;i++){
            li[i].style.display="none";
        }
        li=$("li[data-c="+cid+"]");
        for(var i=0;i<li.length;i++){
            li[i].style.display="block";
        }
    }
}

function searchDelegate(){
    var del=$("#searchDelegate").val();
    $("li[data-n][data-s]").each(function (index,element){element.style.display="none";});
    if(del!=""){
        var li=$("li[data-n*='"+del+"'],li[data-s*='"+del+"']");
        li.each(function (index,element){element.style.display="block";});
    }else{
        $("li[data-n][data-s]").each(function (index,element){element.style.display="block";});
    }

}
