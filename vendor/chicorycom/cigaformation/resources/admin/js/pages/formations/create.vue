<template>
    <div  class="card" >
        <form  @submit.prevent="store" @keydown="form.onKeydown($event)">
            <header class="card-header card-header-with-icons">
                <h4 class="card-header-title">Formations </h4>

                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <button type="button" class="btn btn-sm btn-outline-primary" >
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
                                <input  class="form-control" type="text" v-model="form.slug" :class="{ 'is-invalid': form.errors.has('slug') }" placeholder="slug">
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
                                <input  class="form-control" type="text" v-model="form.duration" placeholder="3 ans">
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
                                <input  class="form-control" type="text" v-model="form.seats" placeholder="Nombre de Places">
                                <has-error :form="form" field="seats" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    Type
                                                </span>
                                </div>
                                <select class="form-control " v-model="form.type">
                                    <option value="CONTINUE">Formation Continue</option>
                                    <option value="INITIALE" >Formation initiale</option>
                                    <option value="MODULAIRE">Formation Modulaire</option>
                                </select>
                                <has-error :form="form" field="type" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <time-picker v-model="start" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="preview-thumbnail d-flex justify-content-center align-items-center" v-bind:style="{ background: `url(${preview_thum}) no-repeat scroll center center / cover` }">
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
                    <div class="col-md-8">
                        <div class="form-group">
                            <div class="preview-thumbnail d-flex justify-content-center align-items-center" v-bind:style="{ background: `url(${preview_img}) no-repeat scroll center center / cover` }">
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
</template>


<script>
    //730x340  251x157
    import Form from 'vform'
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    import objectToFormData from '~/plugins/objectToFormData';
    import TimePicker from 'vue-bootstrap-time-picker';
    export default {
        name: "create-formation",
        data: () => ({
            filte: '',
            title: '',
            form: new Form({
                id: null,
                type: 'CONTINUE',
                title: '',
                slug: '',
                body: '<p>Content of the editor.</p>',
                duration: '',
                schedule: '',
                seats: 50,
                thumbnail: '',
                img: '',
                price: '',
            }),
            editor: ClassicEditor,
            editorConfig: {
                height: 200
            },
            start: '',
            preview_thum: require('../../../images/251x157.png'),
            preview_img: require('../../../images/730x340.png')
        }),
        components: {
            TimePicker
        },
        watch: {

            title (val) {
                this.form.title = val;
                this.form.slug = this.sanitizeTitle(val)
            },
        },
        methods: {
            restore(){
                this.form.reset()
            },
            async selectThum(e) {
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
                this.form.img = files[0];
            },
            store(){
                this.form.submit('post','api/stock-import', {
                    transformRequest: [function (data, headers) {
                        return objectToFormData(data)
                    }]
                }).then(()=>{
                    //this.$Progress.finish();
                }).catch(()=>{

                })
            },
            sanitizeTitle(title) {
                let slug = "";
                // Change to lower case
                let titleLower = title.toLowerCase();
                // Letter "e"
                slug = titleLower.replace(/e|é|è|ẽ|ẻ|ẹ|ê|ế|ề|ễ|ể|ệ/gi, 'e');
                // Letter "a"
                slug = slug.replace(/a|á|à|ã|ả|ạ|ă|ắ|ằ|ẵ|ẳ|ặ|â|ấ|ầ|ẫ|ẩ|ậ/gi, 'a');
                // Letter "o"
                slug = slug.replace(/o|ó|ò|õ|ỏ|ọ|ô|ố|ồ|ỗ|ổ|ộ|ơ|ớ|ờ|ỡ|ở|ợ/gi, 'o');
                // Letter "u"
                slug = slug.replace(/u|ú|ù|ũ|ủ|ụ|ư|ứ|ừ|ữ|ử|ự/gi, 'u');
                // Letter "d"
                slug = slug.replace(/đ/gi, 'd');
                // Trim the last whitespace
                slug = slug.replace(/\s*$/g, '');
                // Change whitespace to "-"
                slug = slug.replace(/\s+/g, '-');

                return slug;
            },
        }
    }
</script>

<style lang="scss">
    .ck-editor__editable_inline {
        height: 300px !important;
    }
    .preview-thumbnail{
        width: 100%;
        height: 157px;
        background: no-repeat center;
        background-size: cover;
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
