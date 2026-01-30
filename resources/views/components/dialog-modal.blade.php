@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4 bg-slate-200 dark:bg-gray-700">
        <div class="text-lg font-medium text-gray-900 dark:text-white">
            {{ $title }}
        </div>

        <div class="mt-4 text-sm text-gray-600 dark:text-white">
            {{ $content }}
        </div>
    </div>

    <div class="justify-end px-6 py-3 bg-gray-100 text-right dark:bg-gray-800">
        {{ $footer }}
    </div>
</x-modal>
