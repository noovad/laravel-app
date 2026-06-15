@props([
    'buttonText' => 'Open',
])

<div x-data="{ open: false }">
    <button @click="open = true" {{ $attributes }}>
        {{ $buttonText }}
    </button>

    <div x-show="open" x-transition.opacity class="modal">
        <div @click.outside="open = false" x-transition.scale.duration.200ms
            class="w-full max-w-lg rounded-xl bg-white dark:bg-zinc-900 shadow-2xl border border-zinc-200 dark:border-zinc-700">
            <div class="p-6">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
