<template>
  <div class="col">
     <div class="card dashboard-card  h-100" :class="item.section">
       <div class="card-body dashboard-card-body " >
         <div class="dashboard-card-body-content">
           <a class="button" :href="item.url" :target="item.target ? item.target : null">
             <i :class="item.iconClass+' fa-fw fa-5x '"></i>
             <h3>{{item.title}}</h3>

           </a>
         </div>
       </div>
       <div class="card-footer dashboard-card-footer d-flex justify-content-between">
         <div class="dashboard-card-footer-counter">
           <span class="badge rounded-pill bg-info" :class="item.section">{{ item.pills }}</span>
         </div>
         <small class="text-capitalize"> {{item.section}}</small>
         <div v-if="item.footer_url!==''" class="dashboard-card-footer-action">
           <a :href="item.footer_url" :target="item.target ? item.target : null">
           <i :class="item.footer_icon ? item.footer_icon:'fas fa-plus-circle'+' fa-lg'"></i>
         </a>
         </div>
         <div v-else-if="item.total!==''" class="dashboard-card-footer-action">
             <span class="badge rounded-pill bg-info " :class="item.section">{{ item.total }}</span>
         </div>
       </div>
     </div>
    </div>
</template>

<script>
import formatCurrencyApi from "../../composable/use-currency-formatter-api";
    export default {
        props: ['item'],
        data() {
            return {
                show: false,
                activeClass: 'btn-success'
            }
        },
        setup(){
          const { formatCurrency } = formatCurrencyApi();
          return {
            formatCurrency
          }
        }


    }
</script>
