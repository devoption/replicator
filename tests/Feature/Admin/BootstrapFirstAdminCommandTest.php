<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('promotes the first user when no admin exists', function (): void {
    $user = User::factory()->create();

    $this->artisan('app:bootstrap-first-admin')
        ->assertExitCode(0);

    expect($user->fresh()->isAn('admin'))->toBeTrue();
});

it('promotes an existing user by email', function (): void {
    $user = User::factory()->create();

    $this->artisan('app:bootstrap-first-admin', [
        'email' => $user->email,
    ])->assertExitCode(0);

    expect($user->fresh()->isAn('admin'))->toBeTrue();
});

it('fails when the user does not exist', function (): void {
    $this->artisan('app:bootstrap-first-admin', [
        'email' => 'missing@example.com',
    ])->assertExitCode(1);
});
