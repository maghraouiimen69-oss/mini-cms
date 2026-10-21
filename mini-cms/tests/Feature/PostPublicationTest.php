<?php

use App\Models\Post;

beforeEach(function () {
    $this->withoutVite();
});

it('publishes a draft and fills published_at', function () {
    $post = Post::create([
        'title' => 'Brouillon a publier',
        'slug' => 'brouillon-a-publier',
        'body' => 'Contenu du brouillon qui va etre publie.',
        'is_published' => false,
        'published_at' => null,
    ]);

    $this->patch(route('posts.publication', $post))
        ->assertRedirect(route('posts.show', $post));

    $post->refresh();
    expect($post->is_published)->toBeTrue();
    expect($post->published_at)->not->toBeNull();
});

it('unpublishes a post and clears published_at', function () {
    $post = Post::create([
        'title' => 'Article publie',
        'slug' => 'article-publie',
        'body' => 'Contenu de l article qui va etre depublie.',
        'is_published' => true,
        'published_at' => now(),
    ]);

    $this->patch(route('posts.publication', $post))
        ->assertRedirect(route('posts.show', $post));

    $post->refresh();
    expect($post->is_published)->toBeFalse();
    expect($post->published_at)->toBeNull();
});

it('shows Publier on a draft and Depublier on a published post', function () {
    $draft = Post::create([
        'title' => 'Brouillon bouton',
        'slug' => 'brouillon-bouton',
        'body' => 'Contenu du brouillon pour le bouton.',
        'is_published' => false,
    ]);

    $published = Post::create([
        'title' => 'Publie bouton',
        'slug' => 'publie-bouton',
        'body' => 'Contenu de l article publie pour le bouton.',
        'is_published' => true,
        'published_at' => now(),
    ]);

    $this->get(route('posts.show', $draft))->assertSee('Publier');
    $this->get(route('posts.show', $published))->assertSee('Dépublier');
});
