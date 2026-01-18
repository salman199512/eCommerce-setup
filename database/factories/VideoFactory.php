<?php

namespace Database\Factories;

use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;


class VideoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Video::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'id' => $this->faker->word,
            'title_gujarati' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'title_english' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'title_hindi' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'type' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'youtube_url' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'uuid' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
