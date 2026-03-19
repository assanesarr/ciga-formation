<template>
    <!-- Card -->
    <div class="card">
        <!-- Card Header -->
        <header class="card-header card-header-with-icons">
            <h4 class="h4 card-header-title"><i class=" mr-3 fas fa-users text-primary" ></i> Users</h4>
            <!-- Card Icons -->
            <ul class="list-inline mb-0">
                <li class="list-inline-item">
                    <button type="button" class="btn btn-sm btn-outline-primary" v-on:click="showModal = true">
                        <span class="fas fa-plus"></span> Ajouter
                    </button>
                </li>
                <li class="list-inline-item">
                    <button type="button" class="btn btn-sm btn-outline-primary"   >
                        <span class="fas fa-sync-alt"></span>
                    </button>
                </li>
                <li class="list-inline-item">
                    <button type="button" class="btn btn-sm btn-outline-primary"   >
                        <i class="fas fa-undo-alt"></i>
                    </button>
                </li>
            </ul>
            <!-- End Card Icons -->
        </header>
        <!-- End Card Header -->

        <!-- Crad Body -->
        <div class="card-body pt-0">
            <!-- Table with Image -->
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Company</th>
                        <th>Role</th>
                        <th>Salary</th>
                        <th class="text-center" >Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr v-for="user in users">
                        <td class="font-weight-semi-bold" v-text="user.id"></td>
                        <td class="font-weight-semi-bold">
                            <div class="media align-items-center">
                                <avatar class="img-profile rounded-circle mr-3" :size="30" :username="user.name ?  user.name : 'user name'"></avatar>
                                <span class="mr-2 media-body" v-text="user.name"></span>
                            </div>
                        </td>
                        <td class="font-weight-semi-bold" v-text="user.company"></td>
                        <td class="font-weight-semi-bold" v-text="user.roles ?  user.roles.display_name : ''"></td>
                        <td class="font-weight-semi-bold" v-text="user.salary"></td>


                        <td class="text-center">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <button type="button" class="btn btn-sm btn-outline-success"   >
                                        <span class="fas fa-eye"></span>
                                    </button>
                                </li>
                                <li class="list-inline-item">
                                    <button type="button" class="btn btn-sm btn-outline-warning"   v-on:click="onedit(user.id)">
                                        <span class="fas fa-edit"></span>
                                    </button>
                                </li>
                                <li class="list-inline-item">
                                    <button type="button" class="btn btn-sm btn-outline-danger" v-on:click="ondelete(user.id)">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </li>

                            </ul>
                        </td>

                    </tr>

                    </tbody>
                </table>
            </div>
            <!-- End Table with Image -->
        </div>
        <!-- Crad Body -->
        <modal v-if="showModal" v-on:close="restore(); showModal = false" btn :width="60">
            <div  class="card" slot="container">
                <span v-on:click="restore(); showModal = false" class="close "> <i class="far fa-times-circle"></i></span>
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
                                <div class="form-group">
                                    <label for="username">Name</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <span class="far fa-user"></span>
                                        </span>
                                        </div>
                                        <input v-model="form.name" id="username" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" type="text" placeholder="name" />
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
                                                <input v-model="form.email" id="email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" placeholder="email@email.com">
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
                                                <input  v-model="form.company" id="company" :class="{ 'is-invalid': form.errors.has('company') }" class="form-control" type="text" placeholder="Company">
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
                                                    <select class="custom-select mr-sm-2" id="role" v-model="form.role" :class="{ 'is-invalid': form.errors.has('role') }">
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
                    <footer class="card-footer d-md-flex align-items-center justify-content-between">
                        <button type="reset" class="btn btn-default" :loading="form.busy">
                            <h2><i class="fas fa-sync-alt"></i></h2>
                            Reset
                        </button>
                        <v-button type="submit" typeStyle="primary" :loading="form.busy">
                            <h2><i class="far fa-save"></i></h2>
                            Enregisté
                        </v-button>
                    </footer>
                </form>
            </div>
        </modal>

    </div>
    <!-- End Card -->
</template>

<script>
    import axios from 'axios'
    import Avatar from 'vue-avatar'
    import Form from "vform/src/Form";
    import Swal from "sweetalert2"

    export default {
        name: "users",
        data: ()=>({
            users: [],
            isShow: false,
            showModal: false,
            form: new Form({
                id: null,
                name: '',
                email: '',
                password: '',
                role : '',
                company : '',
                salary : ''
            }),
            roles: []
        }),
        components: {
            Avatar
        },
        created(){
            this.fetchUsers();
            this.getRoles();
        },
        methods: {
            async fetchUsers(){
                const { data } = await axios.get(`/${config.base}/users-fetch`);
                this.users = data;
            },
            restore(){
                this.form.reset()
            },
            async register(){
               if(this.form.id){
                    await this.form.put(`/${config.base}/user/${this.form.id}`);
                   this.fetchUsers()
               }else{
                   await this.form.post(`/${config.base}/user`);
                   this.fetchUsers()
               }
                this.restore();
                this.showModal = false;
            },
            async getRoles(){
                const { data } = await this.form.post(`/${config.base}/roles`);
                this.roles = data;
            },
            async onedit(id){
                const { data } = await axios.get(`/${config.base}/user/${id}/edit`);
                this.form.fill(data);
                this.showModal = true;
            },
            ondelete(id){
                Swal.fire({
                    title: 'Êtes-vous sûr?',
                    text: `de vouloire Supprimer définitivement`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: 'red',
                    confirmButtonText: 'Oui, supprimez-le!',
                    cancelButtonText: 'Non, garde-le'
                }).then(async result => {
                    if (result.value) {
                         await axios.delete( `/${config.base}/user/${id}`);
                        this.users = this.users.filter(user => user.id !== id);
                    }
                })
            },
        }
    }
</script>

<style scoped>

</style>
