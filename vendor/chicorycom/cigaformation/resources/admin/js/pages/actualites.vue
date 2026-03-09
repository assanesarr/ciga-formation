<template>
    <div class="card">
        <div class="row h_blog_item">
            <div class="col-lg-4">
                <div class="h_blog_img slide carousel-fade " id="actuality" data-ride="carousel">
                    <div class="_actuality"> <i class="ti-rss"></i> ACTUALITÉS</div>
                    <div class="carousel-inner shadow p-3" v-if="events.length > 0">
                        <carousel :autoplay="true" :nav="false" :items="1">
                            <div class="single_event position-relative" v-for="event in events">
                                <div class="event_thumb">
                                    <img :src="event.img" alt="" style="width: 555px; height: 400px;" />
                                </div>
                                <div class="event_details">
                                    <div class="d-flex mb-4" v-if="event.type === 'EVENT'">
                                        <div class="date"><span>{{ new Date(event.inDate).getDate() }}</span> {{ new Date(event.inDate).toLocaleString('default', { month: 'long' }) }} </div>

                                        <div class="time-location">
                                            <p v-if="event.start">
                                                <span class="ti-time mr-2"></span> {{ event.start }} - {{ event.end }}
                                            </p>
                                            <p v-if="event.location">
                                                <span class="ti-location-pin mr-2"></span> {{ event.location }}
                                            </p>
                                        </div>
                                    </div>
                                        {{ event.body | truncate(100)}}
                                </div>
                            </div>
                        </carousel>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <header class="card-header card-header-with-icons">
                        <h4 class="card-header-title">ACTUALITÉS</h4>
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
                        <!-- Table with Image -->
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 150px">Image</th>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th style="width: 135px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr v-for="event in events">
                                    <td class="font-weight-semi-bold">
                                        <div class="media align-items-center">
                                            <img class="u-avatar-xs mr-3" :src="event.thumbnail" alt="Image description" style="width: 100px; height: 60px">
                                        </div>
                                    </td>
                                    <td class="font-weight-semi-bold" v-text="event.title"></td>
                                    <td class="font-weight-semi-bold" >
                                        <span class="badge badge-info" v-text="event.type"> </span>
                                    </td>
                                    <td class="font-weight-semi-bold" >
                                        <vb-switch type="success" v-model="event.status ? true : false" @change="change(event.id)"/>
                                    </td>
                                    <td>
                                        <button class="btn btn-outline-warning btn-sm" v-on:click="() => onEdit(event.id)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-outline-danger btn-sm" v-on:click="() => onDelete(event.id)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table with Image -->
                    </div>
                </div>
            </div>
        </div>
        <modal v-if="showModal" v-on:close="restore(); showModal = false" btn :width="70">
            <div  class="card" slot="container">
                <span v-on:click="restore(); showModal = false" class="close "> <i class="far fa-times-circle"></i></span>

                <form  @submit.prevent="store" @keydown="form.onKeydown($event)">
                    <header class="card-header card-header-with-icons">
                        <h1 class="h2 mb-2" v-text="form.type"></h1>
                    </header>
                    <div class="card-body ">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        Type
                                    </span>
                                </div>
                                <select class="form-control " v-model="form.type" :class="{ 'is-invalid': form.errors.has('type') }">
                                    <option value="EVENT" >Event</option>
                                    <option value="INFO" >Info</option>
                                    <option value="DIRECTOR" >Mot Directeur</option>
                                </select>
                                <has-error :form="form" field="type" />
                            </div>
                        </div>
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
                        <div class="row" v-if="form.type === 'EVENT'">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                Start
                                            </span>
                                        </div>
                                        <time-picker v-model="form.start"  :class="{ 'is-invalid': form.errors.has('start') }" />
                                        <has-error :form="form" field="start" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                End
                                            </span>
                                        </div>
                                        <time-picker v-model="form.end"  :class="{ 'is-invalid': form.errors.has('end') }" />
                                        <has-error :form="form" field="end" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                Lieu
                                            </span>
                                        </div>
                                        <input  class="form-control" type="text" v-model="form.location" :class="{ 'is-invalid': form.errors.has('location') }" >
                                        <has-error :form="form" field="seats" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group " >
                                    <div class="preview-thumbnail d-flex justify-content-center align-items-center" style="height: 170px;" :class="{ 'is-invalid': form.errors.has('img') }" v-bind:style="{ background: `url(${preview_img}) no-repeat scroll center center / cover` }">
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
                            <div class="col-md-7 d-flex align-items-center" v-if="form.type === 'EVENT'">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                Date
                                            </span>
                                        </div>
                                        <v-date-picker  v-model="inDate"  :class="{ 'is-invalid': form.errors.has('inDate') }" />

                                        <has-error :form="form" field="seats" />
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
        </modal>
    </div>
