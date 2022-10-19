<div {!! $attributes->merge(['class' =>""])!!}>
    <x-website.ui.checkbox for="privacy" required  value="1">
         <label class="custom-control-label" for="newsletter-privacy">
            <a href="{{page_permalink_by_id(3)}}"  class=" " title="{{ trans('website.privacy')}}">
                {{trans('website.message.privacy')}}
            </a>
        </label>
    </x-website.ui.checkbox>
</div>
