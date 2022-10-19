<template>
  <h5>{{ item.label }}: {{ attribute }}</h5>
</template>

<script>
export default {
  props: {
    item: {
      type: Object,
    },
    attribute: {
      type: String,
    },
  },
};
</script>
