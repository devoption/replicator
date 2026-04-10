<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('seeds the baseline admin and user roles', function (): void {
    $this->artisan('db:seed')
        ->assertExitCode(0);

    $user = User::where('email', 'test@example.com')->first();

    expect($user)->not->toBeNull();
    expect($user?->isAn('admin'))->toBeFalse();
});

it('denies non-admin users from the admin route', function (): void {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('admin.dashboard'))
        ->assertForbidden();
});

it('allows admins to access the admin route', function (): void {
    $user = User::factory()->create();
    $user->assign('admin');

    $this->actingAs($user)
        ->get(route('admin.dashboard'))
        ->assertSuccessful();
});
