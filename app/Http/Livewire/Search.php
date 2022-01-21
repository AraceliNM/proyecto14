<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class Search extends Component
{
    public $search;

    public function render()
    {
        $products = Product::where('name', 'LIKE', "%{$this->search}%")->get();

        return view('livewire.search', compact('products'));
    }
}
