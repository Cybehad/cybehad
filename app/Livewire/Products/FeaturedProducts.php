<?php

namespace App\Livewire\Products;

use Livewire\Component;
use App\Models\FeaturedProduct;

class FeaturedProducts extends Component
{
    public $limit = 5;

    public function render()
    {
        return view('livewire.products.featured-products', [
            'products' => FeaturedProduct::where('is_active', true)
                ->orderBy('created_at', 'desc')
                ->take($this->limit)
                ->get(),
        ]);
    }
}
