<template>
    <!-- Footer -->
    <footer class="sticky-footer ">
        <div class="container my-auto">
            <div class="copyright text-center my-auto text-white">
                <span>Copyright &copy; <a href="https://chicorycom.net" target="_blank" class="text-danger">Chicorycom</a>  {{ year }}</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->
</template>

<script>
    export default {
        name: "VFooter",
        data: ()=>({
           year: new Date().getFullYear()
        })
    }
</script>

<style scoped>
    .sticky-footer {
        position: fixed;
        bottom: 0;
    }
</style>
