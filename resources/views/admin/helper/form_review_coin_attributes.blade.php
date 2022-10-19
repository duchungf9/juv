@php
	$attributes = isset($review_coin_attributes) ? $review_coin_attributes : null;
	$locale = isset($locale) ? $locale : null;

@endphp
@foreach($attributes as $key => $property)
	@php
			if(isset($page)){
				$value = $page->getAttByKey($property->key, $locale);
				if($value != null) {$value = $value->value;}
			}
	@endphp
	@if ( $property->type =='string'  && $property->pub== 1)
		<div class="form-group">
			<label for="{{ $key }}" class="col-lg-2 control-label">{{ ucwords($property->name) }}</label>
			<div class="col-md-10">
				<input type="text" class="form-control" id="{{ $key }}"  placeholder="{{ ucwords($property->name) }}" name="review_coin_atrributes[{{ $property->key }}{{$locale!=null ? "_".$locale : ""}}]" value="{{$value??""}}">
			</div>
		</div>
	@endif

	@if ( $property->type =='integer'  && $property->pub== 1)

		<div class="form-group">
			<label for="{{ $key }}" class="col-lg-2 control-label">{{ ucwords($property->name) }}</label>
			<div class="col-md-4">
				<input type="text" class="form-control" id="{{ $key }}"  placeholder="{{ ucwords($property->name) }}" name="review_coin_atrributes[{{ $property->key }}{{$locale!=null ? "_".$locale : ""}}]]" value="{{$value??""}}">
			</div>
		</div>

	@endif

	@if ( $property->type =='boolean'  && $property->pub== 1)

		<div class="form-group">
			<label for="{{ $key }}" class="col-lg-2 control-label">{{ ucwords($property->name) }}</label>
			<div class="col-lg-10">
				{!! Form::checkbox($key, 1 , $value ?? "" ) !!}
			</div>
		</div>
	@endif
	@if ( $property->type =='text'  && $property->pub== 1)
		<div class="form-group">
			<label for="{{ $property->key }}{{$locale!=null ? "_".$locale : ""}}]" class="col-lg-2 control-label">{{ ucwords($property->name) }}</label>
			<div class="col-lg-10">
				<textarea class="form-control wysiwyg" rows="3" id="{{ $property->key }}{{$locale!=null ? "_".$locale : ""}}]"  name="review_coin_atrributes[{{ $property->key }}{{$locale!=null ? "_".$locale : ""}}]" >{{$value??""}}</textarea>
			</div>
		</div>
	@endif

	@if ( $property->type =='media'  && $property->pub== 1)
		<div class="form-group">
			<label for="{{ $property->key }}{{$locale!=null ? "_".$locale : ""}}]" class="col-lg-2 control-label">{{ ucwords($property->name) }}
			</label>

			<div class="col-lg-10">

				{!! Form::file($value??null) !!}
			</div>
		</div>
	@endif
	@if ( $property->type =='password'  && $property->pub== 1)
		@include('admin.helper.password')
	@endif
@endforeach

