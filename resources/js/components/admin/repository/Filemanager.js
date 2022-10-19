import {HTTP} from '../../../mixins/http-common';
import notifier from '../../../mixins/notifier';
export default {
    mixins: [notifier],
    data() {
        return {
            params: {},// parameter for fetch data
            current_item: null,
            searchText: "",
            loading: true,
        }
    },
    methods: {
        /* pull  file manager data */
        fetchData: function () {
            let self = this;
            let url = (this.current_item)
                            ? this.fetchDataUrl() + '/' + this.current_item
                            : this.fetchDataUrl();

            let params = this.parameterBag()

            return HTTP.get(url, {params})
                .then(this.refresh)
                .then(function (response) {
                    self.loading = false;
                })
                .catch(error => {
                    self.isLoading =false;
                    self.notifyError(error)
                })
        },
        fetchDataUrl() {
            return   urlAjaxHandlerCms  + `file-manager/grid`;
        },
        parameterBag(){
            /* clean  parameterBags from empty object property */
            return Object.entries(this.params).reduce((a,[k,v]) => (v == '' ? a : (a[k]=v, a)), {})

        },
        /*  pull  form  for edit media data */
        updateSidebar(id) {
            let self = this;
            this.isLoading = true;
            HTTP.get(urlAjaxHandlerCms + 'file-manager/edit/' + id)
                .then(response => {
                    self.isLoading =false;
                    this.updateData(response);
                })
                .catch(error => {
                    self.isLoading = false;
                    //self.notifyError(error,'error');
                    console.log(error);
                })
        },
        /*
        * Sidebar: update image data
        */
        // Make ajax request to edit media data
        saveMediaData(form){
            let target = form.attr('action')
            let self = this;
            HTTP.post(target ,form.serialize())
                .then(function ({data}) {
                   self.notify(data.msg, 'success');
                })
                .catch(function (error) {
                    this.notifyError('Error')
                })
                .finally(()=> emitterHub.emit('FILE_MANAGER_LOAD_LIST') )
        },

        deleteItem(id){

            let self = this;
            HTTP.get(urlAjaxHandlerCms + 'file-manager/delete/' + id)
                .then(({data}) => {
                    self.isLoading =false;
                    self.notify(data.msg,'success');
                 })
                .catch(error => {
                    self.isLoading = false;
                    self.notifyError(error.response.data.msg,'error');
                    console.log(error.response);
                })
                .finally(()=> self.removeMedia(id))

        },
        removeMedia(id){
            let index = this.items.findIndex(x => x.id == id);
            if(this.selected_item ==id)this.set_selected(null);
            this.items.splice(index,1);
        }

    },
}