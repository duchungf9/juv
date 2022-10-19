<template>
  <div class="d-flex gap-2 justify-items-center product-combinations-list">
    <div

        v-for="item in items"
        :key="`color_${item.id}`"
        class="product-combinations-list-item"
        @click="setItem(item)"
        :class="{active:is_selected(item),'unavailable': is_available(item)}"
    >
      {{ item.label }}
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
    },
    variants:{
      type:Array,
    }
  },
  methods: {
    is_selected(item) {
      return (this.selectedCombination)?(this.selectedCombination[this.index]==item.id):null
    },
    is_available(item){
      if(!this.selectedCombination ) return false;


      if(this.selectedCombination[this.index]==item.id){
         let a =this.variants.find((element) => element.combination.every(ai => this.selectedCombination.includes(ai)));
         if(_.isUndefined(a)) return true
      }


      let result = this.variants.find((element) => element.combination[this.index]===item.id);
      if(_.isUndefined(result)){
        return true
      }

      return false;
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
