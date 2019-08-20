<div class="row">
    <div class="col-lg-6">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
        <button id="query" class="btn btn-default" type="button">{{ __("hotroll.query") }}</button>
      </span>
        </div><!-- /input-group -->
    </div><!-- /.col-lg-6 -->

    <div class="btn-group" role="group" aria-label="...">
        <button id="last_coil" type="button" class="btn btn-default">{{ __("hotroll.last_coil") }}</button>
        <button id="next_coil" type="button" class="btn btn-default">{{ __("hotroll.next_coil") }}</button>
    </div>
</div>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Brand</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                <li><a href="#">Link</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Link</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>


<script>
    window.stdCharts = {};
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
        // window.location.href = '/admin/review';
        $("")
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