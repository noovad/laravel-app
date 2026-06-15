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
            @error('slug')
                <div class="text-red-500 text-sm">
                    {{ $message }}
                </div>
            @enderror

        </div>
        <div>
            <label>Description</label>
            <textarea wire:model="description" class="w-full border rounded p-2"></textarea>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label>Price</label>
                <input type="number" min="0" wire:model="price" class="w-full border rounded p-2" />
            </div>
            <div>
                <label>Stock</label>
                <input type="number" min="0" wire:model="stock" class="w-full border rounded p-2" />
            </div>
        </div>
        <div>
            @if ($image || $currentImage)
                <img src="{{ $image ? $image->temporaryUrl() : Storage::url($currentImage) }}"
                    class="w-32 h-32 object-cover">
            @endif
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
