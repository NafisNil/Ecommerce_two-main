<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Brand;
use App\Models\User;
use App\Models\Category;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'title' => $this->faker->sentence(3, false),
            'slug' => $this->faker->unique()->slug,
            'summary' => $this->faker->text,
            'description' => $this->faker->text,
            'stock' => $this->faker->numberBetween(2,10),
            'brand_id' => $this->faker->randomElement(Brand::pluck('id')->toArray()),
            'vendor_id' => $this->faker->randomElement(User::pluck('id')->toArray()),
            'cat_id' => $this->faker->randomElement(Category::where('is_parent',1)->pluck('id')->toArray()),
            'child_cat_id' => $this->faker->randomElement(Category::where('is_parent',0)->pluck('id')->toArray()),
            'photo' => $this->faker->imageUrl('400', '200'),
            'price' => $this->faker->numberBetween('10', '2'),
            'offer_price' => $this->faker->numberBetween('10', '2'),
            'discount' => $this->faker->numberBetween('10', '2'),
            'size' => $this->faker->randomElement(['S','M','L']),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'conditions' => $this->faker->randomElement(['new','popular','winter']),

        ];
    }
}
