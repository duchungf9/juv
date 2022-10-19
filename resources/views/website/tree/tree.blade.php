<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
<div class="flex-center position-ref full-height">

    {{--



<select name="" id="" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
    @foreach ($tree as $category)
        <option value="{{$category->id}}">|{{str_repeat('__',$category->level)}} {{ $category->slug }}</option>
    @endforeach
</select>


--}}





    <ul>
        {{-- $pages->where('parent_id', null) filter using where collection --}}
        @foreach ($pages->where('parent_id', null) as $page)
            <li>{!! $page->title !!}</li>
            <ul>
                @foreach ($pages->where('parent_id', $page->id) as $child)
                    @include('website/tree/small_tree', ['child_page' => $child])
                @endforeach
            </ul>
        @endforeach
    </ul>


</div>
</body>
</html>
