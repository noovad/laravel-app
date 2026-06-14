{{-- <x-layouts.app>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        </div>
        <div class="relative h-full flex-1 rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div>
    </div>
</x-layouts.app> --}}
<div class="max-w-6xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">
        Products
    </h1>
    <form wire:submit="save" class="space-y-4 border rounded p-4 mb-8">
        <div>
            <label>Name</label>
            <input type="text" wire:model="name" class="w-full border rounded p-2" />
            @error('name')
                <div class="text-red-500 text-sm">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div>
            <label>Slug</label>
            <input type="text" wire:model="slug" class="w-full border rounded p-2" />
        </div>
        <div>
            <label>Description</label>
            <textarea wire:model="description" class="w-full border rounded p-2"></textarea>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label>Price</label>
                <input type="number" wire:model="price" class="w-full border rounded p-2" />
            </div>
            <div>
                <label>Stock</label>
                <input type="number" wire:model="stock" class="w-full border rounded p-2" />
            </div>
        </div>
        <div>
            <label>Image</label>
            <input type="file" wire:model="image" class="w-full" />
        </div>
        <div>
            <label class="flex gap-2">
                <input type="checkbox" wire:model="is_active" />
                Active
            </label>
        </div>
        <button type="submit" class="px-4 py-2 bg-black text-white rounded">
            {{ $editing ? 'Update' : 'Create' }}
        </button>
    </form>
    <table class="w-full border">
        <thead>
            <tr class="border-b">
                <th class="p-2 text-left">Image</th>
                <th class="p-2 text-left">Name</th>
                <th class="p-2 text-left">Slug</th>
                <th class="p-2 text-left">Price</th>
                <th class="p-2 text-left">Stock</th>
                <th class="p-2 text-left">Status</th>
                <th class="p-2 text-left">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr class="border-b">
                    <td class="p-2">
                        @if ($product->image)
                            <img src="{{ Storage::url($product->image) }}" class="w-16 h-16 object-cover">
                        @endif
                    </td>
                    <td class="p-2">
                        {{ $product->name }}
                    </td>
                    <td class="p-2">
                        {{ $product->slug }}
                    </td>
                    <td class="p-2">
                        {{ number_format($product->price) }}
                    </td>
                    <td class="p-2">
                        {{ $product->stock }}
                    </td>
                    <td class="p-2">
                        @if ($product->is_active)
                            Active
                        @else
                            Inactive
                        @endif
                    </td>
                    <td class="p-2 flex gap-2">
                        <button wire:click="edit({{ $product->id }})" class="px-2 py-1 border rounded">
                            Edit
                        </button>
                        <button wire:click="destroy({{ $product->id }})" wire:confirm="Delete this product?"
                            class="px-2 py-1 border rounded">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
