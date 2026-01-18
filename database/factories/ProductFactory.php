<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;


class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'id' => $this->faker->word,
            'category_id' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'sub_category_id' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'name' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'price' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'discount' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'discounted_price' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'description' => $this->faker->word,
            'uuid' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
