<?php

use App\Models\User;
use App\Notifications\InAppNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('shows unread and read notifications in the inbox', function (): void {
    $user = User::factory()->create();

    $user->notify(new InAppNotification(
        title: 'Welcome',
        body: 'Your inbox is ready.',
        url: route('home')
    ));

    $notification = $user->notifications()->first();

    $this->actingAs($user)
        ->get(route('notifications.index'))
        ->assertSuccessful()
        ->assertSee('Welcome', false)
        ->assertSee('Mark read', false);

    $this->actingAs($user)
        ->post(route('notifications.read', $notification))
        ->assertRedirect();

    $notification->refresh();

    expect($notification->read_at)->not->toBeNull();

    $this->actingAs($user)
        ->get(route('notifications.index'))
        ->assertSuccessful()
        ->assertSee('Mark unread', false);
});

it('blocks users from changing other users notifications', function (): void {
    $owner = User::factory()->create();
    $other = User::factory()->create();

    $owner->notify(new InAppNotification(
        title: 'Private',
        body: 'Only one account should see this.'
    ));

    $notification = $owner->notifications()->first();

    $this->actingAs($other)
        ->post(route('notifications.read', $notification))
        ->assertForbidden();
});
