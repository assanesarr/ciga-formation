<template>
    <div class="card">
        <header class="card-header card-header-with-icons">
            <h4 class="card-header-title">All Pages front</h4>
            <ul class="list-inline mb-0">
                <li class="list-inline-item">
                    <button type="button" class="btn btn-sm btn-outline-primary"  v-on:click="showModal = true" >
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
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-12" v-for="page in pages">
                    <div class="card">
                        <div class="overlay-page">
                            <img class="card-img" :src="page.thumbnail" alt="Card image">
                            <div class="caption d-flex align-items-center justify-content-center text-white">
                                <h5 class="card-title" v-text="page.title"></h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <type-page :type="page.type"/>
                        </div>
                        <div class="card-footer align-items-center justify-content-center d-flex">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <button type="button" class="btn btn-sm btn-outline-success">
                                        <span class="fas fa-eye"></span>
                                    </button>
                                </li>
                                <li class="list-inline-item">
                                    <button type="button" class="btn btn-sm btn-outline-warning" v-on:click="() => onEdit(page.id)">
                                        <span class="fas fa-edit"></span>
                                    </button>
                                </li>
                                <li class="list-inline-item">
                                    <button type="button" class="btn btn-sm btn-outline-danger" v-on:click="onDelete(page.id)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <modal v-if="showModal" v-on:close="restore(); showModal = false" btn >
            <div  class="card" slot="container">
                <span v-on:click="restore(); showModal = false" class="close "> <i class="far fa-times-circle"></i></span>

                <form  @submit.prevent="store" @keydown="form.onKeydown($event)">
                    <header class="card-header card-header-with-icons">
                        <h1 class="h2 mb-2">Create PAGE</h1>
                    </header>
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                Type
                                            </span>
                                        </div>
                                        <select class="form-control " v-model="form.type" :class="{ 'is-invalid': form.errors.has('type') }">
                                            <option value="GRID" >GRID</option>
                                            <option value="LIST" >LIST</option>
                                            <option value="DETAIL" >DETAIL</option>
                                        </select>
                                        <has-error :form="form" field="type" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            Title
                                        </span>
                                        </div>
                                        <input  class="form-control" type="text" v-model="form.title" :class="{ 'is-invalid': form.errors.has('title') }" placeholder="Title ">
                                        <has-error :form="form" field="title" />
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                Excerpt
                                            </span>
                                        </div>
                                        <textarea class="form-control" v-model="form.excerpt" :class="{ 'is-invalid': form.errors.has('excerpt') }"></textarea>
                                        <has-error :form="form" field="excerpt" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="preview-thumbnail d-flex justify-content-center align-items-center" :class="{ 'is-invalid': form.errors.has('img_read') }" v-bind:style="{ background: `url(${preview_img}) no-repeat scroll center center / cover` }">
                                        <input  type="file"
                                                placeholder="Image"
                                                @change="selectImg"
                                                class="inputfile"
                                                id="img_read" />
                                        <label for="img_read">
                                            <i class="fas fa-upload"></i>
                                        </label>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                Menu
                                            </span>
                                        </div>
                                        <select class="form-control " v-model="form.menus" :class="{ 'is-invalid': form.errors.has('menus') }" multiple>
                                            <template  v-for="menu in menus">
                                                <option :value="menu.id" v-if="menu.children.length === 0">{{ menu.name }}</option>
                                                <optgroup :label="menu.name" v-else>
                                                    <option :value="m.id" v-for="m in menu.children">{{ m.name }}</option>
                                                </optgroup>
                                            </template>
                                        </select>
                                        <has-error :form="form" field="menus" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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
    import Form from "vform";
    import {mapGetters} from "vuex";
    import axios from "axios";
    import TypePage from "~/components/TypePage"
    export default {
        name: "pages",
        data: () => ({
            form: new Form({
                id: null,
                menus: [],
                background: '',
                title: '',
                excerpt: '',
                type: 'GRID',
            }),
            pages: [],
            showModal: false,
            img: require('../../images/banner_thumbnail.jpg'),
            preview_img: require('../../images/banner_thumbnail.jpg'),
            banner: require('../../images/banner.jpg')
        }),
        components:{
            TypePage
        },
        computed: {
            ...mapGetters({
               menus: 'menus/publicMenus'
            }),
        },
        created(){
            this.getPages()
        },
        methods:{
            restore(){
                this.title = '';
                this.form.reset();
                this.preview_img = require('../../images/480x113.png');
            },
            store(){
                let url = `/${config.base}/page-store`;
                if(this.form.id){
                    this.form._method = 'PUT';
                    url = `/${config.base}/page-update/${this.form.id}`
                }
                this.form.submit('post',url, {
                    transformRequest: [(data, headers) => this.gformData(data)]
                }).then(()=>{
                    this.restore();
                    this.pages = [];
                    this.showModal = false;
                    this.getPages()
                })
            },
           async getPages(){
                const { data } = await axios.get(`/${config.base}/page-data`);
                this.pages = data;
                //this.eventsAll = data;
            },
            async onEdit(id){
                const { data } = await  axios.get(`/${config.base}/page-data/${id}/edit`);
                await this.form.fill(data);
                this.form.menus = data.menus.map(d => d.id);
                this.preview_img = data.background;
                this.showModal = true;
            },
            onDelete(id){
                this.$delete(id, async ()=>{
                    await axios.delete(`/${config.base}/page-delete/${id}`);
                    this.pages = this.pages.filter(data => data.id !== id);
                });
            },
            selectImg(e){
                const files = e.target.files;
                const fileReader = new FileReader();
                fileReader.addEventListener('load', () => {
                    this.preview_img = fileReader.result
                });
                fileReader.readAsDataURL(files[0]);
                this.form.background = files[0];
            }
        }
    }
</script>

<style scoped lang="scss">
.overlay-page{
    position: relative;
    .caption {
        position: absolute;
        background-color: rgba(0, 7, 28, 0.7);
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }
}
</style>
