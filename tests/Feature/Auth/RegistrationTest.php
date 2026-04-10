<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('shows the registration page to guests', function (): void {
    $this->get(route('register'))
        ->assertSuccessful()
        ->assertSee('Create account', false);
});

it('creates a new user account', function (): void {
    $this->post(route('register'), [
        'first_name' => 'Taylor',
        'last_name' => 'Otwell',
        'email' => 'taylor@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ])->assertRedirect(route('home'));

    expect(User::where('email', 'taylor@example.com')->exists())->toBeTrue();
    $this->assertAuthenticated();
});
