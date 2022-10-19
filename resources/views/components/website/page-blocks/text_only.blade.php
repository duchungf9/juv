@props([
'type'=>'blocks',
'button_color'=>'btn-outline-color-4',
])
<div class=" flex flex-wrap  blocks-item">
    <div class="lg:w-full pr-4 pl-4 {{$type}}-content">
        <x-website.page-blocks.content :block="$block" :buttonColor="$button_color" />
    </div>
</div>