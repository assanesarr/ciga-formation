<template>
    <form @submit.prevent="register" @keydown="form.onKeydown($event)" class="card">
        <header class="card-header card-header-with-icons">
            <h2 class="h4 card-header-title">
                <i class=" mr-3 fas fa-user text-primary"></i>
                Create User
            </h2>
            <ul class="list-inline mb-0">
                <li class="list-inline-item">
                    <button type="submit" class="btn btn-sm btn-outline-primary">
                        <span class="far fa-save"></span>
                    </button>
                </li>
                <li class="list-inline-item">
                    <button type="button" class="btn btn-sm btn-outline-primary">
                        <span class="fas fa-sync-alt"></span>
                    </button>
                </li>
                <li class="list-inline-item">
                    <button type="button" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-undo-alt"></i>
                    </button>
                </li>
            </ul>
        </header>
        <div class="card-body pt-0">
            <div class="card h-100">
                <div class="card-body pt-0">
                    <div class="form-group">
                        <label for="username">Name</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <span class="far fa-user"></span>
                                </span>
                            </div>
                            <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" type="text" placeholder="name" />
                            <has-error :form="form" field="name" />
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="row">
                        <div class="col-md-6 mb-5">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-envelope"></i>
                                        </span>
                                    </div>
                                    <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" placeholder="email@email.com">
                                    <has-error :form="form" field="email" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-5">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </div>
                                    <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-control" type="password" placeholder="********">
                                    <has-error :form="form" field="password" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7 mb-6">
                            <div class="form-group">
                                <label for="company">Company</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                           <i class="fas fa-building"></i>
                                        </span>
                                    </div>
                                    <input  v-model="form.company" :class="{ 'is-invalid': form.errors.has('company') }" class="form-control" type="text" placeholder="Company">
                                    <has-error :form="form" field="company" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 mb-4">
                            <div class="form-group">
                                <label for="role">Role</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-user-tag"></i>
                                        </span>
                                    </div>
                                    <select class="custom-select mr-sm-2" v-model="form.role" :class="{ 'is-invalid': form.errors.has('role') }">
                                        <option value="">Select Role</option>
                                        <option v-for="role in roles" :value="role.name" v-text="role.display_name"> </option>
                                    </select>
                                    <has-error :form="form" field="role" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-5">
                            <div class="form-group">
                                <label for="salary">Salary</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <span class="ti-credit-card"></span>
                                        </span>
                                    </div>
                                    <input id="salary" class="form-control" type="text" placeholder="1*****">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-5">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="card-footer d-md-flex align-items-center justify-content-between">
            <button type="reset" class="btn btn-default text-reset" :loading="form.busy">
                <h2><i class="fas fa-sync-alt"></i></h2>
                Reset
            </button>
            <button type="submit" class="btn btn-primary" :loading="form.busy">
                <h2><i class="far fa-save"></i></h2>
                Enregisté
            </button>
        </footer>
    </form>
</template>

<script>
    import Form from "vform/src/Form";

    export default {
        name: "create",
        metaInfo () {
            return { title: this.$t('register') }
        },
        data: () => ({
            form: new Form({
                name: '',
                email: '',
                password: '',
                role : '',
                company : '',
                salary : ''
            }),
            roles: []
        }),
        created(){
            this.getRoles()
        },
        methods: {
         async register(){
                const { data } = await this.form.post(`/${config.base}/user`)
                if(data.status){
                    this.$router.push({ name: 'users' })
                }
            },
            async getRoles(){
                const { data } = await this.form.post(`/${config.base}/roles`);
                this.roles = data;
            }
        }
    }
</script>

<style scoped>

</style>
