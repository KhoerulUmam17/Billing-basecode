<div class="min-h-screen flex flex-col justify-center items-center py-8 bg-gray-100">
    <div class="flex flex-col items-center w-full">
        {{ $logo }}
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</div>
