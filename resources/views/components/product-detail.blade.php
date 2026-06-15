@props(['product'])

<div class="space-y-5">
    {{-- Image --}}
    <div class="overflow-hidden rounded-xl border border-zinc-200 dark:border-zinc-700">
        @if ($product->image)
            <img
                src="{{ Storage::url($product->image) }}"
                alt="{{ $product->name }}"
                class="w-full h-56 object-cover hover:scale-105 transition duration-300"
            >
        @else
            <div
                class="h-56 flex items-center justify-center bg-zinc-100 dark:bg-zinc-800 text-zinc-400"
            >
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-16 h-16"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.5"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-8-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        @endif
    </div>

    {{-- Product Info --}}
    <div>
        <div class="flex items-center justify-between gap-3">
            <div>
                <h3 class="text-xl font-semibold text-zinc-900 dark:text-zinc-100">
                    {{ $product->name }}
                </h3>

                <p class="text-sm text-zinc-500">
                    {{ $product->slug }}
                </p>
            </div>

            <span @class([
                'inline-flex items-center rounded-full px-3 py-1 text-xs font-medium',
                'bg-green-100 text-green-700 dark:bg-green-500/20 dark:text-green-400' =>
                    $product->is_active,
                'bg-red-100 text-red-700 dark:bg-red-500/20 dark:text-red-400' => !$product->is_active,
            ])>
                {{ $product->is_active ? 'Active' : 'Inactive' }}
            </span>
        </div>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-2 gap-3">
        <div class="rounded-xl border border-zinc-200 dark:border-zinc-700 p-4">
            <p class="text-xs uppercase tracking-wider text-zinc-500">
                Price
            </p>

            <p class="mt-2 text-2xl font-bold">
                Rp {{ number_format($product->price) }}
            </p>
        </div>

        <div class="rounded-xl border border-zinc-200 dark:border-zinc-700 p-4">
            <p class="text-xs uppercase tracking-wider text-zinc-500">
                Stock
            </p>

            <p class="mt-2 text-2xl font-bold">
                {{ $product->stock }}
            </p>
        </div>
    </div>

    @if ($product->description)
        <div class="rounded-xl border border-zinc-200 dark:border-zinc-700 p-4">
            <h4 class="font-medium mb-2">
                Description
            </h4>

            <p class="text-sm text-zinc-600 dark:text-zinc-400 whitespace-pre-line">
                {{ $product->description }}
            </p>
        </div>
    @endif
</div>