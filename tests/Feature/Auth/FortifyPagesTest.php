<?php

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;

uses(RefreshDatabase::class);

it('shows the login page to guests', function (): void {
    $this->get(route('login'))
        ->assertSuccessful()
        ->assertSee('Sign in', false);
});

it('redirects authenticated users away from the login page', function (): void {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('login'))
        ->assertRedirect(route('home'));
});

it('sends a password reset link', function (): void {
    $user = User::factory()->create();

    Notification::fake();

    $this->post(route('password.email'), [
        'email' => $user->email,
    ])->assertRedirect();

    Notification::assertSentTo($user, ResetPassword::class);
});
