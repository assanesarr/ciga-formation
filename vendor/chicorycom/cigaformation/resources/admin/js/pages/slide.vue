<template>
    <div class="row">
        <div class="col-md-6 ">
            <div class="card"  v-if="slides.length > 0 && added">
                <carousel :autoplay="true" :nav="false" :items="1">
                    <img v-for="item in slides" :src="item.src" >
                </carousel>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <header class="card-header card-header-with-icons">
                    <h4 class="card-header-title">Tableau avec images Slide</h4>
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
                <div class="card-body pt-0">
                    <!-- Table with Image -->
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th style="width: 135px;">Action</th>
                            </tr>
                            </thead>

                            <tbody>

                                <tr v-for="carousel in carousels">
                                    <td class="font-weight-semi-bold">
                                        <div class="media align-items-center">
                                            <img class="u-avatar-xs mr-3" :src="carousel.thumbnail" alt="Image description" style="width: 150px; height: 100px">
                                        </div>
                                    </td>
                                    <td class="font-weight-semi-bold" v-text="carousel.title"></td>
                                    <td class="font-weight-semi-bold" >
                                        <vb-switch type="success" v-model="carousel.status ? true : false" @change="change(carousel.id)"/>
                                    </td>
                                    <td>
                                        <button class="btn btn-outline-warning btn-sm" v-on:click="() => onedit(carousel.id)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-outline-danger btn-sm" v-on:click="() => ondelete(carousel.id)">
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
        <modal v-if="showModal" v-on:close="restore(); showModal = false" btn :width="60">
            <div  class="card" slot="container">
                <span v-on:click="restore(); showModal = false" class="close "> <i class="far fa-times-circle"></i></span>
                <div class="container mt-2">
                    <div class="alert alert-info text-center">Image proportion 1024 x 483  </div>
                </div>
                <form @submit.prevent="store" @keydown="form.onKeydown($event)" >
                    <div class="preview d-flex justify-content-center align-items-center" v-if="image" >
                        <img :src="image" alt="" >
                        <div class="form-slide">
                            <div class="container-form d-flex flex-column justify-content-center align-items-center h-100">
                                <div class="form__group field" v-if="submit">
                                    <input
                                        type="text"
                                        class="form__field"
                                        :class="{ 'is-invalid': form.errors.has('title') }"
                                        placeholder="Title Slide"
                                        id='title'
                                        v-model="form.title"
                                        v-if="submit"/>
                                    <label for="title" class="form__label">Title Slide</label>
                                    <has-error :form="form" field="title" />
                                </div>
                                <div class="form-group" v-else>
                                    <input  type="file"
                                            placeholder="Featured Image"
                                            @change="selectFile"
                                            class="inputfile"
                                            id="file" />
                                    <label for="file">
                                        <figure><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg></figure>
                                    </label>
                                </div>
                            </div>
                            <div class="btn-action d-flex " v-if="submit">
                                <button  class="btn btn-default btn-sm"> <i  class="fas fa-save"></i></button>
                                <button v-on:click="restore" class="btn btn-warning btn-sm" v-if="!form.id"> <i  class="fas fa-trash-restore"></i></button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </modal>
    </div>
</template>

<script>
    import carousel from 'vue-owl-carousel'
    import axios  from "axios";
    import Form from "vform/src/Form";

    export default {
        name: "slide-page",
        data: () => ({
            form: new Form({
                id: null,
                img: '',
                title: '',
                status: true
            }),
            carousels: [],
            slides: [],
            showModal: false,
            image: require('../../images/1024x483.png'),
            submit: false,
            added: true,
            value: true,
        }),
        components: { carousel },
        created(){
            this.get()
        },
        methods: {
           async selectFile(e) {
                //this.slide.img = e.target.files[0];
               this.submit = true;
               const files = e.target.files;
               let filename = files[0].name;
               const fileReader = new FileReader();
               fileReader.addEventListener('load', () => {
                   this.image = fileReader.result
               });
               fileReader.readAsDataURL(files[0]);
               this.form.img = files[0]
            },
           async get(){
                const { data } = await axios.get(`/${config.base}/slide-carousel`);
                this.carousels = data;
                this.slides = data.filter(s => s.status === 1)
            },
            store(){
                let url = `/${config.base}/slide-carousel`;
                if(this.form.id){
                    this.form._method = 'PUT';
                    url = `/${config.base}/slide-carousel/${this.form.id}`
                }
                this.form.submit('post',url, {
                    transformRequest: [(data, headers) => this.gformData(data)]
                }).then(()=>{
                    this.slides = [];
                    this.restore();
                    this.get();
                })
            },

            restore(){
                this.image = require('../../images/1024x483.png');
                this.submit = false
                this.form.reset();
                this.showModal = false;
            },
          async change(id){
              const { data } = await axios.put(`/${config.base}/slide-carousel-status/${id}`);
              this.slides = [];
              this.get();
          },
        ondelete(id){
            this.$delete(id, async () => {
                 await axios.delete( `/${config.base}/slide-carousel/${id}`);
                this.slides = [];
                this.get();
            });
        },
            async onedit(id){
                const { data } = await axios.get(`/${config.base}/slide-carousel/${id}/edit`);
                this.form.id = data.id;
                this.form.title = data.title;
                this.image = data.src;
                this.submit = true;
                this.showModal = true;
            }
        }
    }
</script>

<style scoped lang="scss">
    $primary: #11998e;
    $secondary: #38ef7d;
    $white: #fff;
    $gray: #9b9b9b;
    .preview {
        width: 100%;
        height: 100%;
        position: relative;

        img {
            width: 100%;
            height: 100%;
            max-width: 1024px;
            max-height: 483px;
        }
        .form-slide{
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            background: rgba(0,0,0, .7);
        }
    }
    .form__group {
        position: relative;
        padding: 15px 0 0;
        margin-top: 10px;
        width: 50%;
    }

    .form__field {
        font-family: inherit;
        width: 100%;
        border: 0;
        border-bottom: 2px solid $gray;
        outline: 0;
        font-size: 1.3rem;
        color: $white;
        padding: 7px 0;
        background: transparent;
        transition: border-color 0.2s;

        &::placeholder {
            color: transparent;
        }

        &:placeholder-shown ~ .form__label {
            font-size: 1.3rem;
            cursor: text;
            top: 20px;
        }
    }

    .form__label {
        position: absolute;
        top: 0;
        display: block;
        transition: 0.2s;
        font-size: 1rem;
        color: $gray;
    }

    .form__field:focus {
        ~ .form__label {
            position: absolute;
            top: 0;
            display: block;
            transition: 0.2s;
            font-size: 1rem;
            color: $primary;
            font-weight:700;
        }
        padding-bottom: 6px;
        font-weight: 700;
        border-width: 3px;
        border-image: linear-gradient(to right, $primary,$secondary);
        border-image-slice: 1;
    }
    /* reset input */
    .form__field{
        &:required,&:invalid { box-shadow:none; }
    }
    .btn-action {
        position: absolute;
        bottom: 2px;
        right: 2px;
    }

</style>
