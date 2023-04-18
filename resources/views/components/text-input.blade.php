@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'text-gray-800 border-2 border-violet-600 focus:border-violet-600 focus:ring-violet-600 rounded-md shadow-sm']) !!}>
