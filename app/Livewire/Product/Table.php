<?php

namespace App\Livewire\Product;

use App\Models\Product;
use App\Services\ProductService;
use Livewire\Attributes\On;
use Livewire\Component;

class Table extends Component
{
    public function edit(Product $product): void
    {
        $this->authorize('update', $product);
        $this->dispatch('product-edit', productId: $product->id);
    }

    public function destroy(Product $product, ProductService $service): void
    {
        $this->authorize('delete', $product);
        $service->delete($product);
    }

    #[On('product-save')]
    public function refreshTable(): void {}

    public function render()
    {
        return view('livewire.product.table', [
            'products' => Product::query()
                ->latest()
                ->get(),
        ]);
    }
}
