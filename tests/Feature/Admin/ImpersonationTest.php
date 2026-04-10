<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('lets admins impersonate a user and return to the admin session', function (): void {
    $admin = User::factory()->create();
    $admin->assign('admin');

    $user = User::factory()->create();

    $this->actingAs($admin)
        ->post(route('admin.users.impersonate', $user))
        ->assertRedirect(route('home'));

    $this->assertAuthenticatedAs($user);

    $this->actingAs($admin)
        ->delete(route('admin.impersonation.destroy'))
        ->assertRedirect(route('admin.users.index'));

    $this->assertAuthenticatedAs($admin);
});

it('blocks non-admin users from impersonating', function (): void {
    $user = User::factory()->create();
    $target = User::factory()->create();

    $this->actingAs($user)
        ->post(route('admin.users.impersonate', $target))
        ->assertForbidden();
});
