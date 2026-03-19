<template>
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion " :class="{ 'toggled': isToggled}" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <div class="sidebar-brand d-flex align-items-center justify-content-center">
            <div class="sidebar-brand-icon rotate-n-15">
                CIGA
            </div>
            <div class="sidebar-brand-text mx-3">Formation</div>
        </div>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <template v-for="menu in $datas" >
            <template v-if="menu.children.length === 0">
                <li class="nav-item active" >
                    <router-link :to="menu.slug" class="nav-link" >
                        <i :class="menu.icon"></i>
                        <span v-text="menu.name"></span>
                    </router-link>
                </li>
            </template>

            <template  v-else>
                <hr class="sidebar-divider">
                <div class="sidebar-heading">
                    {{ menu.name }}
                </div>
                <template v-for="child in menu.children">
                    <li class="nav-item">
                        <router-link :to="child.slug" class="nav-link" >
                            <i :class="child.icon"></i>
                            <span v-text="child.name"></span>
                        </router-link>
                    </li>
                </template>
            </template>
        </template>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle" @click.prevent="sidebarToggle"></button>
        </div>
        <v-footer/>
    </ul>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        name: "SideBar",
        data: ()=>{
            return {
                isToggled: false,
            }
        },
        computed: mapGetters({
            menus: 'menus/adminMenus'
        }),
        created(){
            this.$store.dispatch('menus/fetchMenus');
        },
        methods: {
            sidebarToggle(){
                if(document.body.classList.contains('sidebar-toggled')){
                    document.body.classList.remove('sidebar-toggled');
                    this.isToggled = false
                }else{
                    document.body.classList.add('sidebar-toggled');
                    this.isToggled = true
                }
            }
        }
    }
</script>

<style scoped>

</style>
