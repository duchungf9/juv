<form method="post" action="{{url_locale('/users/profile')}}">
    @csrf
    <div class="flex flex-wrap  gy-3 ">
        <div class="w-full md:w-1/2 pr-4 pl-4">

                <label for="firstname">{{ trans('website.firstname') }}*</label>
                <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" placeholder="{{ trans('website.firstname') }}" name="firstname"
                       value="{{ $user->firstname }}" srequired>
                <x-website.ui.form-error-label field="firstname"/>

        </div>
        <div class="w-full md:w-1/2 pr-4 pl-4">

                <label for="lastname">{{ trans('website.lastname') }}*</label>
                <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" placeholder="{{ trans('website.lastname') }}" name="lastname"
                       value="{{ $user->lastname }}" srequired>
                <x-website.ui.form-error-label field="lastname"/>

        </div>
        <div class="w-full">

                <label for="email">{{ trans('website.email') }}*</label>
                <input type="email" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" placeholder="{{ trans('website.email') }}" name="email"
                       value="{{ $user->email }}" srequired>
                <x-website.ui.form-error-label field="email"/>


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
