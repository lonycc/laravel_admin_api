/**
 * Created by Administrator on 2017/7/6.
 */
$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
    }
});

function parentChange(obj,id) {
    var action_id = 'action_' + id;
    var smObj = document.getElementsByClassName(action_id);
    if (obj.checked == false) {
        for (var i = 0; i < smObj.length; i++)
            smObj[i].checked = false;
    }else{
        for (var i = 0; i < smObj.length; i++)
            smObj[i].checked = true;
    }
}
function childrenChange(obj,id) {
    var action_id = 'action_' + id;
    var smObj = document.getElementsByClassName(action_id);
    var bigObj = document.getElementById(action_id);
    if (obj.checked == true)
        bigObj.checked = true;
    else {
        b = true;
        for (var i = 0; i < smObj.length; i++) {
            if (smObj[i].checked == true)
                b = false;
        }
        if (b == true)
            bigObj.checked = false;
    }
}


$(".resource-delete").click(function(event){
    if(confirm("确认执行删除操作么？") == false){
        return ;
    }
    var target = $(event.target);
    event.preventDefault();
    var url = target.attr('delete-url');

    $.ajax({
        url :       url,
        method:     "post",
        data:       {"_method":"DELETE"},
        dataType:   "json",
        success:    function(data){
            if(data.error != 0){
                alert(data.msg);
                return;
            }
            window.location.reload();
        }
    })
});