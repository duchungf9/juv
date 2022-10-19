<template>
  <i  class="fa-5x" v-bind:class="getIcon" aria-hidden="true"></i>
</template>

<script>
export default {
  name: "CoverComponent",
  data() {
    return {
      'media_icon': ['pdf','zip']
    }
  },
  props: {
    icon:{
      type:String
    }
  },
  computed: {
    getIcon() {
      if(this.icon=='pdf') return `fas fa-file-pdf`
      if(this.icon=='zip') return `fas fa-file-archive`
      return `fas fa-file`;
    }
  },
}
</script>

<style scoped>

</style>