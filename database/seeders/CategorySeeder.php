<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        collect([
            ['name' => 'Match Review', 'slug' => 'match-review'],
            ['name' => 'Transfer Rumours', 'slug' => 'transfer-rumours'],
            ['name' => 'First Team', 'slug' => 'first-team'],
        ])->each(fn (array $item) => Category::create($item));
    }
}
