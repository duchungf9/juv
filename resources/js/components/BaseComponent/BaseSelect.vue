<template>
  <label v-if="label" :for="$attrs.name??''" class="form-label">{{ label }}</label>
  <select
      class="form-select" aria-label="Default select example"
      :value="modelValue"
      v-bind="{
      ...$attrs,
      onChange: ($event) => { $emit('update:modelValue', $event.target.value) }
    }"
  >
    <option value="" v-if="empty_value">{{ empty_value }}</option>
    <option
        v-for="option in options"
        :value="option.id??option"
        :key="option"
        :selected="option === modelValue"
    >{{ option.title??option }}</option>
  </select>
</template>

<script>
export default {
  props: {
    label: {
      type: String,
      default: ''
    },
    empty_value: {
      type: String,
      default: ''
    },
    modelValue: {
      type: [String, Number],
      default: ''
    },
    options: {
      type: Array,
      required: true
    }
  }
}
</script>