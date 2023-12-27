<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductCategory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        $name = $this->faker->word();
        $category = ProductCategory::factory()->create();
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'content' => $this->faker->sentence(),
            'thumbnail' => $this->faker->imageUrl(640, 480, 'products', true),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'sale_price' => $this->faker->randomFloat(2, 10, 100),
            'category_product_id' => $category->id,
        ];
    }
}