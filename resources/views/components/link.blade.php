@php
/* Here we put all the classes */
    $classes = "text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
@endphp

{{-- With merge(), we send the classes and the href attributes --}}
<a {{ $attributes->merge(['class' => $classes]) }}>
    {{-- Content --}}
    {{ $slot }}
</a>