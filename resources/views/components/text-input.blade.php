@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'input-brand border-gray-300 rounded-md shadow-sm']) !!}>