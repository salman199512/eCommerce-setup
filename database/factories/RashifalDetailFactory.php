<?php

namespace Database\Factories;

use App\Models\RashifalDetail;
use Illuminate\Database\Eloquent\Factories\Factory;


class RashifalDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RashifalDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'id' => $this->faker->word,
            'date' => $this->faker->date('Y-m-d'),
            'title_gujarati' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'title_english' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'title_hindi' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'slug' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'rashifal_id' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'description_gujarati' => $this->faker->word,
            'description_english' => $this->faker->word,
            'description_hindi' => $this->faker->word,
            'meta_title' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'meta_description' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'meta_keyword' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'uuid' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
