@if (Session::has('message'))
    <div class="flash alert alert-danger {{ Session::has('message_important') ? 'alert-important':''}} pf25 mb15">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        {!!  session('message') !!}
    </div>
@endif
<h2 class="login-box-title text-primary">1. {{trans('store.order.addresses')}}</h2>
@include('fromsky_store::form.cart_form_address')
