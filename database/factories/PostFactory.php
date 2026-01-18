<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;


class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'id' => $this->faker->word,
            'category_id' => $this->faker->numberBetween(0, 999),
            'sub_category_id' => $this->faker->numberBetween(0, 999),
            'date' => $this->faker->date('Y-m-d'),
            'title_gujarati' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'title_hindi' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'title_english' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'slug' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'short_description_gujarati' => $this->faker->word,
            'short_description_hindi' => $this->faker->word,
            'short_description_english' => $this->faker->word,
            'long_description_gujarati' => $this->faker->word,
            'long_description_hindi' => $this->faker->word,
            'long_description_english' => $this->faker->word,
            'show_in_main_banner_section' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'its_braking_news' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'youtube_url' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'meta_title' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'meta_description' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'meta_keyword' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'uuid' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
