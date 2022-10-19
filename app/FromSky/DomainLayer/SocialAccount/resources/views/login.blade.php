<x-fromsky_social-header-component class="col-12 d-flex justify-content-center">
    <div class="display-5 social-login-title">{{$label}}</div>
</x-fromsky_social-header-component>
<x-fromsky_social-items-component class="d-grid gap-3  d-lg-flex justify-content-lg-between">
    <x-fromsky_social-button-component :provider="'facebook'" class="btn-facebook" :redirectTo="data_get($attributes,'redirectTo')">
        <x-slot name="icon">
            <i class="fab fa-facebook"></i>
        </x-slot>
    </x-fromsky_social-button-component>
    <x-fromsky_social-button-component :provider="'google'" class="btn-google" :redirectTo="data_get($attributes,'redirectTo')">
        <x-slot name="icon">
            <i class="fab fa-google"></i>
        </x-slot>
    </x-fromsky_social-button-component>
</x-fromsky_social-items-component>

