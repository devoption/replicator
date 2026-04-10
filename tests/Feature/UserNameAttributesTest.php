<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('combines the user name fields into a name attribute', function (): void {
    $user = User::factory()->create([
        'first_name' => 'Taylor',
        'last_name' => 'Otwell',
    ]);

    expect($user->name)->toBe('Taylor Otwell');
});

it('splits a full name back into the name fields', function (): void {
    $user = new User;
    $user->name = 'Taylor Otwell';

    expect($user->first_name)->toBe('Taylor');
    expect($user->last_name)->toBe('Otwell');
});

it('derives initials from the name fields', function (): void {
    $user = User::factory()->create([
        'first_name' => 'Taylor',
        'last_name' => 'Otwell',
    ]);

    expect($user->initials)->toBe('TO');
});
