@props(['user', 'size' => 'default'])

@php
    $sizeClasses = [
        'small' => 'w-8 h-8 text-xs',
        'default' => 'w-12 h-12',
    ];
    $class = $sizeClasses[$size] ?? $sizeClasses['default'];
@endphp

<div class="flex-shrink-0">
    <div class="{{ $class }} bg-gray-300 rounded-full flex items-center justify-center text-white font-bold">
        {{ substr($user->name, 0, 1) }}
    </div>
</div>