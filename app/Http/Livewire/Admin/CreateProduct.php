<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Livewire\Component;

class CreateProduct extends Component
{
    public $categories, $subcategories = [], $brands = [];
    public $category_id = '', $subcategory_id = '', $brand_id = '';
    public $name, $slug, $description, $price, $quantity;

    protected $rules = [
        'category_id' => 'required',
        'subcategory_id' => 'required',
        'name' => 'required',
        'slug' => 'required|unique:products',
        'description' => 'required',
        'brand_id' => 'required',
        'price' => 'required',
    ];

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function save()
    {
        if ($this->subcategory_id && !$this->subcategory->color && !$this->subcategory->size) {
            $this->rules['quantity'] = 'required';
        }

        $this->validate();
    }

    public function updatedCategoryId($value)
    {
        $this->subcategories = Subcategory::where('category_id', $value)->get();

        $this->brands = Brand::whereHas('categories', function(Builder $query) use ($value) {
            $query->where('category_id', $value);
        })->get();

        $this->reset(['subcategory_id', 'brand_id']);
    }

    public function updatedName($value){
        $this->slug = Str::slug($value);
    }

    public function getSubcategoryProperty()
    {
        return Subcategory::find($this->subcategory_id);
    }

    public function render()
    {
        return view('livewire.admin.create-product')
            ->layout('layouts.admin');
    }
}
