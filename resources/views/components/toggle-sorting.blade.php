@props([
    'active' => false,
    'direction' => null,
])

<button {{ $attributes }}>
    @if (!$active)
        ⇅
    @elseif ($direction === 'asc')
        ↑
    @else
        ↓
    @endif
</button>
