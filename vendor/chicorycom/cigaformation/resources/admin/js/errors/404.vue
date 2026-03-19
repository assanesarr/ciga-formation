<template>
    <card class="text-center">
        <div class="text-center">
            <div class="error mx-auto" data-text="404">404</div>
            <p class="lead text-gray-800 mb-5" v-text="$t('page_not_found')"></p>
            <p class="text-gray-500 mb-0">Il semble que vous ayez trouvé un problème dans la matrice...</p>
            <p class="text-gray-500 mb-0">Page en construction...</p>
            <div class="links">
                <router-link :to="{ name: 'slide' }">
                    {{ $t('go_home') }}
                </router-link>
            </div>
        </div>
    </card>
</template>

<script>
    export default {
        name: 'NotFound'
    }
</script>

<style scoped>

</style>
