<div {!! $attributes->merge(['class' =>"form-check"])!!}>
    <input type="checkbox" class="absolute mt-1 -ml-6" {{$attributes}}
           name="{{$for}}"  id="{{$for}}" >
    <label class="text-gray-700 pl-6 mb-0" for="{{$for}}">
        {{$slot}}
    </label>
    <x-website.ui.input-error-label class="pt-1" for="{{$for}}"></x-website.ui.input-error-label>
</div>