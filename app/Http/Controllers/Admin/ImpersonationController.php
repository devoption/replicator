<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ImpersonationController extends Controller
{
    public function store(Request $request, User $user): RedirectResponse
    {
        Gate::authorize('access-admin');

        if ($request->session()->has('impersonator_id')) {
            return redirect()->route('admin.users.index');
        }

        $request->session()->put('impersonator_id', $request->user()?->id);
        Auth::login($user);

        return redirect()->route('home');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Gate::authorize('access-admin');

        $impersonatorId = $request->session()->pull('impersonator_id');

        if (! is_string($impersonatorId) && ! is_int($impersonatorId)) {
            return redirect()->route('admin.users.index');
        }

        $impersonator = User::query()->find($impersonatorId);

        if ($impersonator === null) {
            return redirect()->route('admin.users.index');
        }

        Auth::login($impersonator);

        return redirect()->route('admin.users.index');
    }
}
