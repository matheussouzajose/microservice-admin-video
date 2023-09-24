<?php

namespace Database\Factories;

use App\Models\CastMember;
use Core\Domain\Enum\CastMemberType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<CastMember>
 */
class CastMemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = [CastMemberType::ACTOR, CastMemberType::DIRECTOR];

        return [
            'id' => (string) Str::uuid(),
            'name' => $this->faker->name(),
            'type' => $types[array_rand($types)],
        ];
    }
}
