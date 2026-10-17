<?php

use App\Models\Post;

it('shows at most three published posts on the home page', function () {
    Post::create([
        'title' => 'Article ancien',
        'slug' => 'article-ancien',
        'body' => 'Un corps de texte suffisamment long pour cet article ancien.',
        'is_published' => true,
        'published_at' => '2026-01-05 09:00:00',
    ]);
    Post::create([
        'title' => 'Article recent un',
        'slug' => 'article-recent-un',
        'body' => 'Un corps de texte suffisamment long pour cet article recent.',
        'is_published' => true,
        'published_at' => '2026-10-01 09:00:00',
    ]);
    Post::create([
        'title' => 'Article recent deux',
        'slug' => 'article-recent-deux',
        'body' => 'Un corps de texte suffisamment long pour cet article recent.',
        'is_published' => true,
        'published_at' => '2026-10-02 09:00:00',
    ]);
    Post::create([
        'title' => 'Article recent trois',
        'slug' => 'article-recent-trois',
        'body' => 'Un corps de texte suffisamment long pour cet article recent.',
        'is_published' => true,
        'published_at' => '2026-10-03 09:00:00',
    ]);
    Post::create([
        'title' => 'Brouillon cache',
        'slug' => 'brouillon-cache',
        'body' => 'Un corps de texte suffisamment long pour ce brouillon cache.',
        'is_published' => false,
        'published_at' => null,
    ]);

    $this->get(route('home'))
        ->assertOk()
        ->assertSee('Article recent trois')
        ->assertSee('Article recent deux')
        ->assertSee('Article recent un')
        ->assertDontSee('Article ancien')
        ->assertDontSee('Brouillon cache');
});
