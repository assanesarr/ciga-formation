<template>
    <transition name="modal">
        <div class="modal-mask" >
            <div class="modal-wrapper">
                <vue-custom-scrollbar class="modal-container col-sm-12 col-md-9 col-lg-8 col-xl-7 p-0"  :settings="settings">
                    <span class="modal-default-button" v-if="btn" v-on:click="$emit('close')"><i class="far fa-times-circle"></i></span>
                    <slot name="container"></slot>
                </vue-custom-scrollbar>
            </div>
        </div>
    </transition>
</template>

<script>
    import vueCustomScrollbar from 'vue-custom-scrollbar'
    import "vue-custom-scrollbar/dist/vueScrollbar.css"
    export default {
        name: "modal",
        props: {
            width: {
                type: Number,
                default: 70,
            },
            btn: {
                type: Boolean,
                default: false
            }
        },
        data() {
            return {
                settings: {
                    suppressScrollY: false,
                    suppressScrollX: false,
                    wheelPropagation: false
                }
            }
        },
        components: {
            vueCustomScrollbar
        },
    }
</script>

<style scoped>
    .modal-mask {
        position: fixed;
        z-index: 100;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
        display: table;
        transition: opacity .4s ease;
        overflow: auto;
    }

    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }

    .modal-container {
        margin: 0 auto;
        min-height: 35px;
        max-height: 99vh;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
        transition: all .2s ease;
        font-family: Helvetica, Arial, sans-serif;

    }

    .modal-default-button {
        position: absolute;
        top: 2px;
        right: 2px;
        padding: 2px;
        cursor: pointer;
        color: white;
    }
    .modal-enter {
        opacity: 0;
    }

    .modal-leave-active {
        opacity: 0;
    }

    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
        -webkit-transform: scale(0.95);
        transform: scale(0.95);
    }

</style>
