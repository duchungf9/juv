<template>

  <div id="sidebar-content" class="col-md-4 col-12" ref="modalEditComponent">
    <loader v-if="isLoading"></loader>
    <div v-else v-html="formContent"></div>
  </div>
</template>
<script>
import Loader from "../../BaseComponent/LoaderComponent";
import fileManagerSupport from "../repository/Filemanager";

export default {
  name: "MediaEditComponent",
  components: {
    Loader
  },
  mixins: [fileManagerSupport],
  data() {
    return {
      isLoading: false,
      formContent : '',
    }
  },
  methods: {

    updateData({data}) {
       this.formContent=data;

    },
  },
  mounted() {
    emitterHub.on('FILE_MANAGER_UPDATE_SIDE_BAR', (id) => {
      if (id === null) {
        this.formContent = '';
      }
      else this.updateSidebar(id)
    });
    let self = this;

    $(document).on('submit', '#filemanager-edit-form', function (e) {
      e.preventDefault();
      let  form = $(this);
      self.saveMediaData(form);

    });
  },
  beforeDestroy() {
    emitterHub.off(['FILE_MANAGER_UPDATE_SIDE_BAR']);
  }
}
</script>

