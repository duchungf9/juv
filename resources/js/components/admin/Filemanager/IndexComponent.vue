<template>
  <div class="row">
    <div class="tab-images-gallery col-md-8 col-12 px-3">
      <search-box @update-search="updateSearchFilter"></search-box>

      <div class="row filemanager-list d-grid-lg gy-3">
        <loader :is-loading="loading" v-if="loading"></loader>
        <div v-else-if="items.length" class="col-6 col-xl-2 col-lg-3 col-md-3" v-for="item in itemList">
          <media-item
              :class="{active: selected_item == item.id}"
              :media="item"
              :event-name="'FILE_MANAGER_SELECT_ITEM'"
              @delete-media="deleteItem"
              :key="'media_item_'+item.id">
          </media-item>
        </div>
        <alert-component v-else class="text-center d-flex align-items-top">
          <template #content>
            <h3>{{ $t('admin.file_manager.empty') }}</h3>
          </template>
        </alert-component>

      </div>

    </div>
    <media-edit/>
  </div>
</template>

<script>

import helper from '../../../mixins/helper';
import fileManagerSupport  from '../repository/Filemanager'
import MediaItem from './MediaItem'
import SearchBox from './SearchBoxComponent'
import MediaEdit from "./MediaEditComponent";
import Loader from "../../BaseComponent/LoaderComponent";
import AlertComponent from "../../BaseComponent/AlertComponent";

export default {
  name: "file-manager-grid",
  components: {
    MediaItem,
    MediaEdit,
    SearchBox,
    Loader,AlertComponent
  },
  mixins: [helper,fileManagerSupport],
  data() {
    return {
      items: [],
      selected_item: null,
      current_item: null,
      searchText: "",
      loading: true,
      collection: ""
    }
  },
  methods: {

    refresh({data}) {
      this.items = data.data
    },
    set_selected(id) {
      this.selected_item = id;
      this.$root.$refs.fileInputValue.value = id;
      if (this.selected_item == null) {
        emitterHub.emit('FILE_MANAGER_UPDATE_SIDE_BAR', null);
      }
    },
    updateSearchFilter(value) {
      this.searchText = value;
    },

  },
  computed: {
    itemList() {
      return this.items.filter(item => {
            return (
                item.title.toLowerCase().includes(this.searchText.toLowerCase())
                ||
                item.media_type.toLowerCase().includes(this.searchText.toLowerCase())
                ||
                item.file_ext.toLowerCase().includes(this.searchText.toLowerCase())
                ||
                item.category.toLowerCase().includes(this.searchText.toLowerCase())
            )
          }
      )
    }
  },
  mounted() {
    emitterHub.on('FILE_MANAGER_INIT', (current_item, params) => {
      this.params = {...params};
      this.current_item = current_item;
      this.set_selected(current_item);
      this.searchText ="";
    });
    emitterHub.on('FILE_MANAGER_LOAD_LIST', () => {
      this.fetchData();
    });
    emitterHub.on('FILE_MANAGER_SELECT_ITEM', (id) => {
      this.set_selected(id);
    });
    emitterHub.on('FILE_MANAGER_RESET', () => {
      this.set_selected(null);
    });

  },

}
</script>
