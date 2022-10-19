@extends('website.app')
@section('content')

    <main class="my-5">
        <div class="container mx-auto sm:px-4">
            @include('website.partials.pagetitle')

            <div class="w-full mb0 text-center">{!! $page->description !!}</div>
        </div>
    </main>

@endsection
