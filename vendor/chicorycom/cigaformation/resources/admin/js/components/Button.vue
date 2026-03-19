<template>
  <button :type="type" :disabled="loading" :class="{
    [`btn-${typeStyle}`]: true,
    'btn-block': block,
    'btn-lg': large,
    'btn-sm': sm,
    'btn-loading': loading
  }" class="btn"
  >
      <h2 v-if="loading"> <span class="spinner-border "  ></span></h2>
      <slot v-else />
  </button>
</template>

<script>
export default {
  name: 'VButton',

  props: {
    typeStyle: {
      type: String,
      default: 'primary'
    },

    type : {
      type: String,
      default: 'submit'
    },

    loading: {
      type: Boolean,
      default: false
    },

    block: {
      type: Boolean,
      default: false
    },

    large: {
      type: Boolean,
      default: false
    },
    sm: {
      type: Boolean,
      default: false
    }
  }
}
</script>
