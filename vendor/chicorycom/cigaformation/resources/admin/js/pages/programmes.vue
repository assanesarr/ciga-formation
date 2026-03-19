<template>
    <div class="card">
        <header class="card-header card-header-with-icons">
            <h4 class="card-header-title" >Programmes School</h4>

            <ul class="list-inline mb-0">
                <li class="list-inline-item">
                    <button type="button" class="btn btn-sm btn-outline-primary"  v-on:click="save" >
                        <span class="fas fa-save"></span>
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
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">

                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between" v-for="programme in programmes" :key="programme.id">
                            {{ programme.name }}
                            <div class="item_actions ">
                                <button class="btn btn-sm btn-warning text-right " v-on:click="edit(programme.id)">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button class="btn btn-sm btn-danger pull-right delete" v-on:click="del(programme.id)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </li>
                       <!-- <li class="list-group-item">Three
                            <ul class="list-group">
                                <li class="list-group-item">Item 3a</li>
                                <li class="list-group-item">Item 3b</li>
                            </ul>
                        </li> -->
                    </ul>
                </div>
                <div class="col-md-6">
                    <form @submit.prevent="save" @keydown="form.onKeydown($event)" class="card">
                        <div class="card-body pt-0">
                            <div class="form-group">
                                <label for="programme">Name</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <span class="far fa-cat"></span>
                                        </span>
                                    </div>
                                    <input v-model="form.name" id="programme" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" type="text" placeholder="name" />
                                    <has-error :form="form" field="name" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="menu">Programme Parent</label>
                                <select class="form-control" id="menu" v-model="form.parent_id">
                                    <option value="" >Sélectionne Programme</option>
                                    <option :value="programme.id"  v-for="programme in programmes" v-text="programme.name"></option>
                                </select>
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
            </div>
        </div>
    </div>
</template>

<script>
    import Form from "vform";
    import axios from "axios";

    export default {
        name: "programmes",
        data: () => ({
            programmes: [],
            form: new Form({
                id: null,
                name: '',
            }),
        }),

        created (){
           // this.fetchProgramme()
        },
        methods: {
            async fetchProgramme(){
                const { data } = await axios.get(`/${config.base}/programme-data`);
                this.programmes = data;
            },
            restore(){
                this.form.reset()
            },
            async save(){
                if(this.form.id){
                    await this.form.put(`/${config.base}/programme-data/${this.form.id}`);
                    this.fetchProgramme()
                }else{
                    await this.form.post(`/${config.base}/programme-data`);
                    this.fetchProgramme()
                }
                this.restore();
            },
            async edit(programme){
                const { data } = await  axios.get(`/${config.base}/programme-data/${programme.id}/edit`);
                await this.form.fill(data);
            },
            del(programme){
                this.$delete(programme.id, async () => {
                    await axios.delete(`/${config.base}/programme-delete/${programme.id}`);
                    this.categories = this.categories.filter(data => data.id !== programme.id);
                });
            }
        }
    }
</script>

<style scoped>

</style>
