<?php

namespace App\Livewire;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductPage extends Component
{
    use WithFileUploads;

    public ?Product $editing = null;

    public string $name = "";

    public string $slug = "";

    public string $description = "";

    public int $price = 0;

    public int $stock = 0;

    public bool $is_active = false;

    public $image;

    public function save(ProductService $service): void
    {
        if ($this->editing) {
            $this->authorize("update", $this->editing);

            $validated = $this->validate(
                UpdateProductRequest::rules($this->editing)
            );

            $service->update($this->editing, $validated, $this->image);
        } else {
            $validated = $this->validate(StoreProductRequest::rules());

            $service->create($validated, $this->image);
        }

        $this->resetForm();
    }

    public function edit(Product $product): void
    {
        $this->authorize("update", $product);

        $this->editing = $product;

        $this->fill([
            "name" => $product->name,
            "slug" => $product->slug,
            "description" => $product->description,
            "price" => $product->price,
            "stock" => $product->stock,
            "is_active" => $product->is_active,
        ]);
    }

    public function destroy(Product $product, ProductService $service): void
    {
        $this->authorize("delete", $product);

        $service->delete($product);
    }

    protected function resetForm(): void
    {
        $this->reset([
            "editing",
            "name",
            "slug",
            "description",
            "price",
            "stock",
            "is_active",
            "image",
        ]);
    }

    public function render()
    {
        return view("dashboard", [
            "products" => Product::query()
                ->where("user_id", Auth::id())
                ->latest()
                ->get(),
        ]);
    }
}
