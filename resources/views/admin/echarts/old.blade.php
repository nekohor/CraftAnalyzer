<body data-spy="scroll" data-target="#myScrollspy">
    <div class="container">
    <nav id="nav" class="navbar navbar-fixed-top navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">热轧参数分析系统</a>
                <p class="navbar-text"></p>
            </div>
            <form class="navbar-form navbar-right" role="search">
                <div class="form-group">
                
                    <select id="coil-select" class="form-control" onchange="changeFunc()">
                    </select>

                    <!-- <button id="query-button" class="btn btn-default">查询</button> -->
                
                    <div class="btn-group" role="group">
                        <button id="prev-coil-button" type="button" class="btn btn-default ">上一卷</button>
                        <button id="next-coil-button" type="button" class="btn btn-default ">下一卷</button>
                    </div>
                </div>
            </form>
        </div>
    </nav>
    <div style="height:50px;"></div>
    </div>


    <div class="container">
        <div class="jumbotron">
            <div class="container">
                <h1>欢迎使用！</h1>
                <p>在这里，您能够快速地对热轧生产不稳定的过程参数进行比较和分析。</p>
            </div>
        </div>

        <div class="col-xs-9">
            <div class="page-header">
                <h1>板形参数对比</h1>
            </div>
            <div id="shape" style="width: 768px;height:512px;"></div>
            <a name="about-us" style="position: relative;top: -80px;"></a>
            <h2>温度对比</h2>
            <div id="temprature" style="width: 768px;height:512px;"></div>
            <h2>调平控制</h2>
            <div id="leveling" style="width: 768px;height:512px;"></div>

            <div id="levelingForceDiff14_Title" class="page-header">
                <h1 >调平和轧制力偏差F1-F4</h1>
            </div>
            <div id="levelingForceDiff14" style="width: 768px;height:512px;"></div>
            <h2>调平和轧制力偏差F5-F7</h2>
            <div id="levelingForceDiff57" style="width: 768px;height:512px;"></div>
            <h2>活套角度</h2>
            <div id="looper" style="width: 768px;height:512px;"></div>
        </div>
        <!-- <div class="col-xs-3" id="myScrollspy">
            <ul class="nav nav-tabs nav-stacked" data-spy="affix" data-offset-top="125">
                <li class="active">
                    <a href="#section-1">第一部分</a>
                </li>
                <li>
                    <a href="#temprature">第二部分</a>
                </li>
                <li>
                    <a href="#leveling">第三部分</a>
                </li>
                <li>
                    <a href="#levelingForceDiff14_Title">第四部分</a>
                </li>
                <li>
                    <a href="#section-5">第五部分</a>
                </li>
            </ul>
        </div> -->
        <!-- <ul class="nav bs-docs-sidenav col-xs-3">
        
            <li class="">
                <a href="#temprature">Glyphicons 字体图标</a>
                <a href="#glyphicons">Glyphicons 字体图标</a>
                <a href="#glyphicons">Glyphicons 字体图标</a>
            </li>
        </ul> -->
        <!-- <div>
            <div style="height:40px;"></div>
            <section class='footer' style="position:fixed">

            </section>

        </div> -->

</div>

<script type="text/javascript">
    buildSelectList();
    plotList = ["shape", "temprature", "leveling",
        "levelingForceDiff14", "levelingForceDiff57", "looper"];
    buildCharts(myChart, plotList);
    update("default", myChart, totalConfig, plotList);

    // $('#coil-select').change(function () {
    //     var curCoilId = $("#coil-select").find("option:selected").text();
    //     update(curCoilId, myChart, totalConfig, plotList);
    // });

    var changeFunc = function () {
        var curCoilId = $("#coil-select").find("option:selected").text();
        update(curCoilId, myChart, totalConfig, plotList);
    };

    // $("#query-button").click(function () {
    //     var curVal = $("#coil-select").find("option:selected").val();
    //     update(curCoilId, myChart, totalConfig, plotList);
    // });

    document.getElementById('prev-coil-button').onclick = function () {
        var curVal = $("#coil-select").find("option:selected").index();
        if (curVal == 0) {
            alert("已经是第一卷！");
        } else {
            $("#coil-select").find("option[value='{0}']".format(curVal - 1)).attr("selected", true);
            // $('#coil-select').trigger('change');
            $('#coil-select').change();
        }
    };

    document.getElementById('next-coil-button').onclick = function () {
        var curVal = $("#coil-select").find("option:selected").index();
        var maxVal = $("#coil-select").find("option:last").index();
        if (curVal == maxVal) {
            alert("已经是最后一卷！");
        } else {
            $(function () {
                $("#coil-select").find("option[value='{0}']".format(curVal + 1)).attr("selected", true);
                // $('#coil-select').trigger('change');
                $('#coil-select').change();
            });
        }
    };

    window.onbeforeunload = function () {
        var scrollPos;
        if (typeof window.pageYOffset != 'undefined') {
            scrollPos = window.pageYOffset;
        }
        else if (typeof document.compatMode != 'undefined' && document.compatMode != 'BackCompat') {
            scrollPos = document.documentElement.scrollTop;
        }
        else if (typeof document.body != 'undefined') {
            scrollPos = document.body.scrollTop;
        }
        document.cookie = "scrollTop=" + scrollPos; //存储滚动条位置到cookies中
    };

    window.onload = function () {
        if (document.cookie.match(/scrollTop=([^;]+)(;|$)/) != null) {
            var arr = document.cookie.match(/scrollTop=([^;]+)(;|$)/); //cookies中不为空，则读取滚动条位置
            document.documentElement.scrollTop = parseInt(arr[1]);
            document.body.scrollTop = parseInt(arr[1]);
        }
    };
</script>