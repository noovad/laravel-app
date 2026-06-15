<div>
    <div class="overflow-auto">
        <table id="product-table" class="w-full">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th>
                        <x-toggle-sorting field="Name" :active="$sortField === 'name'" :direction="$sortDirection" wire:click="sort('name')" />
                    </th>
                    <th>
                        <x-toggle-sorting field="Slug" :active="$sortField === 'slug'" :direction="$sortDirection" wire:click="sort('slug')" />
                    </th>
                    <th>
                        <x-toggle-sorting field="Price" :active="$sortField === 'price'" :direction="$sortDirection"
                            wire:click="sort('price')" />
                    </th>
                    <th>
                        <x-toggle-sorting field="Stock" :active="$sortField === 'stock'" :direction="$sortDirection"
                            wire:click="sort('stock')" />
                    </th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
                <tr>
                    <th></th>
                    <th><input class="search" placeholder="Search" wire:model.live.debounce.150ms="filters.name" /></th>
                    <th><input class="search" placeholder="Search" wire:model.live.debounce.150ms="filters.slug" /></th>
                    <th>
                        <input type="number" class="search" placeholder="Search"
                            wire:model.live.debounce.150ms="filters.price" />
                    </th>
                    <th>
                        <input type="number" class="search" placeholder="Search"
                            wire:model.live.debounce.150ms="filters.stock" />
                    </th>
                    <th>
                        <select wire:model.live="filters.is_active"
                            class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 text-sm
                                    focus:border-black focus:outline-none focus:ring-1 focus:ring-black
                                    dark:border-zinc-700 dark:bg-zinc-900">
                            <option value="">All Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td class="text-center">{{ $products->firstItem() + $loop->index }}</td>
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
                            <x-dialog buttonText="Detail" class="px-2 py-1 border rounded">
                                <x-product-detail :product="$product" />
                            </x-dialog>
                            @can('update', $product)
                                <button wire:click="edit({{ $product->id }})"
                                    class="px-2 py-1 border rounded">Edit</button>
                            @endcan
                            @can('delete', $product)
                                <x-dialog-delete message="Delete Product" action="destroy" :id="$product->id"
                                    buttonText="Delete" class="px-2 py-1 border rounded" />
                            @endcan
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
