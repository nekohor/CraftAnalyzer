<template>
    <el-card id="pond-chart" class="box-card" shadow="always">
        <div slot="header" class="clearfix">
            <span>单卷数据追溯</span>
        </div>

        <el-row>

            <el-button-group>
                <el-select v-model="curCoilIdValue" placeholder="请选择热卷号">
                    <el-option

                            v-for="item in getCoilOptions()"
                            :key="item.value"
                            :label="item.label"
                            :value="item.value">
                    </el-option>
                </el-select>
            </el-button-group>


            <el-button-group>
                <el-button type="primary" icon="el-icon-brush" @click="">绘制图表</el-button>
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
        </el-row>

        <el-row>
            <el-tabs tab-position="right" v-model="activeTabName" style="height: 200px;" @tab-click="handleClick">
                <el-tab-pane label="中间坯板形" name="transferBarShape">
                    中间坯板形
                </el-tab-pane>
                <el-tab-pane label="精轧F1到F7" name="fmStands">
                    <finishing-mill-stands></finishing-mill-stands>
                </el-tab-pane>

            </el-tabs>
        </el-row>

    </el-card>
</template>

<script>
    import coilUtils from "../../utils/coilUtils.js"
    import FinishingMillStands from "../Palette/FinishingMillStands";

    export default {
        name: "SingleCoilCharts",
        props: ["coilIds"],
        components: {
            "finishing-mill-stands": FinishingMillStands
        },
        data () {
            return {
                curCoilIdValue: '',
                activeTabName: 'fmStands',

            }
        },
        methods: {
            getCoilOptions () {
                return coilUtils.getCoilOptions(this.coilIds)
            },

            getCoilPondData (pondCoilIds) {
                axios.get(

                )
            }

        },
        watch:{
            coilIds: function (newVal,oldVal){
                this.curCoilIdValue = this.getCoilOptions()[0].value
            }
        }
    }

</script>

<style scoped>

</style>