<button {{ $attributes->merge(['type' => 'button', 'class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 mt-2  border border-blue-500 rounded py-1.5']) }}>
    {{ $slot }}
</button>