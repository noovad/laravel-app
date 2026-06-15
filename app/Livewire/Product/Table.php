<?php

namespace App\Livewire\Product;

use App\Models\Product;
use App\Services\ProductService;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public array $filters = [];
    public ?string $sortField = null;
    public ?string $sortDirection = null;

    public function updatedFilters(): void
    {
        $this->resetPage();
    }

    public function sort(string $field): void
    {
        if ($this->sortField !== $field) {
            $this->sortField = $field;
            $this->sortDirection = 'asc';

            return;
        }

        $this->sortDirection = match ($this->sortDirection) {
            null => 'asc',
            'asc' => 'desc',
            'desc' => null,
        };

        if ($this->sortDirection === null) {
            $this->sortField = null;
        }
    }

    public function edit(Product $product): void
    {
        $this->authorize('update', $product);
        $this->dispatch('product-edit', productId: $product->id);
    }

    public function destroy(Product $product, ProductService $service): void
    {
        $this->authorize('delete', $product);
        $service->delete($product);

        $this->dispatch(
            'toast',
            message: 'Product delete successfully',
            type: 'success'
        );
    }

    #[On('product-save')]
    public function refreshTable(): void {}

    public function render()
    {
        $query = Product::query();

        if ($this->sortField && $this->sortDirection) {
            $query->orderBy(
                $this->sortField,
                $this->sortDirection
            );
        } else {
            $query->latest();
        }

        foreach ($this->filters as $field => $value) {
            if (blank($value)) {
                continue;
            }

            if (in_array($field, ['price', 'stock'])) {
                $query->where($field, $value);
                continue;
            }

            $query->where($field, 'like', "%{$value}%");
        }

        return view('livewire.product.table', [
            'products' => $query->paginate(15),
        ]);
    }
}
