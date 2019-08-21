<template>
    <el-card id="pond-chart" class="box-card" shadow="always">
        <div slot="header" class="clearfix">
            <span>多卷数据追溯</span>
        </div>

        <el-row>
            <el-col :span="12">
                <el-select v-model="value" multiple placeholder="请选择">
                    <el-option
                            v-for="item in options"
                            :key="item.value"
                            :label="item.label"
                            :value="item.value">
                    </el-option>
                </el-select>
            </el-col>

            <el-col :span="12">

            </el-col>
        </el-row>
    </el-card>
</template>

<script>
    export default {
        name: "MultiCoilsCharts",
        props: ["coilIds"],

    }
</script>

<style scoped>

</style>