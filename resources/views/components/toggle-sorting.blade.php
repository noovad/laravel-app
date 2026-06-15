@props([
    'active' => false,
    'direction' => null,
    'field' => '',
])

<button {{ $attributes }}>
    {{ $field }}
    @if (!$active)
        ⇅
    @elseif ($direction === 'asc')
        ↑
    @else
        ↓
    @endif
</button>
