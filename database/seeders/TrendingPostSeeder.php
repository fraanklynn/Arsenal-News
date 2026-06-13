<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class TrendingPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::latest()->take(4)->update(['is_trending' => true]);
    }
}
