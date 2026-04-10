<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('defaults the shell to system theme mode for guests', function () {
    $response = $this->get(route('home'));

    $response->assertSuccessful();
    $response->assertSee('data-theme-mode="system"', false);
});

it('applies authenticated user theme preferences to the shell', function () {
    $user = User::factory()->create([
        'theme_preferences' => [
            'mode' => 'dark',
            'accent' => '#1F8A70',
        ],
    ]);

    $response = $this->actingAs($user)->get(route('home'));

    $response->assertSuccessful();
    $response->assertSee('data-theme-mode="dark"', false);
    $response->assertSee('--app-accent: #1F8A70', false);
});
