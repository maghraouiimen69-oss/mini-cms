<?php

use App\Models\Category;
use App\Models\Post;

beforeEach(function () {
    $this->withoutVite();
});

it('shows only the other published posts of the same category', function () {
    $laravel = Category::create(['name' => 'Laravel', 'slug' => 'laravel']);
    $php = Category::create(['name' => 'PHP', 'slug' => 'php']);

    $affiche = Post::create([
        'title' => 'Article affiche',
        'slug' => 'article-affiche',
        'body' => 'Contenu de l article affiche dans la page.',
        'is_published' => true,
        'published_at' => now(),
        'category_id' => $laravel->id,
    ]);

    $voisin = Post::create([
        'title' => 'Article voisin publie',
        'slug' => 'article-voisin-publie',
        'body' => 'Contenu du voisin publie de la meme categorie.',
        'is_published' => true,
        'published_at' => now(),
        'category_id' => $laravel->id,
    ]);

    Post::create([
        'title' => 'Brouillon meme categorie',
        'slug' => 'brouillon-meme-categorie',
        'body' => 'Contenu du brouillon de la meme categorie.',
        'is_published' => false,
        'category_id' => $laravel->id,
    ]);

    Post::create([
        'title' => 'Article autre categorie',
        'slug' => 'article-autre-categorie',
        'body' => 'Contenu dun article d une autre categorie.',
        'is_published' => true,
        'published_at' => now(),
        'category_id' => $php->id,
    ]);

    $this->get(route('posts.show', $affiche))
        ->assertOk()
        ->assertSee('Dans la même catégorie')
        ->assertSee($voisin->title)
        ->assertDontSee('Brouillon meme categorie')
        ->assertDontSee('Article autre categorie')
        ->assertViewHas('sameCategory', fn ($posts) => $posts->pluck('id')->all() === [$voisin->id]);
});

it('shows no section for a post without category', function () {
    $sans = Post::create([
        'title' => 'Article sans categorie',
        'slug' => 'article-sans-categorie',
        'body' => 'Contenu de l article sans categorie attachee.',
        'is_published' => true,
        'published_at' => now(),
    ]);

    $this->get(route('posts.show', $sans))
        ->assertOk()
        ->assertDontSee('Dans la même catégorie');
});
