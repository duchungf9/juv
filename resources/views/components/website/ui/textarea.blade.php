<textarea {!! $attributes->merge(['class' =>"form-control"])!!}
       id="{{$for}}" name="{{$for}}">{{ old($for) }}</textarea>
<x-website.ui.input-error-label for="{{$for}}"/>
