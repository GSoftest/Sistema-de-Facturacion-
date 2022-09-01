<button {{ $attributes->merge(['type' => 'button', 'class' => '
     w-full block shadow-sm sm:text-sm text-center justify-center

    inline-flex items-center py-2 border border-gray-300 
    rounded-md text-gray-700 shadow-sm 
    hover:text-gray-500 focus:border-indigo-500 focus:ring-indigo-500 
     transition hover:border-indigo-500
    ']) }}>
    {{ $slot }}
</button>