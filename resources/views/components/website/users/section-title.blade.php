<div class="w-full md:w-2/5 pr-4 pl-4 update-profile mb-3">
    <h5 class="mb-1 text-blue-600">{{ $title }}</h5>
    <small  class="block mt-1 text-gray-700">{{ $description }}</small>
    @if(isset($avatar))
    {{$avatar}}
    @endif
</div>