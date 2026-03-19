<template>
    <div class="row">
        <div class="col-md-6 mb-5">
            <div class="card"><!-- Card Header -->
                <header class="card-header card-header-with-icons">
                    <h4 class="h4 card-header-title"> Public Menus </h4> <!-- Card Icons -->
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <button type="button" class="btn btn-sm btn-outline-primary" data-type="PUBLIC"  v-on:click="modalShow">
                                <span class="fas fa-plus"></span> Ajouter
                            </button>
                        </li>
                        <li class="list-inline-item">
                            <button type="button" class="btn btn-sm btn-outline-primary" >
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
                <div class="card-body ">
                    <alert-success :form="form" message="Your changes have been saved!"></alert-success>
                    <div class="dd" >
                        <nestable :menu_items="publicMenus" @del="del" @edit="edit"></nestable>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-5">
            <div class="card"><!-- Card Header -->
                <header class="card-header card-header-with-icons">
                    <h4 class="h4 card-header-title">Admin Menus </h4> <!-- Card Icons -->
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <button type="button" class="btn btn-sm btn-outline-primary"  data-type="ADMIN" v-on:click="modalShow">
                                <span class="fas fa-plus"></span> Ajouter
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
                <div class="card-body ">
                    <div class="dd" id="nestable">
                        <nestable :menu_items="menus" ></nestable>
                    </div>
                </div>
            </div>
        </div>
        <modal v-if="showModal" v-on:close="restore(); showModal = false" btn :width="60">
            <div  class="card" slot="container">
                <span v-on:click="restore(); showModal = false" class="close"> <i class="far fa-times-circle"></i></span>
                <form  @submit.prevent="store" @keydown="form.onKeydown($event)">

                    <header class="card-header card-header-with-icons">
                        <h1 class="h2 mb-2">Create {{ type }} MENU</h1>
                    </header>
                    <div class="card-body ">
                       <div class="row">
                           <div class="col-md-6">
                               <div class="form-group">
                                   <label for="name">Name</label>
                                   <input id="name" v-model="name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" type="text"  placeholder="menu name">
                                   <has-error :form="form" field="name" />
                               </div>
                           </div>
                           <div class="col-md-6">
                               <div class="form-group">
                                   <label for="slug">Slug</label>
                                   <input id="slug" class="form-control" type="text"  v-model="form.slug" :class="{ 'is-invalid': form.errors.has('slug') }" placeholder="slug">
                                   <has-error :form="form" field="slug" />
                               </div>
                           </div>
                       </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="icon">Icon</label>
                                    <input id="icon" class="form-control" v-model="form.icon" type="text"  placeholder="fas fa-xxx">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="menu">Menu Parent</label>
                                    <select class="form-control" id="menu" v-model="form.parent_id">
                                        <option value="" >Sélectionne Menu</option>
                                        <option :value="menu.id"  v-for="menu in type === 'PUBLIC' ? publicMenus : menus" v-text="menu.name"></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="target">Target</label>
                                    <input id="target" class="form-control" type="text"  placeholder="_self or _blank">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="order">Order</label>
                                    <input id="order" class="form-control" type="number" v-model="form.order" placeholder="Order 1.2.3....">
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="" target="_blank"></a>
                    <footer class="card-footer d-md-flex align-items-center justify-content-between">
                        <v-button :loading="form.busy" type="reset" typeStyle="default" >
                            <h2 ><i class="fas fa-sync-alt"></i></h2>
                            Reset
                        </v-button>
                        <v-button :loading="form.busy" class="btn btn-primary" >
                                <h2 >
                                    <i class="fas fa-save"></i>
                                </h2>
                                Enregisté
                        </v-button>
                    </footer>
                </form>
            </div>
        </modal>
    </div>
</template>

<script>
    import Form from 'vform'
    import { mapGetters } from 'vuex'
    import Nestable from '../components/Nestable'
    export default {
        name: "menus",
        data: () => ({
            form: new Form({
                id: null,
                name: '',
                type: '',
                parent_id: '',
                slug: '',
                icon: '',
                target: '_self',
                order: 1,
            }),
            showModal: false,
            type: '',
            loading: false,
            name: ''
        }),
        computed: {
            ...mapGetters({
                menus: 'menus/adminMenus',
                publicMenus: 'menus/publicMenus'
            }),
        },
        watch: {
            name (val) {
                this.form.name = val;
                this.form.slug = this.slugify(val)
            },
        },
        components: { Nestable },
        methods: {
            restore(){
                this.form.reset()
            },
            edit(menu){
                this.name = menu.name;
                this.form.fill(menu);
                this.showModal = true;
                this.type = menu.type;
            },
           async store(){
                this.form.type = this.type;
                const { data } = await this.form.post(`/${config.base}/menus-store`);
                this.$store.commit(`menus/FETCH_${this.type}_MENUS`, {menus: data});
               this.form.reset();
               this.showModal = false;
            },
            modalShow(e){
                this.showModal = true;
                this.type = e.target.dataset.type;
            },
            del(menu){
                this.$delete(menu, () => {
                    this.$store.dispatch('menus/deleteMenus', menu)
                });
            }

        }
    }
</script>

<style scoped>

</style>
