<div {{ $attributes->merge(['class' => 'bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4']) }}>
    @isset($logo)
        <div class="flex justify-center mb-4">
            {{ $logo }}
        </div>
    @endisset

    {{ $slot }}
</div>
