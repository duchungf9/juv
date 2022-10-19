
<template>
  <div class="d-flex gap-2 justify-items-center product-combinations-list">
    <div
      v-for="item in items"
      :key="`color_${item.id}`"
      class="product-combinations-list-item"
      :class="{active:is_selected(item)}"
      @click="setItem(item)"
    >
      <div
        class="product-combinations-list-color"
        :style="'background-color:' + item.color"
      ></div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    items: {
      type: Object,
    },
    index: {
      type: Number,
    },
    selectedCombination:{
      type: Array,
    }
  },
  methods: {
    is_selected(item) {
      return (this.selectedCombination)?(this.selectedCombination[this.index]==item.id):null
    },
    setItem(item){
      cartBus.emit('SET_VARIANT_ATTRIBUTE', {item:item,index:this.index});
    }
  },
  setup() {
    return {};
  },
};
</script>
