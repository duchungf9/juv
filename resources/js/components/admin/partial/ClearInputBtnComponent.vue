<template>
    <span class="ms-auto"
          :class="{inputClass}"
          @click="resetInput"
          data-bs-toggle="tooltip"
          data-placement="left" title="Clear">
          <i class="fas fa-eraser"></i>
    </span>
</template>
<script>
    export default {
        props: ['input-class'],
        methods: {
            resetInput(e) {
                this.$emit('reset', e.target.valueAsNumber)
            }
        }
    }
</script>
