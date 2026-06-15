@props(['message', 'action', 'id', 'buttonText'])

<div x-data="{ open: false }" wire:key="delete-dialog-{{ $id }}">
    <button @click="open = true" {{ $attributes }}>
        {{ $buttonText }}
    </button>

    <div x-show="open" x-transition.opacity class="modal">
        <div x-transition.scale.duration.200ms @click.outside="open = false"
            class="w-full max-w-md rounded-xl bg-white dark:bg-zinc-900 shadow-2xl border border-zinc-200 dark:border-zinc-700">
            <div class="p-6">
                <div class="flex items-start gap-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-red-100 dark:bg-red-500/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z" />
                        </svg>
                    </div>

                    <div class="flex-1">
                        <h3 class="text-lg font-semibold">
                            {{ $message }}
                        </h3>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" @click="open = false"
                        class="px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition">
                        Cancel
                    </button>

                    <button type="button" wire:click="{{ $action }}({{ $id }})" @click="open = false"
                        class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 transition shadow-sm">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
