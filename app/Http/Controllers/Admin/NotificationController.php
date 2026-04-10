<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\InAppNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\View\View;

class NotificationController extends Controller
{
    public function index(Request $request): View
    {
        if ($request->user()->isAn('admin')) {
            return view('admin.notifications.index', [
                'users' => User::query()->orderBy('first_name')->get(),
                'notifications' => $request->user()->notifications()->latest()->limit(10)->get(),
            ]);
        }

        return view('notifications.index', [
            'notifications' => $request->user()->notifications()->latest()->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        abort_unless($request->user()->isAn('admin'), 403);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string', 'max:2000'],
            'target' => ['required', 'in:all,role,users'],
            'role' => ['required_if:target,role', 'in:admin,user'],
            'user_ids' => ['array'],
            'user_ids.*' => ['integer', 'exists:users,id'],
        ]);

        $notification = new InAppNotification(
            title: $validated['title'],
            body: $validated['body'],
            url: route('notifications.index'),
        );

        $recipients = match ($validated['target']) {
            'all' => User::query()->get(),
            'role' => User::query()->whereIs($validated['role'])->get(),
            'users' => User::query()->whereIn('id', $validated['user_ids'] ?? [])->get(),
        };

        Notification::send($recipients, $notification);

        return back()->with('status', 'Notification sent.');
    }

    public function markRead(Request $request, DatabaseNotification $notification): RedirectResponse
    {
        if ($notification->notifiable_id !== $request->user()?->id) {
            abort(403);
        }

        $notification->markAsRead();

        return back();
    }

    public function markUnread(Request $request, DatabaseNotification $notification): RedirectResponse
    {
        if ($notification->notifiable_id !== $request->user()?->id) {
            abort(403);
        }

        $notification->markAsUnread();

        return back();
    }
}
