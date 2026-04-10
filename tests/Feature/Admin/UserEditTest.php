<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('allows admins to edit user details and roles', function (): void {
    $admin = User::factory()->create();
    $admin->assign('admin');

    $user = User::factory()->create();

    $this->actingAs($admin)
        ->put(route('admin.users.update', $user), [
            'first_name' => 'Taylor',
            'last_name' => 'Otwell',
            'email' => 'taylor@example.com',
            'role' => 'admin',
        ])
        ->assertRedirect(route('admin.users.index'));

    expect($user->fresh()->name)->toBe('Taylor Otwell');
    expect($user->fresh()->email)->toBe('taylor@example.com');
    expect($user->fresh()->isAn('admin'))->toBeTrue();
});
