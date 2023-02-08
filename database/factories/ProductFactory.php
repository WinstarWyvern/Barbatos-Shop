<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $randomNum = $this->faker->numberBetween(1, 5);
        $imageBasePath = "images/dummy-product-images/dummy-image-" . $randomNum . ".jpeg";
        return [
            'name' => $this->faker->words(mt_rand(1, 3), true),
            'description' => $this->faker->paragraph(mt_rand(5, 10)),
            'price' => $this->faker->numberBetween(10000, 1000000),
            'category_id' => Category::factory(),
            'imagePath' => $imageBasePath,
            'slug' => $this->faker->slug(3, false),
        ];
    }
}
