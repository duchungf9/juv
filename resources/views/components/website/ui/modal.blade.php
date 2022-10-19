@props([
    'heading'=>'',
    'footer'=>'',
])
@if($show())
    <div id="{{$getModalId()}}" class="modal maguttiModal" tabindex="-1">
        <div {!! $attributes->merge(['class' =>"modal-dialog modal-dialog-centered"])!!}>
            <div class="modal-content">
                <div class="modal-wrapper">
                    <div class="modal-header">
                        @if($heading)
                        <h1 {{ $heading->attributes->class(['']) }}>
                            {{ $heading }}
                        </h1>
                        @endif
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    {{$slot}}
                    @if($footer)
                    <div class="modal-footer">
                        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-gray-600 text-white hover:bg-gray-700" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">Save</button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @once
        @push('scripts')
            <script type="text/javascript">
                let myModal = new bootstrap.Modal(document.getElementById('{{$getModalId()}}'))
                myModal.show()
            </script>
        @endpush
    @endonce
@endif
