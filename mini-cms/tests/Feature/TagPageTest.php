<?php

use App\Models\Post;
use App\Models\Tag;

beforeEach(function () {
    $this->withoutVite();
});

it('lists the published posts of a tag, newest first, four per page', function () {
    $tag = Tag::create(['name' => 'Laravel', 'slug' => 'laravel']);

    $posts = collect(['un', 'deux', 'trois', 'quatre', 'cinq'])->map(function ($nom, $i) use ($tag) {
        $post = Post::create([
            'title' => 'Article tag '.$nom,
            'slug' => 'article-tag-'.$nom,
            'body' => 'Contenu de l article tag numero '.$nom.' du test.',
            'is_published' => true,
            'published_at' => now()->addDays($i),
        ]);
        $post->tags()->attach($tag);

        return $post;
    });

    $brouillon = Post::create([
        'title' => 'Brouillon du tag',
        'slug' => 'brouillon-du-tag',
        'body' => 'Contenu du brouillon portant le meme tag.',
        'is_published' => false,
    ]);
    $brouillon->tags()->attach($tag);

    $this->get(route('posts.tag', $tag))
        ->assertOk()
        ->assertSee('Tag : Laravel')
        ->assertSeeInOrder(['Article tag cinq', 'Article tag quatre', 'Article tag trois', 'Article tag deux'])
        ->assertDontSee('Article tag un')
        ->assertDontSee('Brouillon du tag')
        ->assertSee('/posts/tag/laravel');
});

it('returns 404 for an unknown tag slug', function () {
    $this->get('/posts/tag/inconnu')->assertNotFound();
});
