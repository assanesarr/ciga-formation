<template>
    <div class="d-flex flex-wrap" >
        <div class="page grid-type"  v-if="type === 'GRID'" v-for="i in 12"></div>
        <div class="page list-type" v-if="type === 'LIST'" v-for="i in 3"></div>
        <div class="d-flex w-100 mb-1" v-if="type === 'DETAIL'" v-for="i in 2">
            <div class="page detail-type" ></div>
            <div class="d-flex flex-column w-50">
                <p class="detail-text page"></p>
                <p class="detail-text page"></p>
                <p class="detail-text page"></p>
                <p class="detail-text page half"></p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "TypePage",
        props: {
            type: { type: String, default: 'GRID' }
        },
    }
</script>

<style scoped lang="scss">
    .page{
        background: #b5c3ca;
    }
    .grid-type {
        width: 70px;
        height: 50px;
        margin: 4px;
    }
    .list-type{
        width: 100%;
        height: 50px;
        margin: 7px 0;
    }
    .detail-type {
        width: 50%;
        height: 100px;
    }
    .detail-text {
        margin: 7px;
        width: 100%;
        height: 10px;
        border-radius: 2px;
        &.half{
            width: 50%;
        }
    }
</style>
