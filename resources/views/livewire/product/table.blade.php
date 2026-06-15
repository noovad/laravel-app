<div>
    <div class="overflow-auto">
        <table id="product-table" class="border table-auto">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th>Name
                        <x-toggle-sorting :active="$sortField === 'name'" :direction="$sortDirection" wire:click="sort('name')" />
                    </th>
                    <th>Slug
                        <x-toggle-sorting :active="$sortField === 'slug'" :direction="$sortDirection" wire:click="sort('slug')" />
                    </th>
                    <th>Price
                        <x-toggle-sorting :active="$sortField === 'price'" :direction="$sortDirection" wire:click="sort('price')" />
                    </th>
                    <th>Stock
                        <x-toggle-sorting :active="$sortField === 'stock'" :direction="$sortDirection" wire:click="sort('stock')" />
                    </th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
                <tr>
                    <th></th>
                    <th><input class="search" placeholder="Search" wire:model.live.debounce.150ms="filters.name" /></th>
                    <th><input class="search" placeholder="Search" wire:model.live.debounce.150ms="filters.slug" /></th>
                    <th><input type="number" class="search" placeholder="Search"
                            wire:model.live.debounce.150ms="filters.price" />
                    </th>
                    <th><input type="number" class="search" placeholder="Search"
                            wire:model.live.debounce.150ms="filters.stock" />
                    </th>
                    <th><input class="search" placeholder="Search" wire:model.live.debounce.150ms="filters.status" />
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td class="text-center">{{ $products->firstItem() + $loop->index }}</td>
                        {{-- <td>
                        @if ($product->image)
                            <img src="{{ Storage::url($product->image) }}" class="w-16 h-16 object-cover">
                        @else
                            <p>no image</p>
                        @endif
                    </td> --}}
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->slug }}</td>
                        <td>{{ number_format($product->price) }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            @if ($product->is_active)
                                Active
                            @else
                                Inactive
                            @endif
                        </td>
                        <td class="flex gap-2">
                            <button wire:click="edit({{ $product->id }})"
                                class="px-2 py-1 border rounded">Edit</button>
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
    <div class="mt-4">
        {{ $products->links(data: ['scrollTo' => '#product-table']) }}
    </div>
</div>
