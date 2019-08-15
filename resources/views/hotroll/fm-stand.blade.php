
<script>
    $(function() {
        $("#next_coil").click(
            function()
            {
                $.ajax({
                    type:"GET",
                    url:"/t",
                    beforeSend:loading,//执行ajax前执行loading函数.直到success
                    success:Response //成功时执行Response函数
                })
            }
        )
    });
    function loading(){
        $("#next_coil").attr({ disabled: "disabled" });
    }
    function Response(data){
        $("#next_coil").removeAttr("disabled");
        alert(data);
        window.location.href = '/admin';
    }
    $(function(){
        $("#query").click(function(){
            $.get("/t", function(result){
                alert(result);
            });
        });
    });

    $.ajax({
        type: "post",
        data: studentInfo,
        contentType: "application/json",
        url: "/Home/Submit",
        beforeSend: function () {
            // 禁用按钮防止重复提交
            $("#submit").attr({ disabled: "disabled" });
        },
        success: function (data) {
            if (data == "Success") {
                //清空输入框
                clearBox();
            }
        },
        complete: function () {
            $("#submit").removeAttr("disabled");
        },
        error: function (data) {
            console.info("error: " + data.responseText);
        }
    });
</script>