</template>

<script>
    import carousel from 'vue-owl-carousel'
    import TimePicker from 'vue-bootstrap-time-picker';
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    import Form from "vform";
    import axios from "axios";
    export default {
        name: "actualites",
        data () {
            return {
                showModal: false,
                events: [],
                eventsAll: [],
                title: '',
                form: new Form({
                    id: null,
                    type: 'INFO',
                    title: '',
                    body: '',
                    start: '',
                    end: '',
                    img: '',
                    inDate: new Date(),
                    location: ''
                }),
                editor: ClassicEditor,
                editorConfig: {},
                preview_img: require('../../images/555x400.png'),
                inDate: '',
            }
        },
        components: {
            carousel,
            TimePicker,
        },
        watch: {
            title (val) {
                this.form.title = val;
                this.form.slug = this.slugify(val)
            },
            inDate(val){
                this.form.inDate = `${val.getFullYear()}-${val.getMonth()+1}-${val.getDate()}`
                console.log(this.form.inDate)
            }
        },
        created(){
            this.getEvents()
        },
        methods: {
            restore(){
                this.title = '';
                this.form.reset();
                this.preview_img = require('../../images/555x400.png');
            },
            selectImg(e) {
                const files = e.target.files;
                const fileReader = new FileReader();
                fileReader.addEventListener('load', () => {
                    this.preview_img = fileReader.result
                });
                fileReader.readAsDataURL(files[0]);
                this.form.img = files[0];
            },
            store(){
                let url = `/${config.base}/event-store`;
                if(this.form.id){
                    this.form._method = 'PUT';
                    url = `/${config.base}/event-update/${this.form.id}`
                }
                this.form.submit('post',url, {
                    transformRequest: [(data, headers) => this.gformData(data)]
                }).then(()=>{
                    this.restore();
                    this.events = [];
                    this.showModal = false;
                    this.getEvents()
                })
            },
            async getEvents(){
                const { data } = await axios.get(`/${config.base}/event-data`);
                this.events = data;
                this.eventsAll = data;
            },
            async onEdit(id){
                const { data } = await  axios.get(`/${config.base}/event-data/${id}/edit`);
                data.status = !!data.status;
                this.title = data.title;
                this.inDate = new Date(data.inDate);
                await this.form.fill(data);
                this.preview_img = data.img;
                this.showModal = true;
            },
            onDelete(id){
                this.$delete(id, async ()=>{
                    await axios.delete(`/${config.base}/event-delete/${id}`);
                    const events = this.events.filter(data => data.id !== id);
                    this.events = [];
                    await setTimeout(() => {
                       this.events = events;
                    }, 100);


                });
            }
        }
    }
</script>

<style scoped lang="scss">
    ._actuality {
        position: absolute;
        top: -28px;
        margin-left: 21px;
        z-index: 99;
        padding: 12px 21px;
        background: blue;
        color: white;
        font-size: 18px;
        font-weight: 500;
    }
    .single_event {
        margin-bottom: 30px;
        .event_thumb {
            overflow: hidden;
            img {
                transition: all 0.3s ease 0s;
            }
        }
        .event_details {
            background: rgba(#002347, 0.5);
            position: absolute;
            top: 0;
            right: 0;
            width: 275px;
            padding: 30px 25px;
            color: #ffffff;
            .date {
                color: #ffffff;
                padding-right: 15px;
                border-right: 2px solid #fff;
                font-family: "Roboto", sans-serif;
                font-size: 14px;
                span {
                    display: block;
                    color: #fff8f9;
                    font-size: 28px;
                    font-weight: 500;
                }
            }
            .time-location {
                padding-left: 15px;
                font-size: 14px;
                p {
                    margin-bottom: 0px;
                    span {
                        color: #ffffff;
                        font-size: 13px;
                        font-weight: 500;
                    }
                }
            }
        }
        &:hover {
            img {
                transform: scale(1.1);
            }
            h4 {
                a {
                    color: #fff8f9;
                }
            }
        }
    }
    .primary-btn {
        display: inline-block;
        background: #fff8f9;
        padding: 0 33px;
        color: #002347;
        font-size: 12px;
        font-weight: 500;
        line-height: 50px;
        border-radius: 5px;
        outline: none !important;
        text-align: center;
        text-transform: uppercase;
        cursor: pointer;
        transition: all 0.3s ease 0s;
    }
    </style>
