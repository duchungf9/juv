@if (session('success'))
    <div class="text-end text-green-500">
        <p>{!! session('success') !!}</p>
    </div>
@endif

