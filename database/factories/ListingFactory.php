<?php

namespace Database\Factories;

use App\Models\Listing;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->jobTitle(),
            'tags' => implode(', ', $this->faker->randomElements(['Laravel','Backend','Frontend','Remote','Fulltime','Vue','React','PHP'], 3)),
            'company' => $this->faker->company(),
            'location' => $this->faker->city() . ', ' . $this->faker->stateAbbr(),
            'email' => $this->faker->unique()->safeEmail(),
            'website' => $this->faker->url(),
            'description' => 'We are looking for a skilled professional to join our team. Must have strong communication skills and experience with modern tech stacks.',
        ];
    }
}
