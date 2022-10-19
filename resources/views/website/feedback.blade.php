@extends('website.app')
@section('content')
    <main class="my-5">
        <div class="container mx-auto sm:px-4">
            @include('website.partials.page_banner')
            @include('website.partials.pagetitle')
            @include('flash::notification')
        </div>
    </main>
    
@endsection
