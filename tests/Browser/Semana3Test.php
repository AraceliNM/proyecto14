<?php

namespace Tests\Browser;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Semana3Test extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function add_product_without_color_or_size_in_shopping_cart()
    {
        $category = $this->createCategory();

        $subcategory = $this->createSubcategory($category->id);

        $brand = $this->createBrand($category->id);

        $product = $this->createProduct($subcategory->id, $brand->id);

        $this->browse(function (Browser $browser) use ($product) {
            $browser->visit('/products/' . $product->slug)
                ->assertPresent('@addItemButton')
                ->click('@addItemButton')
                ->pause(500)
                ->click('@shoppingCart')
                ->screenshot('AddProduct');
        });
    }

    /** @test */
    public function add_product_with_color_in_shopping_cart()
    {
        $category = $this->createCategory();

        $subcategory = $this->createSubcategory($category->id,true);

        $brand = $this->createBrand($category->id);

        $color = $this->createColor();

        $product = $this->createProduct($subcategory->id, $brand->id, Product::PUBLICADO, array($color));

        $this->browse(function (Browser $browser) use ($product) {
            $browser->visit('/products/' . $product->slug)
                ->assertPresent('@colorSelect')
                ->pause(500)
                ->click('@colorSelect')
                ->pause(500)
                ->click('@color', 1)
                ->pause(500)
                ->click('@addCartItemColor')
                ->pause(500)
                ->click('@shoppingCart')
                ->screenshot('AddProductWithColor');
        });
    }

    /** @test */
    public function add_product_with_color_and_size_in_shopping_cart()
    {
        $category = $this->createCategory();

        $subcategory = $this->createSubcategory($category->id,true, true);

        $brand = $this->createBrand($category->id);

        $color = $this->createColor();

        $product = $this->createProduct($subcategory->id, $brand->id, Product::PUBLICADO, array($color));

        $size = $this->createSize($product->id, array($color));

        $this->browse(function (Browser $browser) use ($product) {
            $browser->visit('/products/' . $product->slug)
                ->assertPresent('@sizeSelect')
                ->assertPresent('@colorSelect')
                ->pause(500)
                ->click('@sizeSelect')
                ->pause(500)
                ->click('@size', 1)
                ->pause(500)
                ->click('@colorSelect')
                ->pause(500)
                ->click('@colorSize', 1)
                ->pause(500)
                ->click('@addCartItemSize')
                ->pause(500)
                ->click('@shoppingCart')
                ->screenshot('AddProductWithColorAndSize');
        });
    }

    /** @test */
    public function the_red_circle_increments_when_adding_a_product_in_cart()
    {
        $category = $this->createCategory();

        $subcategory = $this->createSubcategory($category->id);

        $brand = $this->createBrand($category->id);

        $product = $this->createProduct($subcategory->id, $brand->id);

        $this->browse(function (Browser $browser) use ($product) {
            $browser->visit('/products/' . $product->slug)
                ->assertPresent('@addItemButton')
                ->click('@addItemButton')
                ->pause(500)
                ->visit('/')
                ->assertSee('1')
                ->screenshot('redCircleIncrements');
        });
    }

    /** @test */
    public function it_cannot_add_to_cart_over_the_max_quantity_the_product()
    {
        $category = $this->createCategory();

        $subcategory = $this->createSubcategory($category->id);

        $brand = $this->createBrand($category->id);

        $product = $this->createProduct3($subcategory->id, $brand->id);

        $this->browse(function (Browser $browser) use ($product) {
            $browser->visit('/products/' . $product->slug)
                ->assertPresent('@addItemButton')
                ->click('@incrementButton')
                ->click('@incrementButton')
                ->click('@incrementButton')
                ->click('@addItemButton')
                ->pause(500)
                ->assertDisabled('@addItemButton')
                ->screenshot('cannotAddMoreThanStockAvaible');
        });
    }
}
