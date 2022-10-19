<template>
  <label v-if="label">{{ label }}</label>
  <input
      v-bind="$attrs"
      :value="modelValue"
      :placeholder="$attrs.placeholder??''"
      @input="$emit('update:modelValue', $event.target.value)"
      class="form-control"
  >
</template>

<script>
export default {
  props: {
    label: {
      type: String,
      default: ''
    },
    modelValue: {
      type: [String, Number],
      default: ''
    }
  },
  emits: ['update:modelValue'],
}
</script>
