<template>
  <div class="search-box">
    <BaseInputGroup
        v-model="searchText"
        type="text"
        id="search-text"
        append="fas fa-search"
        name="searchText"
        @input="$emit('update:searchText', $event.target.value)"
        :placeholder="$t('admin.file_manager.filter_message')"
        :aria-label="$t('admin.file_manager.filter_message')"
    />
  </div>
</template>
<script>
import BaseInputGroup from "../../BaseComponent/BaseInputGroup";
import {ref, watch} from "vue";

export default {
  name: "SearchBoxComponent",
  components: {BaseInputGroup},
  setup(props, {emit}) {
    const searchText = ref(null);
    watch(searchText, (newFilter, oldFilter) => {
      emit('update-search', newFilter)
    });
    return {searchText}
  },
}
</script>

