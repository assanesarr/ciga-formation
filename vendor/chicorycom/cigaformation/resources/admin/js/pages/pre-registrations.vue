<template>
    <div class="card">
        <header class="card-header card-header-with-icons">
            <h4 class="card-header-title" >
                Pre-Inscriptions
                <small class="text-muted" v-if="form.start && status">
                    <countdown :time="time" >
                        <template slot-scope="props">{{ props.days }} jours, {{ props.hours }} heures, {{ props.minutes }} minutes, {{ props.seconds }} seconds.</template>
                    </countdown>
                </small>
            </h4>
            <ul class="list-inline mb-0">
                <li class="list-inline-item">
                    <button type="button" class="btn btn-sm btn-outline-primary"  v-on:click="showModal = true" >
                        <span class="fas fa-plus"></span> Edit
                    </button>
                </li>
                <li class="list-inline-item">
                    <div  class="btn btn-sm btn-outline-primary">
                        <vb-switch type="success" v-if="form.start" v-model="form.status" @change="change()"/>
                    </div>
                </li>
                <li class="list-inline-item">
                    <button type="button" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-undo-alt"></i>
                    </button>
                </li>
            </ul>
        </header>
        <div class="card-body">

        </div>
        <!-- Crad Body -->
        <modal v-if="showModal" v-on:close="restore(); showModal = false" >
            <div  class="card" slot="container">
                <span v-on:click="restore(); showModal = false" class="close "> <i class="far fa-times-circle"></i></span>
                <form @submit.prevent="save" @keydown="form.onKeydown($event)" class="card">
                    <header class="card-header card-header-with-icons">
                        <h2 class="h4 card-header-title">
                            <i class=" mr-3 fas fa-user text-primary"></i>
                            Create Countdown inscription
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start">Debut d'inscription</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <span class="far fa-calendar"></span>
                                            </span>
                                        </div>
                                        <input v-model="form.start" id="start" :class="{ 'is-invalid': form.errors.has('start') }" class="form-control" type="datetime-local" placeholder="01/10/2020" />
                                        <has-error :form="form" field="start" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="form-group">
                                    <label for="end">fin d'inscription</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar"></i>
                                            </span>
                                        </div>
                                        <input v-model="form.end" id="end" :class="{ 'is-invalid': form.errors.has('end') }" class="form-control" type="datetime-local" placeholder="21/12/2020">
                                        <has-error :form="form" field="end" />
                                    </div>
                                </div>
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
</template>

<script>
    import Form from "vform";
    import  axios from "axios";

    export default {
        name: "pre-registrations",
        data: () => ({
            counting: false,
            showModal: false,
            status: false,
            form: new Form({
                id: 1,
                start: '',
                end: ''
            })
        }),
        created(){
            this.getCountdown()
        },
        computed: {
            time (){
                const now = new Date();
                const newYear = new Date(this.form.end);
                return newYear - now
            }
        },

        methods: {
            restore(){
                this.showModal = false
            },
           async save(){
                this.form.start = this.$dateFormat(new Date(this.form.start),  "yyyy-m-dd HH:mm:ss");
                this.form.end = this.$dateFormat(new Date(this.form.end),  "yyyy-m-dd HH:mm:ss");
                const  response  = await this.form.post(`/${config.base}/countdown-store`);
               if(response.status === 201){
                   const {data} = response;
                   this.form.start = this.$dateFormat(new Date(data.start),  "yyyy-m-dd'T'HH:mm");
                   this.form.end = this.$dateFormat(new Date(data.end),  "yyyy-m-dd'T'HH:mm");
                   this.restore()
               }
            },
           async getCountdown(){
                const { data } = await axios.get(`/${config.base}/countdown-data/${1}`);
                 this.form.status = !!data.status;
                 this.status = this.form.status;
                this.form.start = this.$dateFormat(new Date(data.start),  "yyyy-m-dd'T'HH:mm");
                this.form.end = this.$dateFormat(new Date(data.end),  "yyyy-m-dd'T'HH:mm");

            },
           async change(){
               this.status = this.form.status;
                await this.form.post(`/${config.base}/countdown-status`);
            }
        }
    }
</script>

<style >
    .switch{
        margin: 0;
    }
</style>
