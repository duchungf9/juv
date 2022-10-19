<template>
  <div class="mb-3">
    <div v-if="isUnselected">Out of stock </div>
    <div
      v-for="(group, index) in items.groups"
      :key="`${group.id}_group`"
      class="product-combinations"
    >
      <combination-group-header
        :item="group"
        :attribute="getCurrentAttribute(group, index)"
      >
      </combination-group-header>
      <component
        :is="group.type + '-component'"
        :items="group.attributes"
        :index="index"
        :variants="items.variants"
        :selectedCombination="selectedCombination"
      />
    </div>
  </div>
</template>

<script>
import ColorComponent from "./partial/CombinationColorComponet.vue";
import TextComponent from "./partial/CombinationTextComponent.vue";
import CombinationGroupHeader from "./partial/CombinationGroup.vue";

export default {
  components: { ColorComponent, TextComponent, CombinationGroupHeader },
  props: {
    combinations: {
      type: Object,
    },
  },
  data() {
    return {
      selectedItem: [],
      currentItem: {},
      isUnselected:false,
      items: {
        groups: [
          {
            label: "Color",
            type: "color",
            id: 1,
            attributes: [
              { label: "red", id: 1, color: "#ff0000", active: 1 },
              { label: "green", id: 2, color: "#08a643", active: 0 },
              { label: "blue", id: 3, color: "#0018ff", active: 0 },
            ],
          },
          {
            label: "Size",
            type: "text",
            id: 2,
            attributes: [
              { label: "S", id: 4, active: 1 },
              { label: "M", id: 5, active: 0 },
              { label: "L", id: 6, active: 0 },
              { label: "XL", id: 7, active: 0 },
              { label: "XXL", id: 8, active: 0 },
            ],
          },
        ],
        variants: [
          { id: 1, code: "123", combination: [1, 4], available: 1 },
          { id: 2, code: "124", combination: [2, 4], available: 0 },
          { id: 3, code: "125", combination: [3, 4], available: 0 },
          { id: 4, code: "126", combination: [1, 5], available: 1 },
          { id: 5, code: "127", combination: [2, 5], available: 1 },
          { id: 7, code: "128", combination: [3, 5], available: 1 },
          { id: 8, code: "129", combination: [1, 6], available: 0 },
          { id: 9, code: "130", combination: [2, 6], available: 1 },
          { id: 10, code: "132", combination: [3, 6], available: 1 },
          { id: 10, code: "133", combination: [3, 8], available: 1 },
        ],
      }
    };
  },
  methods: {
    setCombination(item, index) {
      this.selectedItem[index] = item.id;
      this.setCurrentItem();
    },
    setCurrentItem() {
      this.currentItem= this.items.variants.find((element) => element.combination.every(ai => this.selectedItem.includes(ai)));
      this.isUnselected=_.isUndefined(this.currentItem)

    },
    initCombination(combination) {
      this.selectedCombination[0]=combination[0];
      alert(this.items.groups[1].label)
    },
    getCurrentAttribute(group, index) {
      if (_.isEmpty(this.selectedItem)) {
        return "";
      }
      let attribute = group.attributes.find(
        (element) => element.id === this.selectedItem[index]
      );
      return attribute ? attribute.label : "";
    },
  },
  computed: {
    selectedCombination() {
      return this.selectedItem;
    },
  },
  setup() {
    return {};
  },
  mounted() {
    this.$nextTick(function () {
      // set first  combination available
      let result = this.items.variants.find(
        (element) => element.available === 1
      );
      this.currentItem = result;
      this.initCombination(result.combination);
    });
    cartBus.on("SET_VARIANT_ATTRIBUTE", ({ item, index }) => {
      this.setCombination(item, index);
    });
  },
};
</script>
