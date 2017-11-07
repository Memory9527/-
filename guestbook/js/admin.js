$(document).ready(function(){
    var id=0;
    $(".replybox").click(function(){
        $("body").css({
            "overflow-x":"hidden",
            "overflow-y":"auto",
            "margin":"0"
        });
        $("#hidden").css({
            "height":"100%",
            "width":"100%",
            "display":"block"
        });
        $("#reply").css({
            "display":"block",
            "opacity":"1"
        });
        id = $(this).parent().siblings('.id').text();
    });

    function close(){
        $("#hidden").css({
            "height":"",
            "width":"",
            "display":"none"
        });
        $("#reply").css({
            "display":"none",
            "opacity":"0"
        });
    }
    $("#hidden").on("click",close);
    $("#close").on("click",close);

    $("#sub").click(function(){
        var reply = $("#reply-content").val();

        $.post('./reply.php',{reply:reply,id:id},function(data,textStatus,xhr){
            if(textStatus = 'success') {
                var data = $.parseJSON(data);
                alert(data.msg);
                window.location.reload();
            }

        });
    });

    var status =0;
    $(".lock").click(function(){
        id =$(this).parent().siblings('.id').text();
        if($(this).val()=="unlock"){
            status = 1;
        }

        $.post('./lock.php',{id:id,status:status},function(data,textStatus,xhr){
            if(textStatus = 'success'){
                var data = $.parseJSON(data);
                alert(data.msg);
                window.location.reload();
            }
        });
    });
});
