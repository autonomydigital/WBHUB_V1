<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\WebsiteContent\Models\Property;
use Database\Factories\PropertyFactory;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        PropertyFactory::new()
            ->count(20)
            ->create();
    }
}