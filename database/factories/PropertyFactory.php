<?php

namespace Database\Factories;

use Modules\WebsiteContent\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PropertyFactory extends Factory
{
    protected $model = Property::class; // 👈 This line is critical

    public function definition(): array
    {
        return [
            'business_id' => 1,
            'agent_id' => 1,
            'title' => $this->faker->sentence(3),
            'slug' => Str::slug($this->faker->unique()->sentence(3)),
            'address' => $this->faker->address,
            'category' => $this->faker->randomElement(['House', 'Apartment', 'Commercial']),
            'listing_type' => $this->faker->randomElement(['sale', 'rent', 'sold']),
            'price' => $this->faker->numberBetween(100000, 900000),
            'bedrooms' => $this->faker->numberBetween(1, 5),
            'bathrooms' => $this->faker->numberBetween(1, 3),
            'area' => $this->faker->numberBetween(60, 500),
            'latitude' => $this->faker->latitude(-20.0, -19.9),
            'longitude' => $this->faker->longitude(148.1, 148.4),
            'image_count' => $this->faker->numberBetween(1, 10),
            'description' => $this->faker->paragraph(),
        ];
    }
}