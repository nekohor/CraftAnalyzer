<template>
    <el-popover
            :ref="popoverRef"
            placement="bottom"
            title="载入热卷号"
            width="200"
            trigger="manual"
            :content="已经载入{{ coilNum }}卷热卷信息。">
    </el-popover>
</template>

<script>
    export default {
        name: "LoadCoilsPopover",
        props: ["popoverRef","coilNum"],
        data () {
            return {
                popoverContent: ""
            }
        }
    }
</script>

<style scoped>

</style>