<form method="post" action="{{url_locale('register')}}">
    @csrf
    @if (isset($redirectTo))
        <input type="hidden" name="redirectTo" value="{{$redirectTo}}">
    @endif
    <div class="flex flex-wrap  gy-3">
        <div class="w-full md:w-1/2 pr-4 pl-4">
            <x-website.ui.input for="firstname" placeholder="{{ trans('website.firstname') }} *" required/>
        </div>
        <div class="w-full md:w-1/2 pr-4 pl-4">
            <x-website.ui.input placeholder="{{ trans('website.lastname') }} *" for="lastname" required/>
        </div>
        <div class="w-full">
            <x-website.ui.input type="email" placeholder="{{ trans('website.email') }} *" for="email" required/>
        </div>
        <div class="w-full">
            <x-website.ui.input type="password" for="password" placeholder="{{ trans('website.password') }} *"
               required/>
        </div>
        <div class="w-full">
            <x-website.ui.input type="password" type="password" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" for="password_confirmation"
                                placeholder="{{ trans('message.password_confirm') }}" required/>
        </div>
        <div class="w-full">
            <x-ui.alert class="mt-2 alert-color-4" >
                {{trans('website.message.password')}}
            </x-ui.alert>
        </div>
    </div>
    <div class="w-full">
        <x-website.widgets.privacy-message/>
    </div>
    <div class="w-full mt-3 d-grid gap-2 sm:flex sm:justify-end">
        <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-green-500 text-white hover:bg-green-600">
            {{ trans('message.register') }}
        </button>
    </div>
</form>
