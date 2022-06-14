<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ShowProducts2 extends Component
{
    use WithPagination;

    public $search;
    public $pagination = 10;
    public $columns = [
        'Nombre', 'Categoría', 'Subcategoría', 'Marca', 'Fecha de Creación',
        'Stock', 'Color', 'Talla', 'Estado', 'Precio', 'Editar'
    ];
    public $selectedColumns = [];
    public $show = false;
    public $camp = null;
    public $order = null;
    public $icon = '-circle';

    public function render()
    {
        $products = Product::where('name', 'LIKE', "%{$this->search}%");

        if ($this->camp && $this->order) {
            $products = $products->orderBy($this->camp, $this->order);
        }
        $products = $products->paginate($this->pagination);

        return view('livewire.admin.show-products2', compact('products'))
            ->layout('layouts.admin');
    }

    public function mount()
    {
        $this->selectedColumns = $this->columns;
    }

    public function showColumn($column): bool
    {
        return in_array($column, $this->selectedColumns);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPagination()
    {
        $this->resetPage();
    }

    public function sortable($camp)
    {
        if ($camp !== $this->camp) {
            $this->order = null;
        }
        switch ($this->order) {
            case null:
                $this->order = 'asc';
                $this->icon = '-arrow-circle-up';
                break;
            case 'asc':
                $this->order = 'desc';
                $this->icon = '-arrow-circle-down';
                break;
            case 'desc':
                $this->order = null;
                $this->icon = '-circle';
                break;
        }

        $this->camp = $camp;
    }

    public function clear()
    {
        $this->search = null;
        $this->pagination = 10;
        $this->order = null;
        $this->camp = null;
        $this->selectedColumns = $this->columns;
        $this->icon = '-circle';
    }
}
