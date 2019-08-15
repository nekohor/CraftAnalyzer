<div id="test" style="width: 100%;">
    <form class="navbar-form navbar-right" role="search">
        <div class="form-group">
        
            <select id="coil-select" class="form-control" onchange="changeFunc()">
            </select>

            <button id="query-button" class="btn btn-default">查询</button>
        
            <div class="btn-group" role="group">
                <button id="prev-coil-button" type="button" class="btn btn-default ">上一卷</button>
                <button id="next-coil-button" type="button" class="btn btn-default ">下一卷</button>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
    // buildSelectList();
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