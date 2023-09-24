<?php

namespace Database\Factories;

use App\Models\Category;
use Carbon\Carbon;
use Core\Domain\Enum\Rating;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Category>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => (string) Str::uuid(),
            'title' => $this->faker->name(),
            'description' => $this->faker->sentence(10),
            'year_launched' => Carbon::make(now()->addYears(5))->format('Y'),
            'opened' => true,
            'rating' => Rating::L->value,
            'duration' => 1,
            'created_at' => now(),
        ];
    }
}
