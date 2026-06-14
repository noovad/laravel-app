<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function create(
        array $data,
        ?UploadedFile $image = null
    ): Product {

        if ($image) {
            $data['image'] = $image->store(
                'products',
                'public'
            );
        }

         $data['user_id'] = Auth::id();

        return Product::create(
            $data
        );
    }

    public function update(
        Product $product,
        array $data,
        ?UploadedFile $image = null
    ): Product {

        if ($image) {

            if ($product->image) {

                Storage::disk('public')
                    ->delete($product->image);
            }

            $data['image'] = $image->store(
                'products',
                'public'
            );
        }

        $product->update(
            $data
        );

        return $product->fresh();
    }

    public function delete(
        Product $product
    ): bool {

        if ($product->image) {

            Storage::disk('public')
                ->delete($product->image);
        }

        return $product->delete();
    }
}