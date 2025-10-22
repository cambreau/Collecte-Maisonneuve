<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Etudiant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titre' => json_encode([
                'en' => $this->faker->sentence(3),
                'fr' => $this->faker->sentence(3)
            ]),
            'contenu' => json_encode([
                'en' => $this->faker->paragraphs(3, true),
                'fr' => $this->faker->paragraphs(3, true)
            ]),
            'etudiant_id' => Etudiant::factory(),
        ];
    }
}
