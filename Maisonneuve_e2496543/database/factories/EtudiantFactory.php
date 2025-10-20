<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ville;
use App\Models\User;
use App\Models\Etudiant;
use Illuminate\Support\Facades\Hash;

class EtudiantFactory extends Factory
{
    protected $model = Etudiant::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->name,
            'adresse' => $this->faker->address,
            'telephone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'date_naissance' => $this->faker->date('Y-m-d', '-18 years'),
            'ville' => Ville::factory(),
            'user_id' => User::factory(), // crée et associe un User automatiquement
        ];
    }
}