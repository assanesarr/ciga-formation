<template>
    <div class="container min-vh-100">
        <div class="d-flex justify-content-center align-items-center min-vh-100">
            <div  class="card o-hidden border-0 shadow-lg my-5 w-100 card-login">
        <div class="card-body p-0 h">
            <div class="row h-100">
                <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                <div class="col-lg-6 d-flex align-items-center">

                    <div class="p-5 w-100" id="login-content">

                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4" v-text="title"></h1>
                        </div>
                        <form @submit.prevent="login" @keydown="form.onKeydown($event)" class="user">
                            <div class="form-group">
                                <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email">
                                <has-error :form="form" field="email" />
                            </div>
                            <!-- Password -->
                            <div class="form-group">
                                <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-control" type="password" name="password">
                                <has-error :form="form" field="password" />
                            </div>

                            <!-- Remember Me -->
                            <div class="form-group">
                                <div class=" d-flex">
                                    <checkbox v-model="remember" name="remember">
                                        {{ $t('remember_me') }}
                                    </checkbox>

                                    <router-link :to="{ name: 'password.request' }" class="small ml-auto my-auto">
                                        {{ $t('forgot_password') }}
                                    </router-link>
                                </div>
                            </div>
                                    <!-- Submit Button -->
                            <v-button :loading="form.busy" typeStyle="primary" :block="true" class="btn-user">
                                {{ $t('login') }}
                            </v-button>
                        </form>
                    </div>
                </div>
          <!-- Email -->
            </div>
        </div>
      </div>
        </div>
    </div>
</template>

<script>
import Form from 'vform'

export default {
  layout: 'basic',
  middleware: 'guest',
  components: {},

  metaInfo () {
    return { title: this.$t('login') }
  },

  data: () => ({
    form: new Form({
      email: '',
      password: ''
    }),
    remember: false,
    title: 'CIGA FORMATIONS'
  }),
  methods: {
    async login () {
      // Submit the form.
      const { data } = await this.form.post( `/${config.base}/login`);

      // Save the token.
      this.$store.dispatch('auth/saveToken', {
        token: data.token,
        remember: this.remember
      })

      // Fetch the user.
      await this.$store.dispatch('auth/fetchUser');

      // Redirect home.
      this.$router.push({ name: 'home' })
    }
  }
}
</script>
