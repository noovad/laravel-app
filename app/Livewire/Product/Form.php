<?php

namespace App\Livewire\Product;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public ?Product $editing = null;

    public string $name = '';

    public string $slug = '';

    public string $description = '';

    public int $price = 0;

    public int $stock = 0;

    public bool $is_active = false;

    public ?TemporaryUploadedFile $image = null;

    public ?string $currentImage = null;

    public function save(ProductService $service): void
    {
        if ($this->editing) {
            $this->authorize('update', $this->editing);

            $validated = $this->validate(
                UpdateProductRequest::rules($this->editing)
            );

            $service->update($this->editing, $validated, $this->image);
            $this->dispatch(
                'toast',
                message: 'Product update successfully',
                type: 'success'
            );
        } else {
            $validated = $this->validate(StoreProductRequest::rules());

            $service->create($validated, $this->image);
            $this->dispatch(
                'toast',
                message: 'Product created successfully',
                type: 'success'
            );
        }

        $this->dispatch('product-save');
        $this->resetForm();
    }

    #[On('product-edit')]
    public function loadProduct(int $productId): void
    {
        $product = Product::findOrFail($productId);

        $this->editing = $product;

        $this->fill([
            'name' => $product->name,
            'slug' => $product->slug,
            'description' => $product->description,
            'price' => $product->price,
            'stock' => $product->stock,
            'is_active' => $product->is_active,
        ]);
        $this->currentImage = $product->image;
        $this->image = null;
    }

    public function closeForm(): void
    {
        $this->resetForm();
        $this->resetValidation();
    }

    protected function resetForm(): void
    {
        $this->reset([
            'editing',
            'name',
            'slug',
            'description',
            'price',
            'stock',
            'is_active',
            'image',
            'currentImage',
        ]);
    }

    public function render()
    {
        return view('livewire.product.form');
    }
}
