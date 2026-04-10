<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('lets admins view the user directory', function (): void {
    $admin = User::factory()->create();
    $admin->assign('admin');

    User::factory()->create([
        'first_name' => 'Taylor',
        'last_name' => 'Otwell',
    ]);

    $this->actingAs($admin)
        ->get(route('admin.users.index'))
        ->assertSuccessful()
        ->assertSee('Taylor Otwell', false);
});

it('blocks non-admin users from the user directory', function (): void {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('admin.users.index'))
        ->assertForbidden();
});
