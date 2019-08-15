
@extends('admin.plot.base')


<canvas class="line" style="width: 100%;" id="line"></canvas>

<script>
        var myChart = echarts.init(document.getElementById("line"));
    
        var option = {
            title : {
                text: '时间变化图'   // 标题
            },
            tooltip : {
                trigger: 'axis'    // 折线图
            },
            legend: {
                data:['时间']   // 图例，就是折线图上方的符号
            },
            toolbox: {   // 工具箱，在折线图右上方的工具条，可以变成别的图像
                show : true,
                feature : {
                    mark : {show: true},
                    dataView : {show: true, readOnly: false},
                    magicType : {show: true, type: ['line', 'bar']},
                    restore : {show: true},
                    saveAsImage : {show: true}
                }
            },
            calculable : true,   // 是否启动拖拽重计算属性，默认false
            xAxis : [    // x坐标轴
                {
                    axisLine: {   // x坐标轴颜色
                        lineStyle: { color: '#333' }
                    },
                    axisLabel: {   // x轴的数据会旋转30度
                        rotate: 30,
                        interval: 0
                    },
                    type : 'category',
                    boundaryGap : false,   // x轴从0开始
                    data : []   // x轴数据
                }
            ],
            yAxis : [   // y轴
                {
                    type : 'value',
                    axisLabel : {
                        formatter: '{value} 秒'   // y轴的值都加上秒的单位
                    },
                    axisLine: {
                        lineStyle: { color: '#333' }
                    }
                }
            ],
            series : [    // 设置图标数据用
                {
                    name:'时间',    
                    type:'line',
                    smooth: 0.3,   // 线有弧度
                    data: [1,2,3,4,5]   // y轴数据
                }
            ]
        };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);  

</script>