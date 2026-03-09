<template>
    <div id="content">
        <child />
    </div>
</template>

<script>
    export default {
        middleware: 'auth',
        name: "container"
    }
</script>

<style scoped>

</style>
