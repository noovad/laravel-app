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
       <tbody x-on:product-created>
           @foreach ($products as $product)
               <tr class="border-b">
                   <td class="p-2">
                       @if ($product->image)
                           <img src="{{ Storage::url($product->image) }}" class="w-16 h-16 object-cover">
                       @else <p>no image</p>
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
