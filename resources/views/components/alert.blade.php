@props(['type' => 'info'])

@php
    $colors = [
        'success' => 'bg-green-50 text-green-800 border-green-200',
        'error' => 'bg-red-50 text-red-800 border-red-200',
        'warning' => 'bg-yellow-50 text-yellow-800 border-yellow-200',
        'info' => 'bg-blue-50 text-blue-800 border-blue-200',
    ];
    $color = $colors[$type] ?? 'bg-gray-50 text-gray-800 border-gray-200';
@endphp

<div {{ $attributes->merge(['class' => 'border-l-4 p-4 ' . $color]) }}>
    {{ $slot }}
</div>
