<template>
    <el-row>
        <el-col :span="24">

            <el-card id="tool-box" class="box-card" shadow="always">

                <div slot="header" class="clearfix">
                    <span>查询面板</span>
                    <el-button style="float: right; padding: 3px 0" type="text">操作按钮</el-button>
                </div>

                <el-tabs type="card" v-model="activeTab" @tab-click="tabClick">

                    <el-tab-pane label="按日期查询" name="date-query-tab">
                        <el-row>
                            <el-col :span="8">
                                <div class="block">
                                    <span class="demonstration">  开始时间: </span>
                                    <el-date-picker
                                            v-model="startDate"
                                            type="datetime"
                                            placeholder="选择开始时间">
                                    </el-date-picker>
                                </div>
                            </el-col>

                            <el-col :span="8">
                                <div class="block">
                                    <span class="demonstration">  结束时间: </span>
                                    <el-date-picker
                                            v-model="endDate"
                                            type="datetime"
                                            placeholder="选择结束时间">
                                    </el-date-picker>
                                </div>
                            </el-col>

                            <el-col :span="8">
                                <el-button type="primary" icon="el-icon-search">载入热卷</el-button>

                            </el-col>
                        </el-row>
                    </el-tab-pane>


                    <el-tab-pane label="单卷查询" name="coil-query-tab">
                        <el-row>
                            <el-col :span="12">
                                <el-input v-model="singleCoilId" placeholder="请输入热卷号"></el-input>
                            </el-col>

                            <el-col :span="12">
                                <el-button type="primary" icon="el-icon-search">载入热卷</el-button>
                            </el-col>
                        </el-row>

                    </el-tab-pane>
                </el-tabs>

                <div>
                    <el-button-group>
                        <el-select v-model="value1" multiple placeholder="请选择">
                            <el-option
                                    v-for="item in options"
                                    :key="item.value"
                                    :label="item.label"
                                    :value="item.value">
                            </el-option>
                        </el-select>
                    </el-button-group>

                    <el-button-group>
                        <el-button type="primary" icon="el-icon-search">查询卷号</el-button>
                    </el-button-group>

                    <el-button-group>
                        <el-button type="primary" icon="el-icon-arrow-left">上一卷</el-button>
                        <el-button type="primary">下一卷<i class="el-icon-arrow-right el-icon--right"></i></el-button>
                    </el-button-group>

                    <el-button-group>
                        <el-button type="primary" icon="el-icon-edit"></el-button>
                        <el-button type="primary" icon="el-icon-share"></el-button>
                        <el-button type="primary" icon="el-icon-delete"></el-button>
                    </el-button-group>
                </div>
            </el-card>

            <el-card id="pond-chart" class="box-card" shadow="always">

            </el-card>
        </el-col>
    </el-row>

</template>

<script>
    export default {
        name: "PondReview.vue",
        data() {
            return {
                activeTab: 'date-query-tab',
                singleCoilId: '',
                options: [{
                    value: '选项1',
                    label: '黄金糕'
                }, {
                    value: '选项2',
                    label: '双皮奶'
                }, {
                    value: '选项3',
                    label: '蚵仔煎'
                }, {
                    value: '选项4',
                    label: '龙须面'
                }, {
                    value: '选项5',
                    label: '北京烤鸭'
                }],
                value1: ["选项1"],
                value2: [],
                startDate: '',
                endDate: '',
            }
        },
        methods: {
            tabClick () {
                alert("hehe")
            }
        }
    }
</script>

<style scoped>
</style>