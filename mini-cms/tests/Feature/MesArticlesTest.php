<?php

use App\Models\Post;
use App\Models\User;

beforeEach(function () {
    $this->withoutVite();
});

it('lists only my posts, drafts included', function () {
    $moi = User::factory()->create();
    $autre = User::factory()->create();

    Post::factory()->published()->create(['user_id' => $moi->id, 'title' => 'Mon article publie']);
    Post::factory()->create(['user_id' => $moi->id, 'title' => 'Mon brouillon', 'is_published' => false]);
    Post::factory()->published()->create(['user_id' => $autre->id, 'title' => 'Article dun autre']);

    $this->actingAs($moi)
        ->get(route('posts.mine'))
        ->assertOk()
        ->assertSee('Mon article publie')
        ->assertSee('Mon brouillon')
        ->assertDontSee('Article dun autre');
});

it('redirects a visitor to the login page', function () {
    $this->get('/mes-articles')->assertRedirect(route('login'));
});
