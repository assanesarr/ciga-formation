<template>
    <div class="card">
        <header class="card-header card-header-with-icons">
            <h4 class="card-header-title" v-text="formation_filter"></h4>
            <div class="formation-filter-group">
                <select class="form-control form-control-sm" v-model="filte" @change="changeFormation">
                    <option value="all">All</option>
                    <option :value="formation.id" v-for="formation in formations_type" v-text="formation.name"></option>
                </select>
            </div>
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
                <div class="col-lg-3 col-md-4 col-sm-12 single-trainer" v-for="formation in formations">
                    <div class="thumb d-flex justify-content-sm-center">
                        <img class="/img-fluid" :src="formation.thumbnail" alt="" style="width: 100%">
                    </div> <div class="meta-text text-sm-center">
                    <h4 v-text="formation.title"></h4> <p class="designation">Formation en {{ formation.duration}}</p>
                    <div class="align-items-center justify-content-center d-flex">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                                <button type="button" class="btn btn-sm btn-outline-success">
                                    <span class="fas fa-eye"></span>
                                </button>
                            </li>
                            <li class="list-inline-item">
                                <button type="button" class="btn btn-sm btn-outline-warning" v-on:click="onEdit(formation.id)">
                                    <span class="fas fa-edit"></span>
                                </button>
                            </li>
                            <li class="list-inline-item">
                                <button type="button" class="btn btn-sm btn-outline-danger" v-on:click="onDelete(formation.id)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <modal v-if="showModal" v-on:close="restore(); showModal = false" btn :width="70">
            <div  class="card" slot="container">
                <span v-on:click="restore(); showModal = false" class="close "> <i class="far fa-times-circle"></i></span>

                    <form  @submit.prevent="store" @keydown="form.onKeydown($event)">
                        <header class="card-header card-header-with-icons">
                            <h1 class="h2 mb-2">Create FORMATION</h1>
                        </header>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    Title
                                                </span>
                                            </div>
                                            <input  class="form-control" type="text" v-model="title" :class="{ 'is-invalid': form.errors.has('title') }" placeholder="Title ">
                                            <has-error :form="form" field="title" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    Slug
                                                </span>
                                            </div>
                                            <input  class="form-control" type="text" v-model="form.slug" :class="{ 'is-invalid': form.errors.has('slug') }" placeholder="slug" disabled>
                                            <has-error :form="form" field="slug" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    Degree Level
                                                </span>
                                            </div>
                                            <input  class="form-control" type="text" v-model="form.level" :class="{ 'is-invalid': form.errors.has('level') }" placeholder="BAC +3">
                                            <has-error :form="form" field="level" />
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    Duration
                                                </span>
                                            </div>
                                            <input  class="form-control" type="text" v-model="form.duration" :class="{ 'is-invalid': form.errors.has('duration') }" placeholder="3 ans">
                                            <has-error :form="form" field="duration" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    Nombre de Places
                                                </span>
                                            </div>
                                            <input  class="form-control" type="text" v-model="form.seats" :class="{ 'is-invalid': form.errors.has('seats') }" placeholder="Nombre de Places">
                                            <has-error :form="form" field="seats" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    Type
                                                </span>
                                            </div>
                                            <select class="form-control " v-model="form.type" :class="{ 'is-invalid': form.errors.has('type') }">
                                                <option value="" >Formation Type</option>
                                                <option :value="formation.id" v-for="formation in formations_type" v-text="formation.name">Formation Continue</option>
                                            </select>
                                            <has-error :form="form" field="type" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            Price
                                                        </span>
                                                    </div>
                                                    <input  class="form-control" type="text" v-model="form.price" :class="{ 'is-invalid': form.errors.has('price') }" placeholder="50 XOF/mois">
                                                    <has-error :form="form" field="price" />
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group d-flex align-items-center">
                                                <div class="p-2 mr-2">
                                                    <span class="mr-2">Mis en top</span>
                                                    <vb-switch type="success" v-model="form.top" />
                                                </div>
                                                <div class="p-2 ">
                                                    <span class="mr-2">Status</span>
                                                    <vb-switch type="success" v-model="form.status" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="preview-thumbnail d-flex justify-content-center align-items-center" :class="{ 'is-invalid': form.errors.has('img_read') }" v-bind:style="{ background: `url(${preview_read}) no-repeat scroll center center / cover` }">
                                            <input  type="file"
                                                    placeholder="Image"
                                                    @change="selectRead"
                                                    class="inputfile"
                                                    id="img_read" />
                                            <label for="img_read">
                                                <i class="fas fa-upload"></i>
                                            </label>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="preview-thumbnail d-flex justify-content-center align-items-center" :class="{ 'is-invalid': form.errors.has('thumbnail') }" v-bind:style="{ background: `url(${preview_thum}) no-repeat scroll center center / cover` }">
                                            <input  type="file"
                                                    placeholder=" Image"
                                                    @change="selectThum"
                                                    class="inputfile"
                                                    id="file" />
                                            <label for="file">
                                                <i class="fas fa-upload"></i>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <div class="preview-thumbnail d-flex justify-content-center align-items-center" :class="{ 'is-invalid': form.errors.has('img_view') }" v-bind:style="{ background: `url(${preview_img}) no-repeat scroll center center / cover` }">
                                            <input  type="file"
                                                    placeholder="Image"
                                                    @change="selectImg"
                                                    class="inputfile"
                                                    id="img-form"
                                            />
                                            <label for="img-form">
                                                <i class="fas fa-upload"></i>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <ckeditor  height="200" :editor="editor" v-model="form.body" :config="editorConfig"></ckeditor>
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
    //730x340  251x157 276x352
    import Form from 'vform'
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    import TimePicker from 'vue-bootstrap-time-picker';
    import  axios from "axios";
    export default {
        name: "formations",
        data: () => ({
            showModal: false,
            filte: 'all',
            title: '',
            formation_filter: 'FORMATIONS',
            formations: [],
            formationsAll: [],
            form: new Form({
                id: null,
                type: '',
                title: '',
                slug: '',
                level: '',
                body: '<p>Content of the editor.</p>',
                duration: '',
                schedule: '',
                seats: 50,
                img_read: '',
                thumbnail: '',
                img_view: '',
                price: '',
                status: true,
                top: false,
            }),
            editor: ClassicEditor,
            editorConfig: {},
            start: '',
            end: '',
            preview_thum: require('../../images/251x157.png'),
            preview_img: require('../../images/730x340.png'),
            preview_read: require('../../images/276x352.png'),
            formations_type: []
        }),
        components: {
            TimePicker
        },
        watch: {
            title (val) {
                this.form.title = val;
                this.form.slug = this.slugify(val)
            },
        },
        created(){
            this.getformationType();
            this.getformations()
        },
        methods: {
            restore(){
                this.title = '';
               this.form.reset();
                this.preview_thum=  require('../../images/251x157.png');
                this.preview_img = require('../../images/730x340.png');
                this.preview_read = require('../../images/276x352.png');

            },
            selectThum(e) {
                const files = e.target.files;
                //let filename = files[0].name;
                const fileReader = new FileReader();
                fileReader.addEventListener('load', () => {
                    this.preview_thum = fileReader.result
                });
                fileReader.readAsDataURL(files[0]);
                this.form.thumbnail = files[0]
            },
            selectImg(e) {
                const files = e.target.files;
                //let filename = files[0].name;
                const fileReader = new FileReader();
                fileReader.addEventListener('load', () => {
                    this.preview_img = fileReader.result
                });
                fileReader.readAsDataURL(files[0]);
                this.form.img_view = files[0];
            },
            selectRead(e) {
                const files = e.target.files;
                //let filename = files[0].name;
                const fileReader = new FileReader();
                fileReader.addEventListener('load', () => {
                    this.preview_read = fileReader.result
                });
                fileReader.readAsDataURL(files[0]);
                this.form.img_read = files[0];
            },
          async getformationType(){
              const { data } = await axios.get(`/${config.base}/formation-type`);
              this.formations_type = data.children;
            },
          async getformations(){
                const { data } = await axios.get(`/${config.base}/formation-data`);
                this.formations = data;
                this.formationsAll = data;
            },
            store(){
                let url = `/${config.base}/formation-data`;
                if(this.form.id){
                    this.form._method = 'PUT';
                    url = `/${config.base}/formation-data/${this.form.id}`
                }
                this.form.submit('post',url, {
                    transformRequest: [(data, headers) => this.gformData(data)]
                }).then(()=>{
                    this.restore();
                    this.showModal = false;
                    this.getformations()
                    //this.$Progress.finish();
                })
            },
            changeFormation(){
                if(this.filte === 'all'){
                    this.formations = this.formationsAll
                }else{
                    const type = this.formations_type.filter(data => data.id === this.filte);
                    this.formation_filter = type[0].name;
                    this.formations = this.formationsAll.filter(data => data.type === this.filte)
                }
            },
           async onEdit(id){
               const { data } = await  axios.get(`/${config.base}/formation-data/${id}/edit`);
               data.status = !!data.status;
               data.top = !!data.top;
               this.title = data.title;
               await this.form.fill(data);
               this.preview_thum=  data.thumbnail;
               this.preview_img = data.img_view;
               this.preview_read = data.img_read;
               this.showModal = true;
            },
            onDelete(id){
                this.$delete(id, async ()=>{
                   await axios.delete(`/${config.base}/formation-data/${id}`)
                });
            }
        },
    }
