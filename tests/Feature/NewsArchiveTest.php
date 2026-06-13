<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsArchiveTest extends TestCase
{
    use RefreshDatabase;

    public function test_news_archive_page_is_accessible()
    {
        $response = $this->get('/news');

        $response->assertStatus(200);
        $response->assertSee('WIRE FEED');
    }

    public function test_news_archive_displays_posts()
    {
        $category = Category::create(['name' => 'General', 'slug' => 'general']);
        $post = Post::create([
            'title' => 'Sample News',
            'slug' => 'sample-news',
            'excerpt' => 'Excerpt',
            'body' => 'Body content',
            'category_id' => $category->id
        ]);

        $response = $this->get('/news');

        $response->assertStatus(200);
        $response->assertSee('Sample News');
    }

    public function test_search_functionality_filters_posts()
    {
        $category = Category::create(['name' => 'General', 'slug' => 'general']);
        Post::create([
            'title' => 'Arsenal wins',
            'slug' => 'arsenal-wins',
            'excerpt' => 'Excerpt',
            'body' => 'Body content',
            'category_id' => $category->id
        ]);
        Post::create([
            'title' => 'Chelsea loses',
            'slug' => 'chelsea-loses',
            'excerpt' => 'Excerpt',
            'body' => 'Body content',
            'category_id' => $category->id
        ]);

        $response = $this->get('/news?search=Arsenal');

        $response->assertStatus(200);
        $response->assertSee('Arsenal wins');
        $response->assertDontSee('Chelsea loses');
        $response->assertSee('Menampilkan hasil pencarian untuk:');
        $response->assertSee('Arsenal');
    }

    public function test_empty_search_results_shows_message()
    {
        $response = $this->get('/news?search=NonExistentNews');

        $response->assertStatus(200);
        $response->assertSee('Maaf, berita tidak ditemukan atau belum tersedia.');
    }

    public function test_archive_pagination()
    {
        $category = Category::create(['name' => 'General', 'slug' => 'general']);
        Post::factory()->count(15)->create(['category_id' => $category->id]);

        $response = $this->get('/news');

        $response->assertStatus(200);
        $response->assertSee('nav'); 
    }

    public function test_category_filtering()
    {
        $cat1 = Category::create(['name' => 'Transfers', 'slug' => 'transfers']);
        $cat2 = Category::create(['name' => 'Match', 'slug' => 'match']);
        
        Post::create([
            'title' => 'Transfer News',
            'slug' => 'transfer-news',
            'excerpt' => 'Excerpt',
            'body' => 'Body',
            'category_id' => $cat1->id
        ]);
        Post::create([
            'title' => 'Match News',
            'slug' => 'match-news',
            'excerpt' => 'Excerpt',
            'body' => 'Body',
            'category_id' => $cat2->id
        ]);

        $response = $this->get('/news?category=transfers');

        $response->assertStatus(200);
        $response->assertSee('Transfer News');
        $response->assertDontSee('Match News');
    }
}
