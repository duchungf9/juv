@extends('admin.master')
@section('content')
    <?php $order = $page;?>
    @include('admin.common.action-bar')
    <main id="edit-main" class="container-fluid">
        <h1>{{__('store.order.number')}}: {{$order->reference}}</h1>
        <div class="row">
            <div class="col-12 col-sm-8">
                <div class="card">

                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="#content_tab" class="nav-link active" data-bs-toggle="tab" role="tab" aria-controls="content" aria-selected="true">
                                {{__('store.order.number')}}: {{$order->reference}} - {{ trans('store.order.date') }}: {{$order->created_at->format('Y-m-d H:i:s')}}
                            </a>

                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="content_tab" role="tabpanel" aria-labelledby="content_tab">
                            <h2>{{__('admin.label.status')}}:
                                <span class="text-primary">{{ $order->status->title }}</span></h2>
                            <table class="" border="0" cellpadding="2" cellspacing="0" width="100%">
                                <tbody>
                                <tr>
                                    <td width="45%">
                                        <x-fromsky_store-address-component
                                                :address="$order->shipping_address"
                                                :label="trans('store.order.shipping')"/>
                                    </td>
                                    <td width="10%"></td>
                                    <td width="45%">
                                        <x-fromsky_store-address-component
                                                :address="$order->billing_address"
                                                :label="trans('store.order.billing')"/>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <x-fromsky_store-order-shipping-component :order="$order"/>
                            <x-fromsky_store-order-payment-component :order="$order"/>
                            <hr class="my-2 border-white"/>
                            <x-fromsky_store-resume-component :order="$order"/>
                        </div>
                    </div>
                </div>
            </div>
            <div id="right-sidebar" class="col-12 col-sm-4">
                @includeFirst(['admin.'.strtolower($pageConfig->get('model')).'.side_bar_action', 'admin.common.side_bar_action'])
            </div>
        </div>
    </main>
    <div id="info" class="hidden"></div>
    @include('admin.helper.modal_media')

    @include('admin.helper.filemanager')

@endsection
