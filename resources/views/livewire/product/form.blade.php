<div x-data="{ open: false }" x-on:product-edit.window="open = true" x-on:product-save.window="open = false"
    class="text-end space-y-2">
    <button @click="open = !open" class="px-4 py-2 border border-black rounded font-medium">Create</button>
    <div x-show="open" class="modal">
        <form wire:submit="save" @click.outside="open = false"
            class="space-y-4 border rounded p-4 mb-8 bg-white dark:bg-zinc-80 text-start">
            <h4 class="text-xl font-medium text-center">
                {{ $editing ? 'Update' : 'Create' }}
            </h4>
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
            <div class="text-end">
                <button type="submit" class="px-4 py-2 bg-black text-white rounded">
                    <span wire:loading.remove>Save</span>
                    <span wire:loading>Saving...</span>
                </button>
            </div>
        </form>
    </div>
</div>
