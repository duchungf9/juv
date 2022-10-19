<div class="flex flex-wrap " id="update-profile">
    <x-website.users.section-title>
        <x-slot name="title">{{__('users.profile.salutation')}} {{auth_user()->name}}</x-slot>
        <x-slot name="description">{{__('users.profile.update_message')}}</x-slot>
        <x-slot name="avatar">
            <x-website.users.avatar/>
        </x-slot>
    </x-website.users.section-title>
    <x-website.users.section-content>
        <x-website.users.update-profile-form :user="$user"/>
    </x-website.users.section-content>
</div>

