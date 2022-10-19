<div class="flex flex-wrap " id="update-password">
    <x-website.users.section-title>
        <x-slot name="title">{{__('users.profile.update_password')}}</x-slot>
        <x-slot name="description">{{trans('website.message.password')}}</x-slot>
    </x-website.users.section-title>
    <x-website.users.section-content>
        <x-website.users.update-password-form/>
    </x-website.users.section-content>
</div>
