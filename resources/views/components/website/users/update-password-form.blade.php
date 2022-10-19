<form method="post" action="{{url_locale('users/change-password')}}">
    @csrf
    <div class="flex flex-wrap  gy-3">
        <div class="w-full">

            <label for="password">{{ trans('website.current_password') }}</label>
            <input type="password"
                   autocomplete="new-password"
                   class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="current_password"
                   placeholder="{{ trans('website.current_password') }}"
            >
            <x-website.ui.form-error-label field="current_password"/>
        </div>
        <div class="w-full">
            <label for="password">{{ trans('website.password') }}</label>
            <input type="password"
                   autocomplete="new-password"
                   class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="password"
                   placeholder="{{ trans('website.password') }}"
            >
            <x-website.ui.form-error-label field="password"/>
        </div>
        <div class="w-full">
            <label for="password_confirmation">{{ trans('message.password_confirm') }}</label>
            <input type="password" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="password_confirmation"
                   placeholder="{{ trans('message.password_confirm') }}">
            <x-website.ui.form-error-label field="password_confirmation"/>
        </div>

        <div class="w-full">
            <div class="mt-2 flex justify-end">
                <x-website.users.action-button>
                    {{ trans('website.save') }}
                </x-website.users.action-button>
            </div>
        </div>
    </div>
</form>
