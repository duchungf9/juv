{{ Form::open(array('id' => 'form-newsletter', 'class' =>'row gy-2', 'name' => 'form-newsletter', 'action' => '\App\FromSky\Website\Controllers\APIController@subscribeNewsletter')) }}
<div class="d-grid gy-3 mb-0">
    <div class="relative flex items-stretch w-full input-group-sm">
        <input type="email"
           class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded footer-newsletter-input"
           name="email" placeholder="{{ trans('website.newsletters_placeholder') }}"
           required>
           <button id="btn-newsletter-subscribe" type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">
             {{ trans('website.send') }}
          </button>
    </div>
    <x-website.widgets.privacy-message class="pt-2"/>
</div>
{{ Form::close() }}