<template>
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button class="btn btn-link d-md-none rounded-circle mr-3" @click.prevent="sidebarToggleTop">
            <i class="fa fa-bars"></i>
        </button>
        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <div class="nav-link dropdown-toggle cursor-pointer"  :class="{'show': isShow }" @click.prevent="isShow = !isShow">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small" v-text="user.name ? user.name : ''"></span>
                    <avatar class="img-profile rounded-circle" :size="30" :username="user.name ?  user.name : 'user name'"></avatar>
                </div>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" :class="{'show': isShow }" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                        Settings
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                        Activity Log
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item"  @click="logout">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
            </li>

        </ul>

    </nav>
</template>

<script>
import { mapGetters } from 'vuex'
import Avatar from 'vue-avatar'

export default {
  components: {
    Avatar
  },

  data: () => ({
    appName: window.config.appName,
    isShow: false
  }),

  computed: mapGetters({
    user: 'auth/user'
  }),
  methods: {
    sidebarToggleTop(){
          document.body.classList.toggle('sidebar-toggled');
          document.getElementById('accordionSidebar').classList.toggle('toggled');
      },
    async logout () {
      // Log out the user.
      await this.$store.dispatch('auth/logout')

      // Redirect to login.
      this.$router.push({ name: 'login' })
    }
  }
}
</script>

<style scoped>
.profile-photo {
  width: 2rem;
  height: 2rem;
  margin: -.375rem 0;
}
</style>
