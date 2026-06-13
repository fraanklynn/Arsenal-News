<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            ['name' => 'Fabrizio Romano'],
            ['name' => 'David Ornstein'],
            ['name' => 'Justinus Lhaksana'],
        ])->each(fn ($author) => Author::create($author));
    }
}
