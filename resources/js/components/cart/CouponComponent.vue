<template>

  <!-- Card Discount -->
  <div class="card cart__discount box-shadow p-2">
    <a class="dark-grey-text d-flex justify-content-between" data-bs-toggle="collapse" href="#collapseCoupon"
       aria-expanded="false" aria-controls="collapseCoupon">
      {{ $t('store.order.discount.add') }} ({{ $t('store.cart.optional') }})
      <span><i class="fas fa-chevron-down pt-1"></i></span>
    </a>
    <div class="collapse" id="collapseCoupon">
      <div class="row gy-2 my-2">
        <div class="col-12">
          <div v-if="error" class="text-danger pb-1 cart__discount__error ">
            {{ $t('store.order.discount.invalid') }}
          </div>
          <input type="text" id="coupon" v-model="coupon" class="form-control font-weight-light"
                 :placeholder="$t('store.order.discount.enter')" @focus="error=false">
        </div>
        <div class="col-12">
          <a class="d-flex justify-content-center btn btn-success" @click.prevent="addCoupon">
            {{ $t('store.order.discount.apply') }}
          </a>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
import cartHelper from './repository/store';
import alertBox from '../BaseComponent/AlertComponent';
import numberInput from '../BaseComponent/InputNumberComponent'
import {HTTP} from "../../mixins/http-common";

export default {
  mixins: [cartHelper],
  props: [],
  components: {alertBox, numberInput},
  data() {
    return {
      coupon: null,
      error: null,
      message: null,
      url: "/api/store/validate-coupon"

    }
  },
  created() {
  },
  computed: {},
  methods: {
    addCoupon() {
      this.error = false;
      if (_.isEmpty(this.coupon)) {
        this.error = true;
        return;
      }

      this.validateCoupon()
    },
    deleteCoupon(index, id) {

    },
    compose_url() {
      return this.url + "?code=" + this.coupon
    },
    validateCoupon() {


      return HTTP.get(this.compose_url())
          .then(
              response => {
                if (response.data.status = "OK") location.reload();
              }
          )
          .catch(e => {
            this.error = true;
          })
    },

  }
}
</script>
