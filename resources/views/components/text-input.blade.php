@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'text-gray-200 border-2 border-curious-blue-600 focus:border-curious-blue-600 focus:ring-curious-blue-600 rounded-md shadow-xs']) !!}>
