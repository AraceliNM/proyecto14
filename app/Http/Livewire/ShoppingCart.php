<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShoppingCart extends Component
{
    public $listeners = ['render'];

    public function render()
    {
        return view('livewire.shopping-cart');
    }
}
