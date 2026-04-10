<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Services\Ideas\IdeaRefinementService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class IdeaController extends Controller
{
    public function index(Request $request): View
    {
        Gate::authorize('viewAny', Idea::class);

        $ideas = $request->user()
            ->ideas()
            ->latest('updated_at')
            ->latest('id')
            ->get();

        return view('ideas.index', [
            'ideas' => $ideas,
        ]);
    }

    public function create(): View
    {
        Gate::authorize('create', Idea::class);

        return view('ideas.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Gate::authorize('create', Idea::class);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'summary' => ['required', 'string', 'max:500'],
            'details' => ['required', 'string'],
        ]);

        $idea = $request->user()->ideas()->create($validated);

        return redirect()
            ->route('ideas.edit', $idea)
            ->with('status', 'Idea draft created.');
    }

    public function edit(Idea $idea): View
    {
        Gate::authorize('update', $idea);

        return view('ideas.edit', [
            'idea' => $idea,
        ]);
    }

    public function update(Request $request, Idea $idea): RedirectResponse
    {
        Gate::authorize('update', $idea);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'summary' => ['required', 'string', 'max:500'],
            'details' => ['required', 'string'],
        ]);

        $idea->update($validated);

        return redirect()
            ->route('ideas.edit', $idea)
            ->with('status', 'Idea draft updated.');
    }

    public function destroy(Idea $idea): RedirectResponse
    {
        Gate::authorize('delete', $idea);

        $idea->delete();

        return redirect()
            ->route('ideas.index')
            ->with('status', 'Idea draft deleted.');
    }

    public function refine(Idea $idea, IdeaRefinementService $service): RedirectResponse
    {
        Gate::authorize('update', $idea);

        return redirect()
            ->route('ideas.edit', $idea)
            ->with('ideaRefinement', $service->refine($idea));
    }
}