</script>

<style lang="scss">
    .preview-thumbnail{
        width: 100%;
        height: 157px;
        background: no-repeat center;
        background-size: cover;
        &.is-invalid{
            border: 1px solid #e74a3b;
        }
    }
    .formation-filter-group{
        width: 50%;
    }
    .single-trainer {
        margin-bottom: 30px;
        .thumb {
            position: relative;
        }
        .meta-text {
            padding: 20px 25px;
            box-shadow: 0 0 30px rgba(153, 153, 153, 0.13);
            -webkit-transition: all 0.3s ease 0s;
            -moz-transition: all 0.3s ease 0s;
            -o-transition: all 0.3s ease 0s;
            transition: all 0.3s ease 0s;
            @media (max-width: 991px) {
                padding: 20px 20px;
            }
            background: #ffffff;
            h4 {
                font-size: 20px;
                margin-bottom: 0px;
            }
            .designation {
                font-size: 14px;
                margin-bottom: 30px;
            }
            a {
                font-size: 14px;
                margin: 0 10px;
                color: #cccccc;
                -webkit-transition: all 0.3s ease 0s;
                -moz-transition: all 0.3s ease 0s;
                -o-transition: all 0.3s ease 0s;
                transition: all 0.3s ease 0s;
                &:hover {
                    color: #62B0FF;
                }
            }
        }
        &:hover {
            .meta-text {
                box-shadow: 0px 10px 30px rgba(#002347, 0.15);
            }
        }
    }
</style>
