<template>
    <div class="card">
        <header class="card-header card-header-with-icons">
            <h4 class="card-header-title" >Category Footer App</h4>

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
                        <li class="list-group-item d-flex justify-content-between" v-for="category in categories" >
                            {{ category.name }}
                            <div class="item_actions ">
                                <button class="btn btn-sm btn-warning text-right " v-on:click="edit(category.id)">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button class="btn btn-sm btn-danger pull-right delete" v-on:click="del(category.id)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <form @submit.prevent="save" @keydown="form.onKeydown($event)" class="card">
                        <div class="card-body pt-0">
                            <div class="form-group">
                                <label for="username">Name</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <span class="far fa-cat"></span>
                                        </span>
                                    </div>
                                    <input v-model="form.name" id="username" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" type="text" placeholder="name" />
                                    <has-error :form="form" field="name" />
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
            </div>
        </div>
    </div>
</template>

<script>
    import Form from "vform";
    import axios from "axios";

    export default {
        name: "category",
        data: () => ({
            categories: [],
            form: new Form({
                id: null,
                name: '',
            }),
        }),
        created (){
            this.fetchCategory()
        },
        methods: {
            async fetchCategory(){
                const { data } = await axios.get(`/${config.base}/category-data`);
                this.categories = data;
            },
            restore(){
                this.form.reset()
            },
            async save(){
                if(this.form.id){
                    await this.form.put(`/${config.base}/category-data/${this.form.id}`);
                    this.fetchCategory()
                }else{
                    await this.form.post(`/${config.base}/category-data`);
                    this.fetchCategory()
                }
                this.restore();
            },
            async edit(id){
                const { data } = await  axios.get(`/${config.base}/category-data/${id}/edit`);
                await this.form.fill(data);
            },
            del(id){
                this.$delete(id, async ()=>{
                    await axios.delete(`/${config.base}/category-delete/${id}`);
                    this.categories = this.categories.filter(data => data.id !== id);
                });
            }
        }
    }
</script>

<style scoped>

</style>
