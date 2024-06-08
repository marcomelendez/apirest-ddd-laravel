<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lead>
 */
class LeadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $manager = User::where('role','MANAGER')->first();

        if(!$manager){
            $manager = User::factory()->create(['role'=>'MANAGER']);
        }

        return [
            'name' => $this->faker->name,
            'source' => $this->faker->word,
            'owner' => User::factory(),
            'created_by' => $manager->id,
        ];
    }
}
