<template>
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 row-cols-xxl-5 gx-4
  dashboard-search align-items-center">
     <DashBoardSearch
        v-model:section="form.section"
        v-model:searchText="form.searchText"
   />
   </div>
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 row-cols-xxl-5 gx-4  dashboard-menu bg-light ">
    <dashboard-item v-for="(item, index) in dashBoardItems" :item="item" :key="index"/>
  </div>
</template>

<script>
import DashboardItem from './DashboardButtonComponent'
import DashBoardSearch from './SearchBoxComponent'
import DashboardRepository from "../repository/DashboardRepository";
export default {
  components: {
    DashboardItem,
    DashBoardSearch
  },
   setup() {
    const  { error,loading,dashBoardItems,form } =  DashboardRepository()
    return {form,dashBoardItems}
  },
}
</script>
