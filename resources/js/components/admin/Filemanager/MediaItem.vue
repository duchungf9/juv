<template>
  <div @click.prevent="updateItem(media.id)" class="thumbnail-item">
    <img v-if="media.media_type=='images'"  :src="media.cover_image" :title="media.title" />
    <cover-icon v-else :icon="media.icon" />
    <div class="thumbnail-caption">{{ media.title }}</div>
    <div class="action absolute"><i class="fas fa-trash" @click.prevent.stop="deleteItem(media.id)"></i></div>
  </div>

</template>
<script>
import CoverIcon from './CoverComponent'


export default {
  name: "MediaItem",
  components: {
    CoverIcon,
  },
  props: {
    media: {
      type: Object,
      required: true
    },
    eventName: {
      type: String
    }
  },
  methods: {
    updateItem(id) {
      emitterHub.emit(this.eventName, id);
      emitterHub.emit('FILE_MANAGER_UPDATE_SIDE_BAR', id);
    },

    deleteItem(id) {
      let self = this;
      bootbox.setLocale(window._LANG);
      bootbox.confirm({
        message: this.$t('admin.file_manager.delete_media_message',{ msg: `<b>${this.media.title}</b>`  }),
        title: this.$t('admin.file_manager.delete_media'),
        buttons: {
          confirm: {
            label: this.$t('website.btn_yes'),
            className: 'btn-success '
          },
          cancel: {
            label: this.$t('website.btn_no'),
            className: 'btn-accent '
          }
        },
        callback: function (result) {
          if (result) {
            self.$emit('deleteMedia',id)
          }
        }
      });

    }


  },
}
</script>

<style scoped>

</style>