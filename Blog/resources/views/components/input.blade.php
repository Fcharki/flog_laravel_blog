@props(['disabled' => false, 'name', 'value' => ''])

<input {{ $disabled ? 'disabled' : '' }} name="{{ $name }}" value="{{ $value }}" {!! $attributes->merge(['class' => 'block mt-1 w-full rounded-1']) !!}>
