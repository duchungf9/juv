<template>
  <label v-if="label" :for="$attrs.name??''" class="form-label">{{ label }}</label>
  <div class="input-group">
    <span class="input-group-text" v-if="append">
        <i :class="append"></i>
    </span>
    <input
        v-bind="$attrs"
        :value="modelValue"
        :placeholder="$attrs.placeholder??''"
        @input="$emit('update:modelValue', $event.target.value)"
        class="form-control"
    >
    <span class="input-group-text" v-if="prepend">
        <i :class="prepend"></i>
    </span>
  </div>
</template>
<script>
export default {
  inheritAttrs: false,
  props: {
    prepend: {
      type: String,
      default: ''
    },
    append: {
      type: String,
      default: ''
    },
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
