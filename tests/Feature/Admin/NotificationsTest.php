<?php

use App\Models\User;
use App\Notifications\InAppNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;

uses(RefreshDatabase::class);

it('allows admins to send notifications to all users', function (): void {
    Notification::fake();

    $admin = User::factory()->create();
    $admin->assign('admin');
    $users = User::factory()->count(2)->create();

    $this->actingAs($admin)
        ->post(route('admin.notifications.store'), [
            'title' => 'System update',
            'body' => 'We have a new internal update.',
            'target' => 'all',
        ])
        ->assertRedirect();

    Notification::assertSentTo($users[0], InAppNotification::class);
    Notification::assertSentTo($users[1], InAppNotification::class);
    Notification::assertSentTo($admin, InAppNotification::class);
});

it('allows admins to target notifications by role or user list', function (): void {
    Notification::fake();

    $admin = User::factory()->create();
    $admin->assign('admin');
    $targetAdmin = User::factory()->create();
    $targetAdmin->assign('admin');
    $targetUser = User::factory()->create();

    $this->actingAs($admin)
        ->post(route('admin.notifications.store'), [
            'title' => 'Role update',
            'body' => 'This is for admins only.',
            'target' => 'role',
            'role' => 'admin',
        ])
        ->assertRedirect();

    Notification::assertSentTo($admin, InAppNotification::class);
    Notification::assertSentTo($targetAdmin, InAppNotification::class);
    Notification::assertNotSentTo($targetUser, InAppNotification::class);

    Notification::fake();

    $this->actingAs($admin)
        ->post(route('admin.notifications.store'), [
            'title' => 'Chosen people',
            'body' => 'Only specific users should get this.',
            'target' => 'users',
            'user_ids' => [$targetUser->id],
        ])
        ->assertRedirect();

    Notification::assertSentTo($targetUser, InAppNotification::class);
    Notification::assertNotSentTo($admin, InAppNotification::class);
});

it('forbids non-admins from sending notifications', function (): void {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('admin.notifications.store'), [
            'title' => 'Nope',
            'body' => 'Should not send.',
            'target' => 'all',
        ])
        ->assertForbidden();
});
