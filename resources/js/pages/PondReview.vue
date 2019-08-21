<template>
    <div>
        <el-row>
            <el-card id="tool-box" class="box-card" shadow="always">

                <div slot="header" class="clearfix">
                    <span>查询面板</span>
                    <el-button style="float: right; padding: 3px 0" type="text">更多</el-button>
                </div>

                <el-tabs type="card" v-model="activeTab" @tab-click="tabClick">

                    <el-tab-pane label="按日期查询" name="date-query-tab">
                        <el-row>
                            <el-col :span="6">
                                <div class="block">
                                    <span class="demonstration">选择产线: </span>
                                    <el-select v-model="millLineValue" placeholder="请选择热轧产线">
                                        <el-option
                                                v-for="item in millLines"
                                                :key="item.value"
                                                :label="item.label"
                                                :value="item.value">
                                        </el-option>
                                    </el-select>

                                </div>
                            </el-col>
                            <el-col :span="6">
                                <div class="block">
                                    <span class="demonstration">  开始时间: </span>
                                    <el-date-picker
                                            v-model="startDate"
                                            type="datetime"
                                            placeholder="选择开始时间">
                                    </el-date-picker>
                                </div>
                            </el-col>

                            <el-col :span="6">
                                <div class="block">
                                    <span class="demonstration">  结束时间: </span>
                                    <el-date-picker
                                            v-model="endDate"
                                            type="datetime"
                                            placeholder="选择结束时间">
                                    </el-date-picker>
                                </div>
                            </el-col>

                            <el-col :span="6">
                                <el-button-group>
                                    <el-button type="primary" icon="el-icon-search" v-on:click="loadCoilsWithDates">载入热卷</el-button>
                                </el-button-group>
                            </el-col>

                        </el-row>
                    </el-tab-pane>


                    <el-tab-pane label="按卷号查询" name="coil-query-tab">
                        <el-row>
                            <el-col :span="4">
                                <span class="demonstration">输入卷号: </span>
                                <el-button-group>
                                    <el-input v-model="singleCoilId" placeholder="请输入热卷号"></el-input>
                                </el-button-group>
                            </el-col>

                            <el-col :span="4">
                                <el-button-group>
                                    <el-button type="primary" icon="el-icon-search" v-on:click="loadCoilsWithInput">载入热卷</el-button>
                                </el-button-group>

                            </el-col>

                        </el-row>
                    </el-tab-pane>
                </el-tabs>

                <el-row>
                        <el-button type="primary" icon="el-icon-watermelon" round v-on:click="changeToSingleCharts">单卷追溯</el-button>
                        <el-button type="primary" icon="el-icon-grape" round v-on:click="changeToMultiCharts">多卷追溯</el-button>
                </el-row>
            </el-card>
        </el-row>
        <el-row>
            <component v-bind:is='curChartsComponent' v-bind:coil-ids="this.curCoilIds" ></component>
        </el-row>
    </div>
</template>

<script>
    import axios from 'axios'
    import dateFmt from '../utils/datefmt.js'

    import SingleCoilCharts from "../components/CoilCharts/SingleCoilCharts";
    import MultiCoilsCharts from "../components/CoilCharts/MultiCoilsCharts";

    export default {
        name: "PondReview.vue",
        components: {
            'single-coil-charts': SingleCoilCharts,
            'multi-coils-charts': MultiCoilsCharts
        },
        data() {
            return {
                coilsDomain: "http://127.0.0.1:80/api/coils",
                activeTab: 'date-query-tab',
                curChartsComponent: 'single-coil-charts',

                startDate: '',
                endDate: '',
                singleCoilId: '',

                millLineValue:'',
                millLines: [{
                    value: '2250',
                    label: '热轧2250'
                }, {
                    value: '1580',
                    label: '热轧1580'
                }],
                curCoilIds:[]
            }
        },
        methods: {
            tabClick () {

            },
            getCoilIds (objArray) {
                return objArray.map(o => o["coil_id"])
            },
            judgeLine (coilId) {
                let line = "";
                if ( coilId[0] == "H" ) {
                    line =  "2250"
                } else if ( coilId[0] == "M" ) {
                    line =  "1580"
                } else {
                    this.invalidCoilId()
                }
                return line
            },
            invalidDates() {
                this.$alert('请选择正确的生产开始和结束时间', '无效的日期时间', {
                    confirmButtonText: '确定',
                    callback: () => {
                        this.$message({
                            type: 'info',
                            message: `无效的日期和时间`
                        });
                    }
                });
            },
            invalidCoilId() {
                this.$alert('请输入正确的热卷号', '无效的热卷号信息', {
                    confirmButtonText: '确定',
                    callback: () => {
                        this.$message({
                            type: 'info',
                            message: `无效的热卷号信息`
                        });
                    }
                });
            },
            loadCoilsWithDates () {
                if (this.startDate === '' || this.endDate === '') {
                    this.invalidDates()
                    return
                }

                if (this.endDate - this.startDate < 0) {
                    this.invalidDates()
                    return
                }

                console.log(this.startDate)
                console.log(this.endDate)
                let startDateStr = this.startDate.Format("yyyy-MM-dd hh:mm:ss")
                let endDateStr = this.endDate.Format("yyyy-MM-dd hh:mm:ss")
                console.log(startDateStr)
                console.log(endDateStr)

                axios.get(this.coilsDomain,{
                    params: {
                        line: this.millLineValue,
                        startDate: startDateStr,
                        endDate: endDateStr
                    }
                }).then(res => {
                    this.curCoilIds = this.getCoilIds(res.data["coilIds"])
                    alert(this.curCoilIds)
                })
            },
            loadCoilsWithInput () {
                if (this.singleCoilId === '') {
                    this.invalidCoilId()
                    return
                }
                console.log(this.judgeLine(this.singleCoilId))
                axios.get(this.coilsDomain,{
                    params: {
                        line: this.judgeLine(this.singleCoilId),
                        singleCoilId: this.singleCoilId,
                    }
                }).then(res => {
                    this.curCoilIds = this.getCoilIds(res.data["coilIds"])
                })
            },
            changeToSingleCharts () {
                this.curChartsComponent = "single-coil-charts"
            },
            changeToMultiCharts () {
                this.curChartsComponent = "multi-coils-charts"
            }
        },
        created () {
            Date.prototype.Format = dateFmt
        }
    }
</script>

<style scoped>
    .el-row {
        margin-bottom: 20px;
    }
</style>