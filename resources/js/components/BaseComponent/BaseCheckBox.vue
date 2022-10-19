<template>
  <div class="form-check">
    <input
      class="form-check-input"
      type="checkbox"
      :checked="modelValue"
      @change="$emit('update:modelValue', $event.target.checked)"
      id="flexCheckDefault"
    />
    <label class="form-check-label" for="flexCheckDefault">
      Default checkbox
    </label>
  </div>
</template>
<script>
export default {
  props: {
    label: {
      type: String,
      default: "",
    },
    modelValue: {
      type: Boolean,
      default: false,
    },
  },
  emits: ["update:modelValue"],
};
</script>
