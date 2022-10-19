<h1 class="mb-0">
    @if ($page!='')
        @if ($page->title!='')
            {{trans('admin.label.edit')}} <strong>{{ $page->title }}</strong>
        @elseif( $page->name!='')
            {{trans('admin.label.edit')}} <strong>{{ $page->name }}</strong>
        @endif
    @else
        {{(\Lang::has('admin.models.' . $model)) ? trans('admin.models.' . $model) : ucwords($model)}}
    @endif
 </h1>

