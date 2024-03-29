@props(['id' => null, 'maxWidth' => null])

<x-modal-factura :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4">
        <div class="text-lg">
            {{ $title }}
        </div>

        <div class="mt-4">
            {{ $content }}
        </div>
    </div>

    <div class="flex flex-row justify-center px-6 py-4 text-center">
        {{ $footer }}
    </div>
</x-modal-factura>
