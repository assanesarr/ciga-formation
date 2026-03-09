<template>
  <div id="wrapper" class="main-layout">
      <loading :active.sync="loading"></loading>
        <side-bar />
      <div id="content-wrapper" class="d-flex flex-column">
          <div id="content">
            <navbar />
              <div class="container-fluid" id="container-fluid">
                  <child />
              </div>
          </div>
      </div>
  </div>
</template>

<script>
import Navbar from '~/components/Navbar'
import SideBar from '~/components/SideBar'
import axios from "axios";

export default {
  middleware: 'auth',
  name: 'MainLayout',
    data: ()=>({
        loader: null,
        loading: false
    }),

  components: {
    Navbar,
    SideBar
  },
    created(){
        axios.interceptors.request.use(request => {
            this.loading = true;
            return request
        });
        axios.interceptors.response.use(response => {
            this.loading = false;
            return response
        }, error => {
            this.loading = false;
            return Promise.reject(error)
        })
    },
  mounted(){
      this.$router.beforeEach((to, from, next) => {
         this.loader = this.$loading.show();
          next()
      });
      this.$router.afterEach((to, from, next) => {
          if(this.loader){
              this.loader.hide();
          }
      })


  },

}
</script>
